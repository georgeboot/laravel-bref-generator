<?php

namespace App\Http;

use App\Resources\HttpApi;
use App\Resources\Scheduler;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;
use Symfony\Component\Yaml\Yaml;

class Generator extends Component
{
    public string $appName = 'Your Awesome New App';
    public string $stageName = 'production';
    public string $awsRegion = 'us-east-1';
    public string $phpVersion = 'php-80';
    public Collection $httpApis;

    /** @var Scheduler|array */
    public $scheduler;

    public function mount()
    {
        $this->httpApis = collect([]);
        $this->scheduler = new Scheduler([
            'name' => 'scheduler',
            'memorySize' => 1024,
            'timeout' => 5,
            'enabled' => true,
        ]);

        $this->addHttpApi();
    }

    public function dehydrate($value)
    {
        $this->scheduler = $this->scheduler->toArray();
    }

    public function hydrate($value)
    {
        $this->httpApis->transform(fn($array) => new HttpApi($array));

        $this->scheduler = new Scheduler($this->scheduler);
    }

    public function render()
    {
        return view('generator');
    }

    public function addHttpApi(): void
    {
        $uuid = Str::uuid()->toString();
        $name = 'function-' . Str::random(6);

        $this->httpApis->put($uuid, new HttpApi([
            'name' => $name,
            'memorySize' => 1024,
            'timeout' => 5,
            'reservedConcurrency' => 5,
            'provisionedConcurrency' => 5,
            'warmerEnabled' => true,
        ]));
    }

    public function getServiceNameProperty(): string
    {
        return Str::slug($this->appName);
    }

    public function getGeneratedYmlProperty(): string
    {
        $data = [
            'service' => $this->serviceName,
            'provider' => [
                'name' => 'aws',
                'region' => $this->awsRegion,
                'runtime' => 'provided.al2',
                'stage' => $this->stageName,
                'environment' => [
                    'APP_NAME' => $this->appName,
                    'APP_ENV' => $this->stageName,
                    'APP_KEY' => '${ssm:/'.$this->serviceName.'-'.$this->stageName.'/APP_KEY',
                ],
            ],
            'functions' => collect([
                $this->generateScheduler(),
                $this->generateHttpApiFunctions(),
            ])->mapWithKeys(fn($a) => $a)->toArray(),
        ];

        return Yaml::dump($data, 4, 2, Yaml::DUMP_OBJECT_AS_MAP);
    }

    protected function generateScheduler(): array
    {
        if (! $this->scheduler->enabled) {
            return [];
        }

        return [
            $this->scheduler->name => [
                'handler' => 'artisan',
                'memorySize' => $this->scheduler->memorySize,
                'timeout' => $this->scheduler->timeout,
                'layers' => [
                    '${bref:layer.' . $this->phpVersion . '-fpm}',
                    '${bref:layer.console}',
                ],
                'events' => [
                    [
                        'schedule' => [
                            'rate' => 'rate(1 minute)',
                            'input' => '"schedule:run --ansi --no-interaction --quiet"',
                        ],
                    ],
                ],
            ],
        ];
    }

    protected function generateHttpApiFunctions(): array
    {
        return $this->httpApis->mapWithKeys(function (HttpApi $httpApi) {
            $events = [
                [
                    'httpApi' => '*',
                ],
            ];

            if ($httpApi->warmerEnabled) {
                $events[] = [
                    'schedule' => [
                        'rate' => 'rate(5 minutes)',
                        'input' => [
                            'warmer' => true,
                            'concurrency' => $httpApi->reservedConcurrency,
                        ],
                    ],
                ];
            }

            return [
                $httpApi->name => [
                    'handler' => 'public/index.php',
                    'memorySize' => $httpApi->memorySize,
                    'timeout' => $httpApi->timeout,
                    'reservedConcurrency' => $httpApi->reservedConcurrency,
                    'provisionedConcurrency' => $httpApi->provisionedConcurrency,
                    'layers' => [
                        '${bref:layer.' . $this->phpVersion . '-fpm}',
                    ],
                    'events' => $events,
                ],
            ];
        })->toArray();
    }
}

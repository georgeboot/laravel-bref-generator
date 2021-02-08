<?php

namespace App\Http;

use Illuminate\Support\Str;
use Livewire\Component;
use Symfony\Component\Yaml\Yaml;

class Generator extends Component
{
    public string $appName = 'Your Awesome New App';
    public string $stageName = 'production';
    public string $awsRegion = 'us-east-1';
    public string $phpVersion = 'php-80';
    public array $httpApis = [];

    public function mount()
    {
        $this->addHttpApi();
    }

    public function render()
    {
        return view('generator');
    }

    public function addHttpApi(): void
    {
        $uuid = Str::uuid()->toString();
        $name = 'function-'.Str::random(6);

        $this->httpApis[$uuid] = [
            'name' => $name,
            'memorySize' => 1024,
            'timeout' => 5,
            'reservedConcurrency' => 5,
            'warmer' => 'enabled',
        ];
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
                $this->generateHttpApiFunctions(),
            ])->mapWithKeys(fn($a) => $a)->toArray(),
        ];

        return Yaml::dump($data, 4, 2,Yaml::DUMP_OBJECT_AS_MAP);
    }

    protected function generateHttpApiFunctions(): array
    {
        return collect($this->httpApis)->mapWithKeys(function (array $httpApi) {
            $events = [
                [
                    'httpApi' => '*',
                ],
            ];

            if ($httpApi['warmer'] === 'enabled') {
                $events[] = [
                    'schedule' => [
                        'rate' => 'rate(5 minutes)',
                        'input' => [
                            'warmer' => true,
                            'concurrency' => $httpApi['reservedConcurrency'],
                        ],
                    ],
                ];
            }

            return [
                $httpApi['name'] => [
                    'handler' => 'public/index.php',
                    'memorySize' => $httpApi['memorySize'],
                    'timeout' => $httpApi['timeout'],
                    'reservedConcurrency' => $httpApi['reservedConcurrency'],
                    'layers' => [
                        '${bref:layer' . $this->phpVersion . '-fpm}',
                    ],
                    'events' => $events,
                ],
            ];
        })->toArray();
    }
}

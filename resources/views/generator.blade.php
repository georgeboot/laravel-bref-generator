<div class="px-4 py-8 sm:px-0">

  <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
    <aside class="py-6 px-2 sm:px-6 lg:py-0 lg:px-0 lg:col-span-3">
      <nav class="space-y-1">
{{--        <!-- Current: "bg-gray-50 text-indigo-700 hover:text-indigo-700 hover:bg-white", Default: "text-gray-900 hover:text-gray-900 hover:bg-gray-50" -->--}}
{{--        <a href="#" class="bg-gray-50 text-indigo-700 hover:text-indigo-700 hover:bg-white group rounded-md px-3 py-2 flex items-center text-sm font-medium" aria-current="page">--}}
{{--          <!-- Current: "text-indigo-500 group-hover:text-indigo-500", Default: "text-gray-400 group-hover:text-gray-500" -->--}}
{{--          <!-- Heroicon name: outline/user-circle -->--}}
{{--          <svg class="text-indigo-500 group-hover:text-indigo-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />--}}
{{--          </svg>--}}
{{--          <span class="truncate">--}}
{{--            Account--}}
{{--          </span>--}}
{{--        </a>--}}

        <button type="button" wire:click="addHttpApi" class="text-gray-900 hover:text-gray-900 hover:bg-gray-50 group rounded-md px-3 py-2 flex items-center text-sm font-medium">
          <svg class="text-gray-400 group-hover:text-gray-500 flex-shrink-0 -ml-1 mr-3 h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
          <span class="truncate">
            Add HTTP API
          </span>
        </button>
      </nav>
    </aside>

    <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-9">
      <form action="#" method="POST">
        <div class="shadow sm:rounded-md sm:overflow-hidden">
          <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
            <div>
              <h3 class="text-lg leading-6 font-medium text-gray-900">
                Base Settings
              </h3>
              <p class="mt-1 text-sm text-gray-500">
                Let's start off with some basic settings.
              </p>
            </div>

            <div class="grid grid-cols-6 gap-6">
              <div class="col-span-6 sm:col-span-4">
                <label for="appName" class="block text-sm font-medium text-gray-700">
                  App Name
                </label>
                <input type="text" id="appName" wire:model="appName" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <p class="mt-2 text-sm text-gray-500">
                  The name of your app. The name you provide will be used internally as a base for further options.
                </p>
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="awsRegion" class="block text-sm font-medium text-gray-700">
                  AWS Region
                </label>
                <select id="awsRegion" wire:model="awsRegion" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <option value="us-east-1">US East (N. Virginia) (us-east-1)</option>
                  <option value="us-east-2">US East (Ohio) (us-east-2)</option>
                  <option value="us-west-1">US West (N. California) (us-west-1)</option>
                  <option value="us-west-2">US West (Oregon) (us-west-2)</option>
                  <option value="ap-east-1">Asia Pacific (Hong Kong) (ap-east-1)</option>
                  <option value="ap-south-1">Asia Pacific (Mumbai) (ap-south-1)</option>
                  <option value="ap-northeast-2">Asia Pacific (Seoul) (ap-northeast-2)</option>
                  <option value="ap-southeast-1">Asia Pacific (Singapore) (ap-southeast-1)</option>
                  <option value="ap-southeast-2">Asia Pacific (Sydney) (ap-southeast-2)</option>
                  <option value="ap-northeast-1">Asia Pacific (Tokyo) (ap-northeast-1)</option>
                  <option value="af-south-1">Africa (Cape Town) (af-south-1)</option>
                  <option value="ca-central-1">Canada (Central) (ca-central-1)</option>
                  <option value="eu-central-1">EU (Frankfurt) (eu-central-1)</option>
                  <option value="eu-west-1">EU (Ireland) (eu-west-1)</option>
                  <option value="eu-west-2">EU (London) (eu-west-2)</option>
                  <option value="eu-west-3">EU (Paris) (eu-west-3)</option>
                  <option value="eu-north-1">EU (Stockholm) (eu-north-1)</option>
                  <option value="eu-south-1">EU (Milan) (eu-south-1)</option>
                  <option value="me-south-1">Middle East (Bahrain) (me-south-1)</option>
                  <option value="sa-east-1">South America (São Paulo) (sa-east-1)</option>
                </select>
              </div>

              <div class="col-span-6 sm:col-span-1">
                <label for="phpVersion" class="block text-sm font-medium text-gray-700">
                  PHP Version
                </label>
                <select id="phpVersion" wire:model="phpVersion" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <option value="php-74">7.4</option>
                  <option value="php-80">8.0</option>
                </select>
              </div>

              <div class="col-span-6 sm:col-span-3">
                <label for="stageName" class="block text-sm font-medium text-gray-700">
                  Stage Name
                </label>
                <input type="text" id="stageName" wire:model="stageName" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              </div>
            </div>
          </div>
        </div>
      </form>

      @foreach ($httpApis as $key => $httpApi)
        <form wire:key="httpapi-{{ $key }}" action="#" method="POST">
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
              <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                  HTTP API {{ $loop->iteration }}
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                  Everyting related to HTTP API {{ $loop->iteration }}.
                </p>
              </div>

              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-3 sm:col-span-2">
                  <label for="name" class="block text-sm font-medium text-gray-700">
                    Function name
                  </label>
                  <input type="text" id="name" wire:model="httpApis.{{ $key }}.name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="col-span-3 sm:col-span-2">
                  <label for="memorySize" class="block text-sm font-medium text-gray-700">
                    memorySize
                  </label>
                  <input type="text" id="memorySize" wire:model="httpApis.{{ $key }}.memorySize" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="col-span-3 sm:col-span-2">
                  <label for="timeout" class="block text-sm font-medium text-gray-700">
                    timeout
                  </label>
                  <input type="text" id="timeout" wire:model="httpApis.{{ $key }}.timeout" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="col-span-3 sm:col-span-2">
                  <label for="reservedConcurrency" class="block text-sm font-medium text-gray-700">
                    reservedConcurrency
                  </label>
                  <input type="text" id="reservedConcurrency" wire:model="httpApis.{{ $key }}.reservedConcurrency" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label for="enableWarmer" class="block text-sm font-medium text-gray-700">
                    Warmer
                  </label>
                  <select id="enableWarmer" wire:model="httpApis.{{ $key }}.warmer" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="enabled">Enabled</option>
                    <option value="disabled">Disabled</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </form>
      @endforeach

      <form action="#" method="POST">
        <div class="shadow sm:rounded-md sm:overflow-hidden">
          <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
            <div>
              <h3 class="text-lg leading-6 font-medium text-gray-900">
                Output
              </h3>
              <p class="mt-1 text-sm text-gray-500">
                These are the auto-generated files.
              </p>
            </div>

            <fieldset>
              <legend class="text-base font-medium text-gray-900">
                serverless.yml
              </legend>
              <pre class="text-xs p-4 bg-gray-50 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ $this->generatedYml }}</pre>
            </fieldset>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>

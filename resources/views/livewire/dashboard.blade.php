<x-slot:title>Dashboard | statusly</x-slot:title>

<div class="w-full max-w-6xl mx-auto">
    <h1 class="mb-10 font-medium text-3xl text-slate-800">Welcome back, <span class="font-semibold">{{ $user->name }}</span>!</h1>
    <h2 class="mb-2 font-medium text-lg text-slate-700">Your services</h2>
    @if($services->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
            @foreach($services as $service)
                <div class="bg-white rounded-lg p-5 shadow">
                    <div class="flex items-center justify-between">
                        <h3>{{ $service->name }}</h3>
                        <div>
                            @if ($service->status === 'operational')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-green-500">
                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                </svg>
                            @elseif ($service->status === 'maintenance')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-yellow-500">
                                    <path fill-rule="evenodd" d="M12 6.75a5.25 5.25 0 0 1 6.775-5.025.75.75 0 0 1 .313 1.248l-3.32 3.319c.063.475.276.934.641 1.299.365.365.824.578 1.3.64l3.318-3.319a.75.75 0 0 1 1.248.313 5.25 5.25 0 0 1-5.472 6.756c-1.018-.086-1.87.1-2.309.634L7.344 21.3A3.298 3.298 0 1 1 2.7 16.657l8.684-7.151c.533-.44.72-1.291.634-2.309A5.342 5.342 0 0 1 12 6.75ZM4.117 19.125a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Z" clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-red-500">
                                    <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg p-4 shadow mb-8">
            <x-empty-state message="You don't have any Services yet.">
                <x-button as="a" href="{{ route('services.create') }}" wire:navigate class="mt-4">Add your first service</x-button>
            </x-empty-state>
        </div>
    @endif
    <h2 class="mb-2 font-medium text-lg text-slate-700">Recent incidents</h2>
    <div class="bg-white rounded-lg shadow">
        @if($incidents->isNotEmpty())
            <table class="w-full text-left table-auto min-w-max">
                <thead>
                <tr>
                    <th class="w-2/3 p-3 ps-4 border-b border-slate-200">
                        <div class="block text-sm font-normal text-slate-500">Message</div>
                    </th>
                    <th class="p-3 pe-4 border-b border-slate-200">
                        <div class="block text-sm font-normal text-slate-500">Created at</div>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($incidents as $incident)
                    <tr wire:key="{{ $incident->id }}">
                        <td class="p-3 ps-4 border-b border-slate-100">
                            <div class="block text-sm font-normal text-slate-900">{{ $incident->message }}</div>
                        </td>
                        <td class="p-3 pe-4 border-b border-slate-100">
                            <div class="block text-sm font-normal text-slate-900">{{ $incident->created_at->format('d. m. Y H:i:s') }}</div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="p-4">
                <x-empty-state message="No recent incidents.">
                    <x-slot:icon>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </x-slot:icon>
                </x-empty-state>
            </div>
        @endif
    </div>
</div>

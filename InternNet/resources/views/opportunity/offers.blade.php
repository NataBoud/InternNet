@php
    use Illuminate\Support\Carbon
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes offres') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

            <a href="{{ route('opportunities.create') }}" >
                <x-secondary-button class="mb-6 ">
                    {{ __('Creer une offre') }}
                </x-secondary-button>
            </a>

            @session('success')
            <p>{{$value}}</p>
            @endsession

            @if($opportunities->isEmpty())
                <p>Aucune opportunité disponible pour le moment.</p>
            @else
                <div class="grid gap-6 lg:grid-cols-3 lg:gap-8">
                    @foreach($opportunities as $opportunity)

                        <a href="{{ route('opportunities.show', $opportunity->id) }}" class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]">
                            <div >

                                <h2 class="text-xl font-bold text-indigo-900 text-opacity-90 mb-1">{{ $opportunity->title }}</h2>
                                <p class="uppercase text-sm mt-2 text-gray-800">{{ $opportunity->user->company->name }} </p>
                                <p class="text-sm  text-gray-800 mb-4">{{ $opportunity->user->company->localisation }}</p>
                                <span class="text-sm bg-gray-200 text-gray-700 p-1.5 rounded-md font-bold">{{ $opportunity->contract->title }}</span>

                                <div class="flex mt-4">
                                    <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
                                    </svg>
                                    <p class="ml-2 text-indigo-900 text-md">Postuler maintenant</p>

                                </div>
                                <p class="text-sm text-gray-500 line-clamp-2 mt-2 mb-4">{{ $opportunity->description }} </p>

                                <span class="text-sm text-gray-400">Offre publiée: {{ Carbon::parse($opportunity->created_at)->format('d/m/Y') }}</span>

                            </div>
                        </a>
                    @endforeach
                </div>
            @endif


        </div>
    </div>
</x-app-layout>

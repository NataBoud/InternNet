@php
    use Illuminate\Support\Carbon
@endphp


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $opportunity->title }}
        </h2>
    </x-slot>
    <main class="mt-6">

        <div class="flex justify-center p-6">
            <div class="bg-white p-6 rounded-lg shadow-md w-full lg:w-1/2">
                @if ($opportunity)
                    <h2 class="text-xl font-bold text-indigo-900 text-opacity-90 mb-1">
                        {{ $opportunity->title }}
                    </h2>
                    <p class="uppercase text-sm mt-2 text-gray-800">
                        {{ $opportunity->user->company->name }}
                    </p>
                    <p class="text-sm  text-gray-800 mb-4">
                        {{ $opportunity->user->company->localisation }}
                    </p>

                    <p class="text-sm text-gray-500 mb-4">
                        {{ $opportunity->user->company->description }}
                    </p>
                    <span class="text-sm bg-gray-200 text-gray-700 p-1.5 rounded-md font-bold">
                        {{ $opportunity->contract->title }}
                    </span>
                    <p class="text-sm text-gray-500 mt-4">
                        Date début: {{ Carbon::parse($opportunity->start)->format('d/m/Y') }}
                    </p>

                    {{-- Afficher la date de fin seulement si elle n'est pas null --}}
                    @if ($opportunity->end)
                        <p class="text-sm text-gray-500">Date de fin: {{ Carbon::parse($opportunity->end)->format('d/m/Y') }}</p>
                    @endif

                    <p class="text-md text-gray-500 mt-2 mb-4">{{ $opportunity->description }}</p>
                    <span class="text-sm text-gray-400">
                        Offre publiée: {{ Carbon::parse($opportunity->created_at)->format('d/m/Y') }}
                    </span>
                @else
                    <p class="text-red-500">Article introuvable</p>
                @endif


                {{-- BUTTONS SUPPRIMER MODIFIER --}}
                <div class="flex mt-6 justify-between">
                    @auth
                        @if ($opportunity->user_id == auth()->id())
                            <div>
                                <x-nav-link :href="route('opportunities.offers')" :active="request()->routeIs('opportunities.offers')" class="mt-3 pt-2">

                                    {{ __('Retour') }}

                                </x-nav-link>
                            </div>
                            <div class="flex">
                                <a href="{{ route('opportunities.edit', $opportunity->id) }}" >
                                    <x-primary-button class="mt-3 mr-2">
                                        {{ __('Modifier') }}
                                    </x-primary-button>
                                </a>
                                <form action="{{ route('opportunities.destroy', $opportunity->id) }}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button class="mt-3">
                                        {{ __('Supprimer') }}
                                    </x-danger-button>
                                </form>
                            </div>
                        @endif
                    @endauth
                    @guest
                        <div>
                            <x-nav-link :href="route('opportunities.index')" :active="request()->routeIs('opportunities.index')" class="mt-3 pt-2">

                                {{ __('Retour') }}

                            </x-nav-link>
                        </div>
                        <div>
                            <a href="mailto:{{ $opportunity->email }}" target="_blank">
                                <x-primary-button class="mt-3">
                                    {{ __('Postuler') }}
                                </x-primary-button>
                            </a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </main>
</x-app-layout>


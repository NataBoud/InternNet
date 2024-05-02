<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier') }}
        </h2>
    </x-slot>
    <main class="mt-6">

        <div class="flex justify-center p-6">
            <div class="bg-white p-6 rounded-lg shadow-md w-full lg:w-1/2">
                <form action="{{ route('opportunities.update', $opportunity->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mt-4">Titre de l'offre</label>
                        <input id="title" type="text" name="title" class="mt-1 p-2 w-full border rounded-md" value="{{ $opportunity->title }}" required>
                    </div>

                    <div>
                        <label for="contract_id" class="block text-sm font-medium text-gray-700 mt-4">Type de contrat</label>
                        <select id="contract" name="contract_id" class="mt-1 p-2 w-full border rounded-md">
                            <option value="" disabled selected>Choisir le type de contrat</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="start" class="block text-sm font-medium text-gray-700 mt-4">Début</label>
                        <input id="start" type="date" name="start" class="mt-1 p-2 w-full border rounded-md" value="{{ $opportunity->start }}" required>
                    </div>

                    <div>
                        <label for="end" class="block text-sm font-medium text-gray-700 mt-4">Fin</label>
                        <input id="end" type="date" name="end" class="mt-1 p-2 w-full border rounded-md" value="{{ $opportunity->end }}">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mt-4">Description</label>
                        <textarea id="description" name="description" class="mt-1 p-2 w-full border rounded-md h-32" required>{{ $opportunity->description }}</textarea>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mt-4">Email</label>
                        <input id="email" type="email" name="email" value="{{ $opportunity->email }}" class="mt-1 p-2 w-full border rounded-md mb-6" >
                    </div>


                    <div class="flex justify-end mt-6">
                        <x-primary-button type="submit"  class="mr-2">
                            {{ __('Mettre à jour') }}
                        </x-primary-button>
                        <a href="{{ route('opportunities.show', $opportunity->id) }}">
                            <x-secondary-button>
                                {{ __('Annuler') }}
                            </x-secondary-button>
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </main>
</x-app-layout>

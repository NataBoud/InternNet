<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Opportunity;
use App\Http\Requests\StoreOpportunityRequest;
use App\Http\Requests\UpdateOpportunityRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OpportunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $opportunities = Opportunity::orderBy('created_at', 'desc')->get();
        return view('welcome', compact('opportunities'));
    }

    public function search(Request $request): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $query = $request->input('query');
        $opportunities = Opportunity::search($query)->get();

        return view('welcome', ['opportunities' => $opportunities, 'query' => $query]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $types = Contract::all();
        return view('opportunity.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOpportunityRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();

        Opportunity::create([
            ...$validated,
            'user_id' => auth()->id(),
            'company_id' => auth()->user()->company->id,
            'contract_id' => $validated['contract_id'],// Ajout du contrat
        ]);

        return redirect(route('opportunities.offers'))->with('message', 'Opportunity created.');
    }

    /**
     * Display the specified resource.
     */
    public function showUserOffers(Opportunity $opportunity): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $opportunities = Opportunity::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('opportunity.offers', compact('opportunities'));
    }

    public function show($id): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $opportunity = Opportunity::findOrFail($id);
        return view('opportunity.show', compact('opportunity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $opportunity = Opportunity::findOrFail($id);
        $types = Contract::all(); // Получить все типы контрактов
        return view('opportunity.edit', compact('opportunity', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOpportunityRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        // Valider la requête
        $validated = $request->validated();

        // Rechercher l'opportunité par ID
        $opportunity = Opportunity::findOrFail($id);

        // Mettre à jour les attributs de l'opportunité avec les données validées
        $opportunity->update($validated);

        // Redirection avec un message de succès
        return redirect()
            ->route('opportunities.show', $opportunity->id)
            ->with('success', 'Opportunité mise à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $article = Opportunity::findOrFail($id);

        $article->delete();

        return redirect('/')
            ->with('success', 'Opportunité supprimé avec succès');
    }
}

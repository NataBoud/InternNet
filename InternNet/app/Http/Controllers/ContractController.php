<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.dashboard');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContractRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();

        $contract = new Contract([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        $contract->save();

        return redirect('admin/dashboard')->with('success', 'Type de contrat créé avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $contracts = Contract::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('contracts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractRequest $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        //
    }
}

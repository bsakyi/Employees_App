<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Tables\Countries;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\Facades\Splade;
use App\Http\Requests\StoreCountryRequest;
use ProtoneMedia\Splade\FormBuilder\Input;
use App\Http\Requests\UpdateCountryRequest;
use ProtoneMedia\Splade\FormBuilder\Submit;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('admin.countries.index', [
            'countries'=> Countries::Class
        ]);
    }

    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCountryRequest $request)
    {
        Country::create($request->validated());
        Splade::toast('Country Created')->autoDismiss(3);

    }

    /**
     * Display the specified resource.
     */
  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        $form = SpladeForm::make()
        ->action(route('admin.countries.update', $country))
        ->fields([
            Input::make('country_code')->label('Country Code'),
            Input::make('name')->label('User Name'),
            Submit::make()->label('Update'),
        ])
         ->fill($country)
        ->class('space-y-4 bg-white rounded p-4')
         ->method('PUT');

    return view('admin.countries.edit', [
        'form' => $form,
        'country' => $country
    ]);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->update($request->validated());
        Splade::toast('Country updated')->autoDismiss(3);
        
        return to_route('admin.countries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();
        Splade::toast('Country Deleted')->autoDismiss(3);
        return back();
    }
}

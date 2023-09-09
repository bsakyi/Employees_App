<?php

namespace App\Tables;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use ProtoneMedia\Splade\AbstractTable;
use Spatie\QueryBuilder\AllowedFilter;

class Countries extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return true;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */

   public function for()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhere('country_code', 'LIKE', "%{$value}%");
                        
                });
            });
        });

        return QueryBuilder::for(Country::class)
            ->defaultSort('id')
            ->allowedSorts(['id', 'name', 'country_code'])
            ->allowedFilters(['id', 'name', 'country_code', $globalSearch]);
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
        ->withGlobalSearch(columns: ['id', 'name', 'country_code']) 
        ->column('name', sortable: true)
        ->column('country_code', sortable: true)
        ->column('id', sortable: true)
        ->column('created_at', sortable: true)
        ->rowLink(function(Country $country){
            return route('admin.countries.edit', $country);
        })
        ->column('action')
        ->paginate(15);

            // ->searchInput()
            // ->selectFilter()
            // ->withGlobalSearch()

            // ->bulkAction()
            // ->export()
    }
}

<?php

namespace App\Http\Controllers\Admin\Builder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buildercategory;
use App\Models\Buildersubcategory;
use DataTables;
class BuildersubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.builder.subcategory.sub-category-list");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function getbuildersubcategory(){
        $query=Subcategory::with('buildersubcategories')->orderby('id')->get();
        $totalData =count($query);
        $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
        return Datatables::of($query)
        ->addColumn('category_name', function ($query) {
            return $query->categorys->category_name;
        })
        ->addColumn('sub_category_name', function ($query) {
            return $query->sub_category_name;
        })
        ->addColumn('action', function ($query) {
            return $query->id;
        })->rawColumns(['action'])
        ->make('true');
    }

}

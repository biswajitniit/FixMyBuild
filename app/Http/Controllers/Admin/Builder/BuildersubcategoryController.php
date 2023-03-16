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
        $category = Buildercategory::where('status','Active')->orderBy('builder_category_name')->get();
		return view("admin.builder.subcategory.add-sub-category",compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation for required fields (and using some regex to validate our numeric value)
        $this->validate($request, [
            'builder_category_id'       => 'required',
            'builder_subcategory_name' => 'required',
        ],[
            'builder_category_id.required' => 'Please select one category',
            'builder_subcategory_name.required' => 'Please enter a sub category name',
        ]);
        // Getting values from the blade template form
        $category = new Buildersubcategory([
            'builder_category_id'      => $request->post('builder_category_id'),
            'builder_subcategory_name' => $request->post('builder_subcategory_name'),
            'status'                   => $request->post('status')
        ]);
        $category->save();
        //return redirect('/buildercategory')->with('success', 'Category added successfully.');   // -> resources/views/stocks/index.blade.php
        return redirect()->back()->with('message', 'Sub Category added successfully.');
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
    public function delete(Request $request)
    {
        $subcategory = Buildersubcategory::find($request->id);
        $subcategory->delete(); // Easy right?
        echo "removed";
    }

    function getbuildersubcategory(){
        $query=Buildersubcategory::with('Buildercategory')->orderby('id')->get();
        $totalData =count($query);
        $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
        return Datatables::of($query)
        ->addColumn('builder_category_name', function ($query) {
            return $query->Buildercategory->builder_category_name;
           return 'biswajit';
        })
        ->addColumn('builder_subcategory_name', function ($query) {
            return $query->builder_subcategory_name;
        })
        ->addColumn('status', function ($query) {
            if($query->status=='Active'){
                $mstatus='Active';
            }else{
                $mstatus='InActive';
            }
            return $mstatus;
        })
        ->addColumn('action', function ($query) {
            //return $query->id;
            $editUrl = route('buildersubcategory.edit', $query->id);
            //$deleteUrl = route('buildercategory.destroy', $query->id);
            return '<a href="'.$editUrl.'" title="Edit Builder Category"><i class="mdi mdi-table-edit"></i></a> | <a href="jasacript:void(0)" title="Trash Builder Category" onclick="return deletebuildercategory('.$query->id.')"><i class="mdi mdi-delete-forever"></i></a>';

        })->rawColumns(['action'])
        ->make('true');
    }

}

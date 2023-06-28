<?php
namespace App\Http\Controllers\Admin\Builder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buildercategory;
use DataTables;

class BuildercategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.builder.category.category-list");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.builder.category.add-category");
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
            'builder_category_name' => 'required'
        ],[
            'builder_category_name.required' => 'Please enter a category name',
        ]);
        // Getting values from the blade template form
        $category = new Buildercategory([
            'builder_category_name' => $request->post('builder_category_name'),
            'status' => $request->post('status')
        ]);
        $category->save();
        //return redirect('/buildercategory')->with('success', 'Category added successfully.');   // -> resources/views/stocks/index.blade.php
        return redirect()->back()->with('message', 'Category added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buildercategory = Buildercategory::find($id);
        return view('admin.builder.category.edit-category', compact('buildercategory'));  // -> resources/views/stocks/edit.blade.php
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
        // Validation for required fields (and using some regex to validate our numeric value)
        $this->validate($request, [
            'builder_category_name' => 'required'
        ],[
            'builder_category_name.required' => 'Please enter a category name',
        ]);
        $buildercategory = Buildercategory::find($id);
        // Getting values from the blade template form
        $buildercategory->builder_category_name =  $request->get('builder_category_name');
        $buildercategory->status = $request->get('status');
        $buildercategory->save();

        return redirect()->back()->with('message', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $category = Buildercategory::find($request->id);
        $category->delete(); // Easy right?
        echo "removed";

    }

    public function getbuildercategory(Request $request){
        $query=Buildercategory::orderby('builder_category_name')->get();
        $totalData =count($query);
        $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
        return Datatables::of($query)
        ->addColumn('builder_category_name', function ($query) {
            return $query->builder_category_name;
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
            $editUrl = route('buildercategory.edit', $query->id);
            //$deleteUrl = route('buildercategory.destroy', $query->id);
            return '<a href="'.$editUrl.'" title="Edit Builder Category"><i class="mdi mdi-table-edit"></i></a> | <a href="jasacript:void(0)" title="Trash Builder Category" onclick="return deletebuildercategory('.$query->id.')"><i class="mdi mdi-delete-forever"></i></a>';
        })->rawColumns(['action'])
        ->make('true');
    }
}

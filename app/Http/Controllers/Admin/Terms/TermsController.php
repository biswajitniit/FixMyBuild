<?php

namespace App\Http\Controllers\Admin\Terms;

use App\Http\Controllers\Controller;
use App\Models\Terms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = Terms::latest()->paginate(5);
        return view('admin.terms.index',compact('terms'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.terms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required',
            'terms_order'     => 'required',
        ],[
            'name.required' => 'Please enter terms name',
            'terms_order.required'  => 'Please enter terms order',
        ]);

    	$terms = new Terms();
            $terms->name                    = $request['name'];
            $terms->terms_order             = $request['terms_order'];
            $terms->terms_description       = $request['terms_description'];
            $terms->status                  = $request['status'];
		$terms->save();
        return redirect()->route('terms.index')->with('success','Terms created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Terms  $terms
     * @return \Illuminate\Http\Response
     */
    public function show(Terms $terms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Terms  $terms
     * @return \Illuminate\Http\Response
     */
    public function edit(Terms $terms, $id)
    {
        $termsdata = Terms::where('id',$id)->first();
        return view('admin.terms.edit',compact('termsdata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Terms  $terms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'    => 'required',
            'terms_order'     => 'required',
        ],[
            'name.required'         => 'Please enter terms name',
            'terms_order.required'  => 'Please enter terms order',
        ]);
        $data = array(
            'name'                     => $request['name'],
            'terms_order'              => $request['terms_order'],
            'terms_description'        => $request['terms_description'],
            'status'                   => $request['status']
        );
        Terms::where('id', $id)->update($data);
        return redirect()->route('terms.index')->with('success','Terms updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Terms  $terms
     * @return \Illuminate\Http\Response
     */
    public function destroy(Terms $terms)
    {
        //
    }
}

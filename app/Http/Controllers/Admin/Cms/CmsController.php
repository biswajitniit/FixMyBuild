<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cms = Cms::latest()->paginate(5);
        return view('admin.cms.index',compact('cms'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cms.create');
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
            'cms_pagename'    => 'required',
            'cms_heading'     => 'required',
            'cms_description' => 'required',
        ],[
            'banner_order.required' => 'Please enter banner order',
            'banner_text.required'  => 'Please enter banner text',
            'bimage.required'       => 'Please select banner image',
        ]);

    	$cms = new Cms();
            $cms->cms_pagename            = $request['cms_pagename'];
            $cms->cms_heading             = $request['cms_heading'];
            $cms->cms_description         = $request['cms_description'];
            $cms->status                  = $request['status'];
		$cms->save();
        return redirect()->route('cms.index')->with('success','Cms created successfully.');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cms  $cms
     * @return \Illuminate\Http\Response
     */
    public function show(Cms $cms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cms  $cms
     * @return \Illuminate\Http\Response
     */
    public function edit(Cms $cms, $id)
    {
        $cmsdata = Cms::where('id',$id)->first();
        return view('admin.cms.edit',compact('cmsdata'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cms  $cms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'cms_pagename'    => 'required',
            'cms_heading'     => 'required',
            'cms_description' => 'required',
        ],[
            'cms_pagename.required'          => 'Please enter Pagename',
            'cms_heading.required'           => 'Please enter heading',
            'cms_description.required'       => 'Please enter description',
        ]);
        $data = array(
            'cms_pagename'             => $request['cms_pagename'],
            'cms_heading'              => $request['cms_heading'],
            'cms_description'          => $request['cms_description'],
            'status'                   => $request['status']
        );
        Cms::where('id', $id)->update($data);
        return redirect()->route('cms.index')->with('success','Cms updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cms  $cms
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cms $cms)
    {

    }
}

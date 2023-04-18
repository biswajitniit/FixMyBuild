@extends('layouts.admin')
@section('title', 'Cms List')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header flex-wrap">
        <div class="header-left">
        </div>
        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">

          <button type="button" onclick="location.href='{{ route("cms.create") }}'" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
            <i class="mdi mdi-plus-circle"></i> Add Cms </button>
        </div>
      </div>

      @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
      @endif


      @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
      @endif


      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Cms Table</h4>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                {{-- <table id="order_listing" class="table order_listing"> --}}
                <table class="table table-bordered table-striped mb-none" id="my-table">
                  <thead>
                    <tr class="bg-primary text-white">
                      <th>Cms Page Name</th>
                      <th>Cms Heading</th>

                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                   <tbody>
                        @foreach ($cms as $row)
                            <tr>
                                <td>{{ $row->cms_pagename }}</td>
                                <td>{{ $row->cms_heading }}</td>

                                <td>{{ $row->status }}</td>
                                <td>
                                    <form action="{{ route('cms.destroy',$row->id) }}" method="POST">
                                        <a class="btn btn-primary" href="{{ route('cms.edit',$row->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    <tbody>
                </table>

                {!! $cms->links() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    @include('admin.layout.footer')
  </div>
  <!-- main-panel ends -->



@push('scripts')
<script type="text/javascript">

</script>
@endpush
@endsection

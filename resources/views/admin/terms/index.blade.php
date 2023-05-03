@extends('layouts.admin')
@section('title', 'Terms List')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header flex-wrap">
        <div class="header-left">
        </div>
        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
          <button type="button" onclick="location.href='{{ route("terms.create") }}'" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
            <i class="mdi mdi-plus-circle"></i> Add Terms Category </button>
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
          <h4 class="card-title">Terms Table</h4>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                {{-- <table id="order_listing" class="table order_listing"> --}}
                <table class="table table-bordered table-striped mb-none" id="my-table">
                  <thead>
                    <tr class="bg-primary text-white">
                      <th>Name</th>
                      <th>Terms Order No</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                   <tbody>
                        @foreach ($terms as $row)
                            <tr>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->terms_order }}</td>
                                <td>{{ $row->status }}</td>
                                <td>
                                    <form action="{{ route('terms.destroy',$row->id) }}" method="POST">
                                        <a class="btn btn-primary" href="{{ route('terms.edit',$row->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    <tbody>
                </table>

                {!! $terms->links() !!}
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

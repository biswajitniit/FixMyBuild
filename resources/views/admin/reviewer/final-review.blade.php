@extends('layouts.admin')
@section('title', 'Final review')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Final review </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin/project/awaiting-your-review')}}">Final review</a></li>
            <li class="breadcrumb-item active" aria-current="page">Final Review</li>
          </ol>
        </nav>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              {{-- <h4 class="card-title">Complete form validation</h4> --}}

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif



              <form class="cmxform" id="save_awaiting_review" method="post" action="{{ route('awaiting-your-review-final-save') }}" name="save_awaiting_review">
                @csrf
                <input type="hidden" name="projectid" value="{{Request::segment(4)}}">
                <div class="row">
                    <div class="row mt-15">
                        <div class="col-md-12">

                            @if($projectnotesandcommend)
                                @foreach ($projectnotesandcommend as $row)


                                @if($row->notes_for == 'customer')
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="example-textarea">Notes for {{ $row->notes_for }}</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" rows="5" id="editor-description">{{ $row->notes }}</textarea>
                                    </div>
                                </div>
                                @endif

                                @if($row->notes_for == 'internal')
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="example-textarea">Notes for {{ $row->notes_for }}</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" rows="5">{{ $row->notes }}</textarea>
                                    </div>
                                </div>
                                @endif

                                @if($row->notes_for == 'tradespeople')
                                <div class="mb-3 row">
                                    <label class="col-lg-3 col-form-label" for="example-textarea">Notes for {{ $row->notes_for }}</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" rows="5">{{ $row->notes }}</textarea>
                                    </div>
                                </div>
                                @endif

                                    @if($row->notes_for == 'tradespeople')
                                        <div class="mb-3 row">
                                            <label class="col-lg-3 col-form-label" for="example-textarea">Notes for {{ $row->notes_for }}</label>
                                            <div class="col-lg-9">
                                                <textarea class="form-control" rows="5"><?php echo $row->notes ?></textarea>
                                            </div>
                                        </div>
                                    @endif

                                    @if($row->notes_for == 'customer')
                                        <div class="mb-3 row">
                                            <label class="col-lg-3 col-form-label" for="example-textarea">Notes for {{ $row->notes_for }}</label>
                                            <div class="col-lg-9">
                                                <textarea class="form-control" rows="5" id="editor-description"><?php echo $row->notes ?></textarea>
                                            </div>
                                        </div>
                                    @endif

                                @endforeach
                            @endif


                            <a href="{{ url('/admin/project/awaiting-your-review-show/'.Request::segment(4)) }}" class="btn btn-light">Back</a>

                            <input type="submit" class="btn btn-primary" value="Send">
                        </div>
                    </div>
                </div>

              </form>
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
<script>
    CKEDITOR.replace( 'editor-description' );
</script>
@endpush
@endsection

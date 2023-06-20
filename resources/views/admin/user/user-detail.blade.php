@extends('layouts.admin')
@section('title', 'View User')
@section('content')

    <div class="main-panel">
        <div class="content-wrapper pb-0">
            <div class="page-header">
                <h3 class="page-title">View User</h3>
                <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                    @if (strtolower($user->status) == 'active')
                        <button type="button" class="badge badge-success px-3 py-2">
                            Active
                        </button>
                    @else
                        <button type="button" class="badge badge-danger px-3 py-2">
                            Inactive
                        </button>
                    @endif

                    @if (isset($trader_detail) && !empty($trader_detail))
                        @if (strtolower($trader_detail->approval_status) === 'pending')
                            <button type="button" class="badge badge-warning px-3 py-2 ms-3">
                            @elseif(strtolower($trader_detail->approval_status) === 'approved')
                                <button type="button" class="badge badge-success px-3 py-2 ms-3">
                                @else
                                    <button type="button" class="badge badge-danger px-3 py-2 ms-3">
                        @endif

                        {{ $trader_detail->approval_status }}
                        </button>
                    @endif

                </div>
            </div>

            @if (session()->has('message'))
                <div class="alert alert-danger">
                    {{ session()->get('message') }}
                </div>
            @endif


            <div class="stretch-card grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <h3 class="my-3">User's Detail</h3>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <h4>Name</h4>
                                    {{ $user->name }}
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <h4>User Type</h4>
                                    {{ $user->customer_or_tradesperson }}
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <h4>Email</h4>
                                    {{ $user->email }}
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <h4>Contact Number</h4>
                                    {{ $user->phone }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (isset($trader_detail) && !empty($trader_detail))
                <div class="stretch-card grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <h3 class="my-3">Company's Detail</h3>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-6 mb-3">
                                        <h4>Company Registration Number</h4>
                                        {{ $trader_detail->comp_reg_no }}
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <h4>Company Name</h4>
                                        {{ $trader_detail->comp_name }}
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <h4>Company Address</h4>
                                        {{ $trader_detail->comp_address }}
                                    </div>
                                    {{-- VAT DETAILS --}}
                                    @if (isset($trader_detail->vat_reg) && $trader_detail->vat_reg == 1)
                                        <div class="col-sm-6 mb-3">
                                            <h4>VAT Number</h4>
                                            {{ $trader_detail->vat_no }}
                                        </div>
                                        @if (isset($trader_detail->vat_comp_name) && !empty($trader_detail->vat_comp_name))
                                            <div class="col-sm-6 mb-3">
                                                <h4>VAT Company Name</h4>
                                                {{ $trader_detail->vat_comp_name }}
                                            </div>
                                        @endif
                                        @if (isset($trader_detail->vat_comp_address) && !empty($trader_detail->vat_comp_address))
                                            <div class="col-sm-6 mb-3">
                                                <h4>VAT Company Address</h4>
                                                {{ $trader_detail->vat_comp_address }}
                                            </div>
                                        @endif
                                    @endif
                                    {{-- VAT DETAILS ENDS --}}
                                    <div class="col-sm-12 mb-3">
                                        <h4>Company Description</h4>
                                        <div class="col-sm-12 mb-3">
                                            {{ strip_tags($trader_detail->comp_description) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stretch-card grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <h3 class="my-3">Contact Information</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <h4>Email</h4>
                                        {{ $trader_detail->email }}
                                    </div>

                                    @if (isset($trader_detail->phone_office) && !empty($trader_detail->phone_office))
                                        <div class="col-sm-6 mb-3">
                                            <h4>Office Number</h4>
                                            {{ $trader_detail->phone_office }}
                                        </div>
                                    @endif

                                    <div class="col-sm-6 mb-3">
                                        <h4>Mobile Number</h4>
                                        {{ $trader_detail->phone_number }}
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <h4>Company Role</h4>
                                        @if (strtolower($trader_detail->company_role) == 'other')
                                            {{ $trader_detail->designation }}
                                        @else
                                            {{ $trader_detail->company_role }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stretch-card grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <h3 class="my-3">Bank Details</h3>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <h4>Account Type</h4>
                                        {{ $trader_detail->bnk_account_type ?? 'No Information Provided' }}
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <h4>Account Name</h4>
                                        {{ $trader_detail->bnk_account_name ?? 'No Information Provided' }}
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <h4>Short Code</h4>
                                        {{ $trader_detail->bnk_sort_code ?? 'No Information Provided' }}
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <h4>Account Number</h4>
                                        {{ $trader_detail->bnk_account_number ?? 'No Information Provided' }}
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <h4>Default Contingency</h4>
                                        {{ $trader_detail->contingency ? $trader_detail->contingency."%" : 'No Information Provided' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stretch-card grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <h3 class="my-3">Areas Covered</h3>
                                    <hr>
                                    <div class="row">
                                        @foreach ($trader_areas as $trader_area)
                                            <div class="mb-1">
                                                {{ $trader_area->subareas->sub_area_type }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <h3 class="my-3">Services Provided</h3>
                                    <hr>
                                    <div class="row">
                                        @foreach ($trader_works as $trader_work)
                                            <div class="mb-1">
                                                {{ $trader_work->buildersubcategory->builder_subcategory_name }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stretch-card grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <h3 class="my-3">Attachments</h3>
                                <hr>

                                @foreach ($trader_files as $category => $files)
                                    <div class="row mb-2">
                                        <h4>
                                            @if (strtolower($category) == 'prev_project_img')
                                                Photo(s) of Previous Project(s)
                                            @elseif (strtolower($category) == 'trader_img')
                                                Photo Identification Of Tradesperson
                                            @elseif (strtolower($category) == 'company_address')
                                                Address Proof Of Company
                                            @else
                                                {{ Str::title(Str::replace('_', ' ', $category)) }}
                                            @endif
                                        </h4>
                                        <div class="mb-3">
                                            @foreach ($files as $file)
                                                <span class="me-3 badge badge-primary">
                                                    <a href="{{ $file->url }}" target="_blank"
                                                        class="text-white text-decoration-none">
                                                        {{ Str::limit($file->file_name, 15, '...') }}
                                                    </a>
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-wrap justify-content-end mt-2 mt-sm-0">
                    <form action="{{ route('admin.verify-account', request()->route('id')) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <button type="submit" name="action" value="Rejected"
                            class="badge badge-danger px-3 py-3 mx-3">Reject Account</button>
                        <button type="submit" name="action" value="Approved" class="badge badge-success px-3 py-3">Approve
                            Account</button>
                    </form>
                </div>
            @endif

        </div>
        <!-- content-wrapper ends -->
        @include('admin.layout.footer')
    </div>
    <!-- main-panel ends -->
@endsection

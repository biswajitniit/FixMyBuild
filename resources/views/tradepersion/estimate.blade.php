@extends('layouts.app')

@section('content')
    <!--Code area start-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center pt-5 fmb_titel">
                    <h1>Write Estimate</h1>
                    <ol class="breadcrumb mb-5">
                        <li class="breadcrumb-item">
                            <a href="index.html">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="projects-tradesperson.html">Project list</a></li>
                        <li class="breadcrumb-item active" aria-current="page">New estimate</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!--Code area end-->
    <!--Code area start-->
    <section class="pb-5">
        <div class="container">
            <form action="{{ route('tradepersion.p_estimate') }}" method="post">
                @csrf
                <input type="hidden" name="project_id" value="{{ $project_id }}" />
                <div class="row mb-5">
                    <div class="col-md-10 offset-md-1">
                        <div class="tell_about pl-details">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Customer’s project name</h5>
                                </div>
                                <div class="col-md-6">
                                    <h2>Renovate my house</h2>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h5>Location</h5>
                                </div>
                                <div class="col-md-6">
                                    <h2>London</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--// END-->
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center pt-5 mb-5 fmb_titel">
                                <h2>Create tasks</h2>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="white_bg mb-5 create-task-wp">
                            <div class="row" id="for_task">
                                <div class="col-12">
                                    <div class="form-check mb-2">
                                        <input type="radio" class="form-check-input mb" id="Fully_describe"
                                            name="describe_mode" value="Fully_describe">
                                        <h5>Please describe fully each task that needs to be undertaken.</h5>
                                    </div>
                                </div>
                                <div class="row task-wrap">
                                    <div class="col-md-1">
                                        <svg width="27" height="25" viewBox="0 0 27 25" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.5013 24.5832C10.8298 24.5832 9.25894 24.2658 7.7888 23.631C6.31866 22.997 5.03984 22.1363 3.95234 21.0488C2.86484 19.9613 2.00411 18.6825 1.37014 17.2123C0.735358 15.7422 0.417969 14.1714 0.417969 12.4998C0.417969 10.8283 0.735358 9.25748 1.37014 7.78734C2.00411 6.3172 2.86484 5.03838 3.95234 3.95088C5.03984 2.86338 6.31866 2.00224 7.7888 1.36746C9.25894 0.73349 10.8298 0.416504 12.5013 0.416504C13.8103 0.416504 15.0489 0.607823 16.2169 0.990462C17.385 1.3731 18.4624 1.90678 19.4492 2.5915L17.6971 4.3738C16.9319 3.89046 16.1162 3.51266 15.2503 3.24038C14.3843 2.96891 13.468 2.83317 12.5013 2.83317C9.82283 2.83317 7.5423 3.77446 5.65972 5.65705C3.77633 7.54043 2.83464 9.82136 2.83464 12.4998C2.83464 15.1783 3.77633 17.4592 5.65972 19.3426C7.5423 21.2252 9.82283 22.1665 12.5013 22.1665C13.1457 22.1665 13.7701 22.1061 14.3742 21.9853C14.9784 21.8644 15.5624 21.6932 16.1263 21.4717L17.9388 23.3144C17.1131 23.7172 16.2471 24.0294 15.3409 24.2509C14.4346 24.4724 13.4881 24.5832 12.5013 24.5832ZM20.9596 22.1665V18.5415H17.3346V16.1248H20.9596V12.4998H23.3763V16.1248H27.0013V18.5415H23.3763V22.1665H20.9596ZM10.8096 18.0582L5.67422 12.9228L7.36589 11.2311L10.8096 14.6748L22.893 2.5613L24.5846 4.25296L10.8096 18.0582Z"
                                                fill="#061A48"></path>
                                        </svg>
                                    </div>
                                    <div class="col-md-4">
                                        <h2>Task 1</h2>
                                        <p>Please describe fully each task that needs to be undertaken.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <textarea class="form-control" name="task1" placeholder="1. Remove existing... 2. Install new..."></textarea>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <svg width="13" height="18" viewBox="0 0 13 18" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.4297 18H0.160156V15.668H12.418L12.4297 18ZM8.60938 10.9688H0.113281V8.68359H8.60938V10.9688ZM4.8125 5.82422L5.08203 13.0898C5.08984 13.8398 4.95312 14.5117 4.67188 15.1055C4.39844 15.6914 3.94531 16.1523 3.3125 16.4883L1.17969 15.668C1.4375 15.6055 1.63281 15.4414 1.76562 15.1758C1.90625 14.9023 2 14.5859 2.04688 14.2266C2.10156 13.8594 2.12891 13.5156 2.12891 13.1953L1.88281 5.82422C1.88281 4.74609 2.10547 3.82813 2.55078 3.07031C3.00391 2.30469 3.625 1.71875 4.41406 1.3125C5.20312 0.90625 6.10938 0.703125 7.13281 0.703125C8.21875 0.703125 9.14062 0.902344 9.89844 1.30078C10.6562 1.69922 11.2344 2.25391 11.6328 2.96484C12.0312 3.66797 12.2305 4.48828 12.2305 5.42578H9.39453C9.39453 4.83984 9.28516 4.375 9.06641 4.03125C8.84766 3.67969 8.55859 3.42578 8.19922 3.26953C7.84766 3.11328 7.46484 3.03516 7.05078 3.03516C6.62891 3.03516 6.24609 3.14062 5.90234 3.35156C5.56641 3.5625 5.30078 3.875 5.10547 4.28906C4.91016 4.70312 4.8125 5.21484 4.8125 5.82422Z"
                                                            fill="black" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <input type="text" name="amount1" id="amount1" class="form-control"
                                                onchange="calculate_amount()" onkeyup="calculate_amount()"
                                                placeholder="Type price for task 1">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <!-- <a href="#">
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M16.8193 2.23594L14.763 0.179688L8.49948 6.44323L2.23594 0.179688L0.179688 2.23594L6.44323 8.49948L0.179688 14.763L2.23594 16.8193L8.49948 10.5557L14.763 16.8193L16.8193 14.763L10.5557 8.49948L16.8193 2.23594Z" fill="#6D717A" />
                            </svg>
                          </a> -->
                                    </div>
                                </div>
                                <div class="row task-wrap">
                                    <div class="col-md-1">
                                        <svg width="27" height="25" viewBox="0 0 27 25" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M12.5013 24.5832C10.8298 24.5832 9.25894 24.2658 7.7888 23.631C6.31866 22.997 5.03984 22.1363 3.95234 21.0488C2.86484 19.9613 2.00411 18.6825 1.37014 17.2123C0.735358 15.7422 0.417969 14.1714 0.417969 12.4998C0.417969 10.8283 0.735358 9.25748 1.37014 7.78734C2.00411 6.3172 2.86484 5.03838 3.95234 3.95088C5.03984 2.86338 6.31866 2.00224 7.7888 1.36746C9.25894 0.73349 10.8298 0.416504 12.5013 0.416504C13.8103 0.416504 15.0489 0.607823 16.2169 0.990462C17.385 1.3731 18.4624 1.90678 19.4492 2.5915L17.6971 4.3738C16.9319 3.89046 16.1162 3.51266 15.2503 3.24038C14.3843 2.96891 13.468 2.83317 12.5013 2.83317C9.82283 2.83317 7.5423 3.77446 5.65972 5.65705C3.77633 7.54043 2.83464 9.82136 2.83464 12.4998C2.83464 15.1783 3.77633 17.4592 5.65972 19.3426C7.5423 21.2252 9.82283 22.1665 12.5013 22.1665C13.1457 22.1665 13.7701 22.1061 14.3742 21.9853C14.9784 21.8644 15.5624 21.6932 16.1263 21.4717L17.9388 23.3144C17.1131 23.7172 16.2471 24.0294 15.3409 24.2509C14.4346 24.4724 13.4881 24.5832 12.5013 24.5832ZM20.9596 22.1665V18.5415H17.3346V16.1248H20.9596V12.4998H23.3763V16.1248H27.0013V18.5415H23.3763V22.1665H20.9596ZM10.8096 18.0582L5.67422 12.9228L7.36589 11.2311L10.8096 14.6748L22.893 2.5613L24.5846 4.25296L10.8096 18.0582Z"
                                                fill="#061A48"></path>
                                        </svg>
                                    </div>
                                    <div class="col-md-4">
                                        <h2>Task 2</h2>
                                        <p>Please describe fully each task that needs to be undertaken.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <textarea class="form-control" name="task2" placeholder="1. Remove existing... 2. Install new..."></textarea>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <svg width="13" height="18" viewBox="0 0 13 18"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.4297 18H0.160156V15.668H12.418L12.4297 18ZM8.60938 10.9688H0.113281V8.68359H8.60938V10.9688ZM4.8125 5.82422L5.08203 13.0898C5.08984 13.8398 4.95312 14.5117 4.67188 15.1055C4.39844 15.6914 3.94531 16.1523 3.3125 16.4883L1.17969 15.668C1.4375 15.6055 1.63281 15.4414 1.76562 15.1758C1.90625 14.9023 2 14.5859 2.04688 14.2266C2.10156 13.8594 2.12891 13.5156 2.12891 13.1953L1.88281 5.82422C1.88281 4.74609 2.10547 3.82813 2.55078 3.07031C3.00391 2.30469 3.625 1.71875 4.41406 1.3125C5.20312 0.90625 6.10938 0.703125 7.13281 0.703125C8.21875 0.703125 9.14062 0.902344 9.89844 1.30078C10.6562 1.69922 11.2344 2.25391 11.6328 2.96484C12.0312 3.66797 12.2305 4.48828 12.2305 5.42578H9.39453C9.39453 4.83984 9.28516 4.375 9.06641 4.03125C8.84766 3.67969 8.55859 3.42578 8.19922 3.26953C7.84766 3.11328 7.46484 3.03516 7.05078 3.03516C6.62891 3.03516 6.24609 3.14062 5.90234 3.35156C5.56641 3.5625 5.30078 3.875 5.10547 4.28906C4.91016 4.70312 4.8125 5.21484 4.8125 5.82422Z"
                                                            fill="black" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="amount2" name="amount2"
                                                onchange="calculate_amount()" onkeyup="calculate_amount()"
                                                placeholder="Type price for task 2">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <span class="remove-row">
                                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M16.8193 2.23594L14.763 0.179688L8.49948 6.44323L2.23594 0.179688L0.179688 2.23594L6.44323 8.49948L0.179688 14.763L2.23594 16.8193L8.49948 10.5557L14.763 16.8193L16.8193 14.763L10.5557 8.49948L16.8193 2.23594Z"
                                                    fill="#6D717A" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                {{-- for add more --}}
                                <div id="new_add"></div>
                                <input type="hidden" value="2" id="total_field" name="total_field">

                                <div class="form-group col-md-12 mt-2 mb-5 text-center pre_">
                                    <button type="button" class="btn btn-light mr-3" onclick="addMore()"><i class="fa fa-plus"></i> Add new</button>
                                </div>


                                <!--//-->
                            </div>
                            <div id='unable_to_desc_div'>
                                <div class="form-check mb-3">
                                    <input type="radio" class="form-check-input mb" id="Unable_to_describe" name="Unable_to_describe" value="Unable_to_describe">
                                    <h5>I am unable to describe the work required.</h5>
                                </div>

                                <div class="unable-work">
                                    <div class="row mb-3">
                                        <div class="col-md-5">
                                            <div class="form-check mb-2">
                                                <input type="radio" class="form-check-input mb" onchange="ifYes()" id="forMore" name="Need_more_info" value="Need_more_info">
                                                <h5>I need more information</h5>
                                                <p>Please write here what additional information you need.
                                                    This will be sent directly to the customer.</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <textarea class="form-control" id="typeHere" name="typeHere" placeholder="Type here..." disabled></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="form-check mb-2">
                                                <input type="radio" class="form-check-input mb" id="radiox1" name="Do_not_undertake_project_type" value="Do_not_undertake_project_type">
                                                <h5>I do not undertake this type of project.</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="form-check mb-2">
                                                <input type="radio" class="form-check-input mb" id="radiox2" name="Do_not_cover_location" value="Do_not_cover_location">
                                                <h5>I do not cover the customer’s location.</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="for_photos">
                                <div class="col-md-12 mt-3 mb-3">
                                    <h3>Product photo(s)</h3>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-danger btn-block">
                                            <svg width="22" height="20" viewBox="0 0 22 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18 6V4H16V2H18V0H20V2H22V4H20V6H18ZM2 20C1.45 20 0.979333 19.8043 0.588 19.413C0.196 19.021 0 18.55 0 18V6C0 5.45 0.196 4.97933 0.588 4.588C0.979333 4.196 1.45 4 2 4H5.15L7 2H13V4H7.875L6.05 6H2V18H18V9H20V18C20 18.55 19.8043 19.021 19.413 19.413C19.021 19.8043 18.55 20 18 20H2ZM10 16.5C11.25 16.5 12.3127 16.0627 13.188 15.188C14.0627 14.3127 14.5 13.25 14.5 12C14.5 10.75 14.0627 9.68733 13.188 8.812C12.3127 7.93733 11.25 7.5 10 7.5C8.75 7.5 7.68733 7.93733 6.812 8.812C5.93733 9.68733 5.5 10.75 5.5 12C5.5 13.25 5.93733 14.3127 6.812 15.188C7.68733 16.0627 8.75 16.5 10 16.5ZM10 14.5C9.3 14.5 8.70833 14.2583 8.225 13.775C7.74167 13.2917 7.5 12.7 7.5 12C7.5 11.3 7.74167 10.7083 8.225 10.225C8.70833 9.74167 9.3 9.5 10 9.5C10.7 9.5 11.2917 9.74167 11.775 10.225C12.2583 10.7083 12.5 11.3 12.5 12C12.5 12.7 12.2583 13.2917 11.775 13.775C11.2917 14.2583 10.7 14.5 10 14.5Z"
                                                    fill="#EE5719" />
                                            </svg> Take photo/video </button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-outline-danger btn-block">
                                            <svg width="18" height="20" viewBox="0 0 18 20" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M17.0344 4.21564L13.2844 0.465637C13.1415 0.326345 12.9495 0.248887 12.75 0.250012H5.25C4.85218 0.250012 4.47064 0.408047 4.18934 0.689352C3.90804 0.970656 3.75 1.35219 3.75 1.75001V3.25001H2.25C1.85218 3.25001 1.47064 3.40805 1.18934 3.68935C0.908035 3.97066 0.75 4.35219 0.75 4.75001V18.25C0.75 18.6478 0.908035 19.0294 1.18934 19.3107C1.47064 19.592 1.85218 19.75 2.25 19.75H12.75C13.1478 19.75 13.5294 19.592 13.8107 19.3107C14.092 19.0294 14.25 18.6478 14.25 18.25V16.75H15.75C16.1478 16.75 16.5294 16.592 16.8107 16.3107C17.092 16.0294 17.25 15.6478 17.25 15.25V4.75001C17.2511 4.55048 17.1737 4.35851 17.0344 4.21564ZM12.75 18.25H2.25V4.75001H9.44062L12.75 8.05939V18.25ZM15.75 15.25H14.25V7.75001C14.2511 7.55048 14.1737 7.35851 14.0344 7.21564L10.2844 3.46564C10.1415 3.32635 9.94954 3.24889 9.75 3.25001H5.25V1.75001H12.4406L15.75 5.05939V15.25ZM10.5 12.25C10.5 12.4489 10.421 12.6397 10.2803 12.7803C10.1397 12.921 9.94891 13 9.75 13H5.25C5.05109 13 4.86032 12.921 4.71967 12.7803C4.57902 12.6397 4.5 12.4489 4.5 12.25C4.5 12.0511 4.57902 11.8603 4.71967 11.7197C4.86032 11.579 5.05109 11.5 5.25 11.5H9.75C9.94891 11.5 10.1397 11.579 10.2803 11.7197C10.421 11.8603 10.5 12.0511 10.5 12.25ZM10.5 15.25C10.5 15.4489 10.421 15.6397 10.2803 15.7803C10.1397 15.921 9.94891 16 9.75 16H5.25C5.05109 16 4.86032 15.921 4.71967 15.7803C4.57902 15.6397 4.5 15.4489 4.5 15.25C4.5 15.0511 4.57902 14.8603 4.71967 14.7197C4.86032 14.579 5.05109 14.5 5.25 14.5H9.75C9.94891 14.5 10.1397 14.579 10.2803 14.7197C10.421 14.8603 10.5 15.0511 10.5 15.25Z"
                                                    fill="#EE5719" />
                                            </svg> Upload files </a>
                                    </div>
                                    <!-- The Modal Upload files-->
                                    <div class="modal fade select_address" id="exampleModal2" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Upload files</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <svg width="19" height="19" viewBox="0 0 19 19"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M2.26683 18.5416L0.458496 16.7333L7.69183 9.49992L0.458496 2.26659L2.26683 0.458252L9.50016 7.69159L16.7335 0.458252L18.5418 2.26659L11.3085 9.49992L18.5418 16.7333L16.7335 18.5416L9.50016 11.3083L2.26683 18.5416Z"
                                                                fill="black" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6 supported_">
                                                            <h4>Supported file type list:</h4>
                                                            <h6>
                                                                <strong>Images:</strong> .gif .heic .jpeg, .jpg .png .svg
                                                                .webp
                                                            </h6>
                                                            <h6>
                                                                <strong>Documents:</strong> .doc, .docx .key .odt .pdf .ppt,
                                                                .pptx, .pps, .ppsx .xls, .xlsx
                                                            </h6>
                                                            <h6>
                                                                <strong>Audio:</strong> .mp3 .m4a .ogg .wav
                                                            </h6>
                                                            <h6>
                                                                <strong>Video:</strong> .avi .mpg .mp4, .m4v .mov .ogv .vtt
                                                                .wmv .3gp .3g2
                                                            </h6>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="text-center upload_wrap">
                                                                <img src="assets/img/upload.svg" alt="">
                                                                <p>Drag and drop files here</p>
                                                                <h4>OR</h4>
                                                                <button type="button" class="btn btn-light mt-3"
                                                                    style="width:180px;">Browse files</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-light">Upload</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- The Modal Upload files END-->
                                </div>
                                <div class="col-md-6 mt-2">
                                    <div class="d-inline mr-3">abc.doc (3MB) <a href="#">
                                            <img src="assets/img/crose-btn.svg" alt="">
                                        </a>
                                    </div>
                                    <div class="d-inline mr-3">xyz.jpg (6MB) <a href="#">
                                            <img src="assets/img/crose-btn.svg" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--// END-->
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="white_bg mb-5" id="div_for_calculate_estimate">
                            <div class="row">
                                <div class="col-md-6 vat_">
                                    <div class="col-md-12">
                                        <div class="form-check form-switch">
                                            <div class="switchToggle">
                                                <input type="checkbox" id="toogle1" name="covers_customers_all_needs"
                                                    value="1">
                                                <label for="toogle1">Toggle</label>
                                            </div>
                                            <label class="form-check-label" for="mySwitch">Does the above list of tasks
                                                cover all of the work the customer requested?</label>
                                        </div>
                                    </div>
                                    <!--//-->
                                    <div class="col-md-12">
                                        <div class="form-check form-switch">
                                            <div class="switchToggle">
                                                <input type="checkbox" id="toogle2" name="payment_required_upfront"
                                                    value="1">
                                                <label for="toogle2">Toggle</label>
                                            </div>
                                            <label class="form-check-label" for="mySwitch">Payment required
                                                upfront?</label>
                                        </div>
                                    </div>
                                    <!--//-->
                                    <div class="col-md-12">
                                        <div class="form-check form-switch">
                                            <div class="switchToggle">
                                                <input type="checkbox" id="toogle3" name="apply_vat" value="1">
                                                <label for="toogle3">Toggle</label>
                                            </div>
                                            <label class="form-check-label" for="mySwitch">Apply VAT @ 20%?</label>
                                        </div>
                                    </div>
                                    <!--//-->
                                </div>
                                <div class="col-md-5 offset-md-1 total_price_">
                                    <div class="row mb-3">
                                        <div class="col-4">
                                            <h5>Contingency:</h5>
                                        </div>
                                        <div class="col-3 pr-0">
                                            <input type="text" class="form-control pull-left"
                                                id="percentage_contingency" name='contingency'
                                                onchange="calculate_amount()" onkeyup="calculate_amount()">
                                        </div>
                                        <div class="col-3 pl-0">
                                            <h5>%</h5>
                                        </div>
                                    </div>
                                    <h6>Total price excluding contingency</h6>
                                    <div class="mb-4 price_ec" id="price_exclude_contigency">£0.00</div>
                                    <h6>Total price including contingency</h6>
                                    <div class="mb-4 price_ec" id="price_include_contigency">£0.00</div>
                                    <div id="vat_price">
                                        <h6>Total price including contingency and VAT</h6>
                                        <div class="mb-4 price_ec" id="price_include_vat">£0.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--// END-->
                <div class="row">
                    <div class="col-md-10 offset-md-1" id="div_for_initial_payment">
                        <div class="white_bg mb-5 initial-payment">
                            <div class="row" id="for_initial_pay_hide">
                                    <div class="col-md-12">
                                        <h3>Initial payment</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-2 pr-0">
                                                <div class="form-check mt-2">
                                                    <input type="radio" class="form-check-input" id="radio1" name="optradio" value="option1">
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="row total_price_">
                                                    <div class="col-4 pl-0 pr-0">
                                                        <input type="text" class="form-control pull-left" id="initial_payment_percentage" name="initial_payment_percentage" onkeyup="calculate_amount()">
                                                    </div>
                                                    <div class="col-2 pl-0">
                                                        <h5>%</h5>
                                                    </div>
                                                    <div class="col-3">
                                                        <span id="initial_payment1">(£0.00)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <h4>Or</h4>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row task-wrap p-0">
                                            <div class="col-1">
                                                <div class="form-check mt-2">
                                                    <input type="radio" class="form-check-input" id="radio1" name="optradio" value="option1">
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <svg width="13" height="18" viewBox="0 0 13 18"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12.4297 18H0.160156V15.668H12.418L12.4297 18ZM8.60938 10.9688H0.113281V8.68359H8.60938V10.9688ZM4.8125 5.82422L5.08203 13.0898C5.08984 13.8398 4.95312 14.5117 4.67188 15.1055C4.39844 15.6914 3.94531 16.1523 3.3125 16.4883L1.17969 15.668C1.4375 15.6055 1.63281 15.4414 1.76562 15.1758C1.90625 14.9023 2 14.5859 2.04688 14.2266C2.10156 13.8594 2.12891 13.5156 2.12891 13.1953L1.88281 5.82422C1.88281 4.74609 2.10547 3.82813 2.55078 3.07031C3.00391 2.30469 3.625 1.71875 4.41406 1.3125C5.20312 0.90625 6.10938 0.703125 7.13281 0.703125C8.21875 0.703125 9.14062 0.902344 9.89844 1.30078C10.6562 1.69922 11.2344 2.25391 11.6328 2.96484C12.0312 3.66797 12.2305 4.48828 12.2305 5.42578H9.39453C9.39453 4.83984 9.28516 4.375 9.06641 4.03125C8.84766 3.67969 8.55859 3.42578 8.19922 3.26953C7.84766 3.11328 7.46484 3.03516 7.05078 3.03516C6.62891 3.03516 6.24609 3.14062 5.90234 3.35156C5.56641 3.5625 5.30078 3.875 5.10547 4.28906C4.91016 4.70312 4.8125 5.21484 4.8125 5.82422Z"
                                                                    fill="black"></path>
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" name="initial_payment_amount" placeholder="Type Price">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row form_wrap mt-3">
                                        <h3 class="mt-4">Available to start</h3>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select name="for_start_date" class="form-control" id="for_start_date" onchange="getDate()">
                                                    <option value="now">Now</option>
                                                    <option value="one_week">Next one week</option>
                                                    <option value="two_three_weeks">2-3 weeks time</option>
                                                    <option value="specific_date">On a specific date</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="date" class="form-control" id="project_start_date" name="project_start_date" placeholder="DD MM YYYY" style="display: none;">
                                            </div>
                                        </div>
                                        <h3 class="mt-4">Total time required to complete the project (including
                                            contingency)</h3>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id=""
                                                    placeholder="Type time" name="total_time">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select name="total_time_type" class="form-control" id="">
                                                    <option value="minutes">minutes</option>
                                                    <option value="Hours">hours</option>
                                                    <option value="days">days</option>
                                                    <option value="weeks">weeks</option>
                                                    <option value="months">months</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--// END-->
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="white_bg" id="terms_conditions">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Terms and conditions</h3>
                                    <textarea name="termsconditions" id="summernote"></textarea>
                                </div>

                            </div>
                        </div>
                        <div class="form-group col-md-12 mt-5 text-center">
                            <button type="submit" class="btn btn-primary">Submit now</button>
                        </div>
                    </div>
                </div>
                <!--// END-->
            </form>
        </div>
    </section>
    <!--Code area end-->
@endsection
@push('scripts')
    <!-- Main JS -->
    {{-- <script src="assets/js/main.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        $('#summernote').summernote({
            // placeholder: 'FixMyBuild',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
            ]
        });

        $(document).ready(function() {
            $(".remove-row").click(function(e) {
                var last_field = parseInt($('#total_field').val())
                if (last_field > 2) {
                    $('#new_' + last_field).remove();
                    $('#total_field').val(last_field - 1);
                }
            });
        });

        function addMore() {
            var new_field = parseInt($('#total_field').val()) + 1;
            var new_input = `<div class="row task-wrap" id="new_${new_field}">
                    <div class="col-md-1">
                      <svg width="27" height="25" viewBox="0 0 27 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.5013 24.5832C10.8298 24.5832 9.25894 24.2658 7.7888 23.631C6.31866 22.997 5.03984 22.1363 3.95234 21.0488C2.86484 19.9613 2.00411 18.6825 1.37014 17.2123C0.735358 15.7422 0.417969 14.1714 0.417969 12.4998C0.417969 10.8283 0.735358 9.25748 1.37014 7.78734C2.00411 6.3172 2.86484 5.03838 3.95234 3.95088C5.03984 2.86338 6.31866 2.00224 7.7888 1.36746C9.25894 0.73349 10.8298 0.416504 12.5013 0.416504C13.8103 0.416504 15.0489 0.607823 16.2169 0.990462C17.385 1.3731 18.4624 1.90678 19.4492 2.5915L17.6971 4.3738C16.9319 3.89046 16.1162 3.51266 15.2503 3.24038C14.3843 2.96891 13.468 2.83317 12.5013 2.83317C9.82283 2.83317 7.5423 3.77446 5.65972 5.65705C3.77633 7.54043 2.83464 9.82136 2.83464 12.4998C2.83464 15.1783 3.77633 17.4592 5.65972 19.3426C7.5423 21.2252 9.82283 22.1665 12.5013 22.1665C13.1457 22.1665 13.7701 22.1061 14.3742 21.9853C14.9784 21.8644 15.5624 21.6932 16.1263 21.4717L17.9388 23.3144C17.1131 23.7172 16.2471 24.0294 15.3409 24.2509C14.4346 24.4724 13.4881 24.5832 12.5013 24.5832ZM20.9596 22.1665V18.5415H17.3346V16.1248H20.9596V12.4998H23.3763V16.1248H27.0013V18.5415H23.3763V22.1665H20.9596ZM10.8096 18.0582L5.67422 12.9228L7.36589 11.2311L10.8096 14.6748L22.893 2.5613L24.5846 4.25296L10.8096 18.0582Z" fill="#061A48"></path>
                      </svg>
                    </div>
                    <div class="col-md-4">
                      <h2>Task ${new_field}</h2>
                      <p>Please describe fully each task that needs to be undertaken.</p>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <textarea class="form-control" name="task${new_field}" placeholder="1. Remove existing... 2. Install new..."></textarea>
                      </div>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <svg width="13" height="18" viewBox="0 0 13 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M12.4297 18H0.160156V15.668H12.418L12.4297 18ZM8.60938 10.9688H0.113281V8.68359H8.60938V10.9688ZM4.8125 5.82422L5.08203 13.0898C5.08984 13.8398 4.95312 14.5117 4.67188 15.1055C4.39844 15.6914 3.94531 16.1523 3.3125 16.4883L1.17969 15.668C1.4375 15.6055 1.63281 15.4414 1.76562 15.1758C1.90625 14.9023 2 14.5859 2.04688 14.2266C2.10156 13.8594 2.12891 13.5156 2.12891 13.1953L1.88281 5.82422C1.88281 4.74609 2.10547 3.82813 2.55078 3.07031C3.00391 2.30469 3.625 1.71875 4.41406 1.3125C5.20312 0.90625 6.10938 0.703125 7.13281 0.703125C8.21875 0.703125 9.14062 0.902344 9.89844 1.30078C10.6562 1.69922 11.2344 2.25391 11.6328 2.96484C12.0312 3.66797 12.2305 4.48828 12.2305 5.42578H9.39453C9.39453 4.83984 9.28516 4.375 9.06641 4.03125C8.84766 3.67969 8.55859 3.42578 8.19922 3.26953C7.84766 3.11328 7.46484 3.03516 7.05078 3.03516C6.62891 3.03516 6.24609 3.14062 5.90234 3.35156C5.56641 3.5625 5.30078 3.875 5.10547 4.28906C4.91016 4.70312 4.8125 5.21484 4.8125 5.82422Z" fill="black" />
                            </svg>
                          </span>
                        </div>
                        <input type="text" name="amount${new_field}" id="amount${new_field}" class="form-control" onchange="calculate_amount()" onkeyup="calculate_amount()" placeholder="Type price for task ${new_field}">
                      </div>
                    </div>
                    <div class="col-md-1">
                      <span class="remove-row">
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M16.8193 2.23594L14.763 0.179688L8.49948 6.44323L2.23594 0.179688L0.179688 2.23594L6.44323 8.49948L0.179688 14.763L2.23594 16.8193L8.49948 10.5557L14.763 16.8193L16.8193 14.763L10.5557 8.49948L16.8193 2.23594Z" fill="#6D717A" />
                        </svg>
                      </span>
                    </div>
                  </div>`;
            $('#new_add').append(new_input);
            $('#total_field').val(new_field);

            $(".remove-row").click(function(e) {
                var last_field = parseInt($('#total_field').val())
                if (last_field > 2) {
                    $('#new_' + last_field).remove();
                    $('#total_field').val(last_field - 1);
                }
            });
        }


        function remove() {

        }

        function ifYes() {
            const forClick = document.getElementById("forMore");
            const textBox = document.getElementById("typeHere");
            if (forClick.clicked == false) {
                textBox.disabled = true;
            } else {
                textBox.disabled = false;
            }
        }

        function calculate_amount() {
            let sum = 0;
            var initial_payment = parseFloat(document.getElementById("initial_payment_percentage").value);

            const amount_from_addmore = document.getElementById("new_".$new_field);
            for (let i = 1; i <= $('#total_field').val(); i++) {
                sum += Number($('#amount' + i).val());
                $("#price_exclude_contigency").text("£" + sum.toFixed(2));
            }
            var percentage_contingency = $("#percentage_contingency").val() ?? 0;
            var total_price_including_contingency = (sum * percentage_contingency / 100) + sum;
            var total_price_including_vat = ((total_price_including_contingency * {{ env('VAT_CHARGE', 20) }}) / 100) +
                total_price_including_contingency;

            $("#price_include_contigency").text("£" + total_price_including_contingency.toFixed(2));
            $("#price_include_vat").text("£" + total_price_including_vat.toFixed(2));

            var initial_payment_percentage = 0
            if (isNaN(initial_payment) != true) {
                if (!document.getElementById('toogle3').checked) {
                    initial_payment_percentage = (parseFloat(total_price_including_contingency) * initial_payment / 100);
                } else {
                    initial_payment_percentage = (parseFloat(total_price_including_vat) * initial_payment / 100);
                }
            }

            $("#initial_payment1").text("(£" + initial_payment_percentage.toFixed(2) + ")");
        }

        $(document).ready(function() {
            $("#vat_price").hide();
        });

        $('#toogle3').change(function() {
            if (this.checked) {
                $("#vat_price").show();
                calculate_amount();
            } else {
                $("#vat_price").hide();
                calculate_amount();
            }

        });

        $(document).ready(function() {
            $("#for_initial_pay_hide").hide();
        });

        $('#toogle2').change(function() {
            if (this.checked) {
                $("#for_initial_pay_hide").show();
                calculate_amount();
            } else {
                $("#for_initial_pay_hide").hide();
                calculate_amount();
            }

        });


        function getDate() {
            let e = document.getElementById('for_start_date');
            const date = new Date();
            let currentDay = String(date.getDate()).padStart(2, '0');
            let currentMonth = String(date.getMonth() + 1).padStart(2, "0");
            let currentYear = date.getFullYear();
            let currentDate = `${currentYear}-${currentMonth}-${currentDay}`;
            let project_start_date = document.getElementById('project_start_date');
            let futureDate;
            if (e.value === 'specific_date') {
                document.getElementById('project_start_date').style.display = 'block';
            } else {
                document.getElementById('project_start_date').style.display = 'none';

            }
        }

        $(document).ready(function() {
            getDate();
            $('#Unable_to_describe').change(function() {
                if ($(this).is(':checked')) {
                    $("#div_for_calculate_estimate").hide();
                    $("#div_for_initial_payment").hide();
                    $("#terms_conditions").hide();
                    $("#for_photos").hide();
                    $("#for_task").hide();
                } else {
                    $("#div_for_calculate_estimate").show();
                    $("#div_for_initial_payment").show();
                    $("#terms_conditions").show();
                    $("#for_photos").show();
                    $("#for_task").show();
                }
            });
        });


    </script>
@endpush

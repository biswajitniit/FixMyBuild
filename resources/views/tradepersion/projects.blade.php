@extends('layouts.app')

@section('content')
<section>
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center pt-5 fmb_titel">
          <h1>My profile</h1>
          <ol class="breadcrumb mb-5">
            <li class="breadcrumb-item">
              <a href="{{route('home')}}">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <!--Code area end-->
  <!--Code area start-->
  <section class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-md-3 dashboard_sidebar">
          <ul>
            <li @if(Route::is('tradepersion.dashboard')) class="active" @endif>
               <a href="{{route('tradepersion.dashboard')}}">Profile</a>
            </li>
            <li @if(Route::is('tradepersion.projects')) class="active" @endif>
               <a href="{{route('tradepersion.projects')}}">Projects</a>
            </li>
            <li @if(Route::is('tradepersion.settings')) class="active" @endif>
               <a href="{{route('tradepersion.settings')}}">Settings</a>
            </li>
            <li>
               <a href="javascript:void(0)">Logout</a>
            </li>
         </ul>
        </div>
        <div class="col-md-9">
          <div class="col-12 tradperson_tab">
            <nav>
              <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-tradesperson-tab" data-toggle="tab" href="#nav-tradesperson" role="tab" aria-controls="nav-tradesperson" aria-selected="true">As a tradesperson <small>View projects allocated to your company.</small>
                </a>
                <a class="nav-item nav-link" id="nav-customer-tab" data-toggle="tab" href="#nav-customer" role="tab" aria-controls="nav-customer" aria-selected="false">As a customer <small>View projects that you have initiated as a customer.</small>
                </a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-tradesperson" role="tabpanel" aria-labelledby="nav-tradesperson-tab">
                <div class="dashboard_wrapper">
                  <div class="white_bg mb-5">
                    <div class="row num_change">
                      <div class="col-md-12">
                        <h3>New project(s)</h3>
                      </div>
                    </div>
                    <div class="row search-query-wrap">
                      <div class="col-12">
                         <div id="custom-search-input">
                            <div class="input-group">
                                    <input type="text" class="search-query form-control" placeholder="Search..." name="keyword" id="keyword" />
                                    <span class="input-group-btn">
                                        <button type="button" onclick="fetchTableData($('#keyword').val())" class="btn btn-danger" >
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.5 2.00025C6.77609 2.00025 5.12279 2.68507 3.90381 3.90406C2.68482 5.12305 2 6.77635 2 8.50025C2 10.2242 2.68482 11.8775 3.90381 13.0964C5.12279 14.3154 6.77609 15.0003 8.5 15.0003C10.2239 15.0003 11.8772 14.3154 13.0962 13.0964C14.3152 11.8775 15 10.2242 15 8.50025C15 6.77635 14.3152 5.12305 13.0962 3.90406C11.8772 2.68507 10.2239 2.00025 8.5 2.00025ZM1.91687e-08 8.50025C0.000115492 7.14485 0.324364 5.80912 0.945694 4.60451C1.56702 3.3999 2.46742 2.36135 3.57175 1.57549C4.67609 0.789633 5.95235 0.279263 7.29404 0.0869618C8.63574 -0.10534 10.004 0.0260029 11.2846 0.470032C12.5652 0.914061 13.7211 1.6579 14.6557 2.63949C15.5904 3.62108 16.2768 4.81196 16.6576 6.11277C17.0384 7.41358 17.1026 8.7866 16.8449 10.1173C16.5872 11.448 16.015 12.6977 15.176 13.7623L18.828 17.4143C19.0102 17.6029 19.111 17.8555 19.1087 18.1177C19.1064 18.3799 19.0012 18.6307 18.8158 18.8161C18.6304 19.0015 18.3796 19.1066 18.1174 19.1089C17.8552 19.1112 17.6026 19.0104 17.414 18.8283L13.762 15.1763C12.5086 16.1642 11.0024 16.7794 9.41573 16.9514C7.82905 17.1233 6.22602 16.8451 4.79009 16.1485C3.35417 15.4519 2.14336 14.3651 1.29623 13.0126C0.449106 11.66 -0.000107143 10.0962 1.91687e-08 8.50025ZM7.5 5.00025C7.5 4.73504 7.60536 4.48068 7.79289 4.29315C7.98043 4.10561 8.23478 4.00025 8.5 4.00025C9.69347 4.00025 10.8381 4.47436 11.682 5.31827C12.5259 6.16219 13 7.30678 13 8.50025C13 8.76547 12.8946 9.01982 12.7071 9.20736C12.5196 9.3949 12.2652 9.50025 12 9.50025C11.7348 9.50025 11.4804 9.3949 11.2929 9.20736C11.1054 9.01982 11 8.76547 11 8.50025C11 7.83721 10.7366 7.20133 10.2678 6.73249C9.79893 6.26365 9.16304 6.00025 8.5 6.00025C8.23478 6.00025 7.98043 5.8949 7.79289 5.70736C7.60536 5.51982 7.5 5.26547 7.5 5.00025Z" fill="#4F4F4F"/>
                                            </svg>

                                        </button>
                                    </span>
                            </div>
                         </div>
                      </div>
                    </div>
                    <div class="row table_wrap mt-5" id="new_projects">
                        @include('tradepersion.project_lists.new_project_list')
                    </div>
                  </div>
                  <div class="white_bg">
                    <div class="row num_change">
                      <div class="col-md-12">
                        <h3>Project history</h3>
                      </div>
                    </div>
                <form action="{{ route('tradepersion.projects') }}" method="GET">
                    <div class="row search-query-wrap">
                      <div class="col-12">
                         <div id="custom-search-input">
                            <div class="input-group">
                                <input type="text" class="  search-query form-control" placeholder="Search..." id="project_history_search" name="project_history_search" />
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="button" onclick="fetchHistoryTableData($('#project_history_search').val())">
                                     <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.5 2.00025C6.77609 2.00025 5.12279 2.68507 3.90381 3.90406C2.68482 5.12305 2 6.77635 2 8.50025C2 10.2242 2.68482 11.8775 3.90381 13.0964C5.12279 14.3154 6.77609 15.0003 8.5 15.0003C10.2239 15.0003 11.8772 14.3154 13.0962 13.0964C14.3152 11.8775 15 10.2242 15 8.50025C15 6.77635 14.3152 5.12305 13.0962 3.90406C11.8772 2.68507 10.2239 2.00025 8.5 2.00025ZM1.91687e-08 8.50025C0.000115492 7.14485 0.324364 5.80912 0.945694 4.60451C1.56702 3.3999 2.46742 2.36135 3.57175 1.57549C4.67609 0.789633 5.95235 0.279263 7.29404 0.0869618C8.63574 -0.10534 10.004 0.0260029 11.2846 0.470032C12.5652 0.914061 13.7211 1.6579 14.6557 2.63949C15.5904 3.62108 16.2768 4.81196 16.6576 6.11277C17.0384 7.41358 17.1026 8.7866 16.8449 10.1173C16.5872 11.448 16.015 12.6977 15.176 13.7623L18.828 17.4143C19.0102 17.6029 19.111 17.8555 19.1087 18.1177C19.1064 18.3799 19.0012 18.6307 18.8158 18.8161C18.6304 19.0015 18.3796 19.1066 18.1174 19.1089C17.8552 19.1112 17.6026 19.0104 17.414 18.8283L13.762 15.1763C12.5086 16.1642 11.0024 16.7794 9.41573 16.9514C7.82905 17.1233 6.22602 16.8451 4.79009 16.1485C3.35417 15.4519 2.14336 14.3651 1.29623 13.0126C0.449106 11.66 -0.000107143 10.0962 1.91687e-08 8.50025ZM7.5 5.00025C7.5 4.73504 7.60536 4.48068 7.79289 4.29315C7.98043 4.10561 8.23478 4.00025 8.5 4.00025C9.69347 4.00025 10.8381 4.47436 11.682 5.31827C12.5259 6.16219 13 7.30678 13 8.50025C13 8.76547 12.8946 9.01982 12.7071 9.20736C12.5196 9.3949 12.2652 9.50025 12 9.50025C11.7348 9.50025 11.4804 9.3949 11.2929 9.20736C11.1054 9.01982 11 8.76547 11 8.50025C11 7.83721 10.7366 7.20133 10.2678 6.73249C9.79893 6.26365 9.16304 6.00025 8.5 6.00025C8.23478 6.00025 7.98043 5.8949 7.79289 5.70736C7.60536 5.51982 7.5 5.26547 7.5 5.00025Z" fill="#4F4F4F"/>
                                        </svg>

                                    </button>
                                </span>
                            </div>
                         </div>
                      </div>
                      {{-- <div class="col-6 status_wp">
                         <div class="dropdown" id="sel1">
                            <label class="dropdown-label">Status</label>
                            <div class="dropdown-list">
                              <div class="checkbox">
                                <input type="checkbox" name="dropdown-group-all" class="check-all checkbox-custom project-history-checkbox" id="project-history-main"/>
                                <label for="project-history-main" class="checkbox-custom-label">All</label>
                              </div>

                              <div class="checkbox">
                                <input type="checkbox" name="dropdown-group" class="check checkbox-custom project-history-checkbox" id="project-history-01"/>
                                <label for="project-history-01" class="checkbox-custom-label">Project completed</label>
                              </div>

                              <div class="checkbox">
                                <input type="checkbox" name="dropdown-group" class="check checkbox-custom project-history-checkbox" id="project-history-02"/>
                                <label for="project-history-02" class="checkbox-custom-label">Project paused</label>
                              </div>

                              <div class="checkbox">
                                <input type="checkbox" name="dropdown-group" class="check checkbox-custom project-history-checkbox" id="project-history-03"/>
                                <label for="project-history-03" class="checkbox-custom-label">Project rejected</label>
                              </div>
                            </div>
                          </div>
                      </div> --}}
                    </div>
                </form>
                    <div class="row table_wrap mt-5" id="project_history">
                        @include('tradepersion.project_lists.project_history_list')
                    </div>
                  </div>
                  <!--//-->
                </div>
              </div>
              <div class="tab-pane fade" id="nav-customer" role="tabpanel" aria-labelledby="nav-customer-tab">
                <div class="dashboard_wrapper">
                    @include('customer.project_lists.new_project_list')
                    @include('customer.project_lists.project_history_list')
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--// END-->
    </div>
  </section>
@push('scripts')
<script>
function checkboxDropdown(el) {
    var $el = $(el)

    function updateStatus(label, result) {
      if(!result.length) {
        label.html('Status');
      }
    };

    $el.each(function(i, element) {
      var $list = $(this).find('.dropdown-list'),
        $label = $(this).find('.dropdown-label'),
        $checkAll = $(this).find('.check-all'),
        $inputs = $(this).find('.check'),
        defaultChecked = $(this).find('input[type=checkbox]:checked'),
        result = [];

      updateStatus($label, result);
      if(defaultChecked.length) {
        defaultChecked.each(function () {
          result.push($(this).next().text());
          $label.html(result.join(", "));
        });
      }

      $label.on('click', ()=> {
        $(this).toggleClass('open');
      });

      $checkAll.on('change', function() {
        var checked = $(this).is(':checked');
        var checkedText = $(this).next().text();
        result = [];
        if(checked) {
          result.push(checkedText);
          $label.html(result);
          $inputs.prop('checked', false);
        }else{
          $label.html(result);
        }
          updateStatus($label, result);
      });

      $inputs.on('change', function() {
        var checked = $(this).is(':checked');
        var checkedText = $(this).next().text();
        if($checkAll.is(':checked')) {
          result = [];
        }
        if(checked) {
          result.push(checkedText);
          $label.html(result.join(", "));
          $checkAll.prop('checked', false);
        }else{
          let index = result.indexOf(checkedText);
          if (index >= 0) {
            result.splice(index, 1);
          }
          $label.html(result.join(", "));
        }
        updateStatus($label, result);
      });

      $(document).on('click touchstart', e => {
        if(!$(e.target).closest($(this)).length) {
          $(this).removeClass('open');
        }
      });
    });
};

checkboxDropdown('.dropdown');

$(document).ready(function(){
    $(document).on('keyup','#keyword', function(){
        fetchNewProject($(this).val());
    })

    $(document).on('keyup','#project_history_search', function(){
        fetchProjectHistory($(this).val())
    })

    // $(document).on('click', '#new_projects .pagination a', function(event){
    //     event.preventDefault();
    //     let urlString = $(this).attr('href');
    //     let paramString = urlString.split('?')[1];
    //     let queryString = new URLSearchParams(paramString);
    //     let data = {};
    //     for(let pair of queryString.entries()) {
    //         data[pair[0]]= pair[1];
    //     }
    //     console.log(data);
    // });

    // $('input[name="new_project_status[]"]').on('click', function() {
    //     let statuses = $(`label[for="${$('input[name="new_project_status[]"]').attr('id')}"]`);
    //     for (let status of statuses) {

    //     }
    //     // console.log($(this).val());
    // });

    // $(document).on('click', '#project_history .pagination a', function(event){
    //     event.preventDefault();
    //     let urlString = $(this).attr('href');
    //     let paramString = urlString.split('?')[1];
    //     let queryString = new URLSearchParams(paramString);
    //     let data = {'statuses': []};
    //     for(let pair of queryString.entries()) {
    //         data[pair[0]] = pair[1];
    //     }
    //     data['keyword'] = $('#project_history_search').val().trim();
    //     for (let checkbox of $('.project-history-checkbox')) {
    //         if($(checkbox).prop('checked')) {
    //             data['statuses'].push($(`label[for="${$(checkbox).attr('id')}"]`).text())
    //         }
    //     }

    //     $.get({
    //         url: "{{ route('tradesperson.paginateProjectHistory') }}",
    //         data: data,
    //         success: function(response) {
    //             console.log(response);
    //         },
    //         error: function(xhr, status, error) {
    //             console.log(xhr);
    //         }
    //     });
    // });
});

function fetchTableData(keyword) {
    // $.ajax({
    //     url: "{{ route('tradesperson.searchprojects') }}",
    //     data: {'keyword': keyword},
    //     success: function(response) {
    //         // $('#table_body').html(response);
    //         $('#new_projects').html(response);
    //     },
    //     error: function(xhr, status, error) {
    //         console.log(error);
    //     }
    // });

    const lowercaseKeyword = keyword.trim().toLowerCase();
    let anyRowsVisible = false;

    $('#new_projects tbody tr').each(function () {
        const rowVisible = $(this).find('td:nth-child(2)').text().trim().toLowerCase().includes(lowercaseKeyword);
        $(this).toggle(rowVisible);
        if (rowVisible) {
            anyRowsVisible = true;
        }
    });

    if (!anyRowsVisible) {
        $("#new_projects tbody").prepend('<tr class="empty_new_projects"><td colspan="6" class="text-center">There are currently no running projects.</td></tr>');
    } else {
        $('.empty_new_projects').remove();
    }
}


function fetchHistoryTableData(keyword) {
    $.ajax({
        url: "{{ route('tradesperson.searchProjectHistory') }}",
        data: {'keyword': keyword},
        success: function(response) {
            $('#project_history').html(response);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });

    // $('#project_history tr td:nth-child(2)').each(function () {
    //     $(this).closest('tr').toggle($(this).text().trim().toLowerCase().includes(keyword.trim().toLowerCase()));
    // });


    // if ($('#project_history tbody tr[style="display: none;"]').length == $('#project_history tbody tr').length) {
    //     $("#project_history tbody").prepend('<tr id="empty_project_history"><td colspan="5" class="text-center">No project history available.</td></tr>');
    // } else {
    //     $('#empty_project_history').remove();
    // }
}

function debounce(func, timeout = 300){
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
}

const fetchProjectHistory = debounce((keyword) => fetchHistoryTableData(keyword));
const fetchNewProject = debounce((keyword) => fetchTableData(keyword));

</script>
{{-- <script>
    $(document).ready(function(){

     $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
     });

     function fetch_data(page)
     {
      var _token = $("input[name=_token]").val();
      $.ajax({
          url:"{{ route('pagination.fetch') }}",
          method:"POST",
          data:{_token:_token, page:page},
          success:function(data)
          {
           $('#table_body').html(data);
          }
        });
     }

    });
</script> --}}
@endpush
@endsection

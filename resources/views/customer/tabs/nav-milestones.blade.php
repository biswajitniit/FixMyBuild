<div class="tab-pane fade @if ($status == 'project_started' || $status == 'awaiting_your_review') show active @endif" id="nav-milestones" role="tabpanel" aria-labelledby="nav-milestones-tab">
    <div class="row table_wrap">
        <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th style="width:80px;">#</th>
                    <th style="width:200px;">Payment for</th>
                    <th style="width:120px;">Amount</th>
                    <th style="width:180px;">Contingency</th>
                    <th style="width:100px;">Status</th>
                    @if ($status == 'project_started')
                        <th style="width:auto;"></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @php
                $count = 1;
                @endphp
                @foreach ($task as $row)
                <tr>
                    <td>@php
                        echo $count;
                    @endphp</td>
                    <td>{{substr($row->description,0,100)}}</td>
                    <td>£{{$row->price}}</td>
                    <td>@if($row->contingency!='') £{{$row->contingency}} @endif</td>
                    @if ($row->payment_status != 'succeeded' || $row->payment_status == '')
                    <td class="text-warning">Pending</td>
                    <td><a href="{{route('customer.project-pay-now',[Hashids_encode($row->id)])}}" class="btn btn-view">Pay now</a></td>
                    @else
                    <td class="text-success">Paid</td>
                    @endif
                </tr>
                @php
                   $count++;
                @endphp
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>

<div class="tab-pane fade @if ($status == 'project_started') show active @endif" id="nav-milestones" role="tabpanel" aria-labelledby="nav-milestones-tab">
    <div class="row table_wrap">
        <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th style="width:80px;">#</th>
                    <th style="width:200px;">Payment for</th>
                    <th style="width:120px;">Amount</th>
                    <th style="width:150px;">Contingency</th>
                    <th style="width:100px;">Status</th>
                    @if ($status == 'project_started')
                        <th style="width:auto;"></th>
                    @endif
                </tr>
            </thead>
            <tbody>
                    <tr>
                        @php
                            $initialTaskFound = false;
                        @endphp

                        @foreach($tasks as $key=>$task)
                            @if($task->is_initial == 1)
                                <td>1</td>
                                <td>Initial payment</td>
                                <td>
                                    @if($task->is_initial == 1)
                                        <span>£{{ number_format($task->price, 2) }}</span>
                                        @php
                                            $initialTaskFound = true;
                                        @endphp
                                    @endif

                                    @if(!$initialTaskFound)
                                        <span>NA</span>
                                    @endif
                                </td>
                                <td>NA</td>
                                @if($task->payment_status == 'paid')
                                    <td class="text-success">Paid</td>
                                @else
                                    <td class="text-warning">Pending</td>
                                @endif
                                @if($task->payment_status == 'paid')
                                    <td></td>
                                @else
                                    <td><a href="pay-now.html" class="btn btn-view">Pay now</a></td>
                                @endif
                            @endif
                        @endforeach
                    </tr>
                @foreach($tasks as $key=>$task)
                    @if($task->is_initial == 0)
                    <tr>
                        @if($task->is_initial == 1)
                            <td>{{ $key+2 }}</td>
                        @else
                            <td>{{ $key+1 }}</td>
                        @endif
                        <td>Milestone {{ $initialTaskFound ?  $key : $key+1 }}</td>
                        <td>£{{ sprintf("%.2f",$task->price) }}</td>
                        <td>£{{ sprintf("%.2f",$task->contingency) }}</td>
                        @if($task->payment_status == 'paid')
                            <td class="text-success">Paid</td>
                        @else
                            <td class="text-warning">Pending</td>
                        @endif
                        @if($task->payment_status == 'paid')
                            <td></td>
                        @else
                            <td><a href="{{route('customer.project-pay-now',[Hashids_encode($task->id)])}}" class="btn btn-view">Pay now</a></td>
                        @endif
                    </tr>
                    @endif
                @endforeach
                {{-- <tr>
                    <td>03</td>
                    <td>Milestone 2</td>
                    <td>£2300</td>
                    <td>£360 <span class="max_">(Max. £800)</span></td>
                    <td class="text-warning">Pending</td>
                    <td><a href="{{route('customer.project-pay-now',[Hashids_encode($row->id)])}}" class="btn btn-view">Pay now</a></td>
                    @else
                    <td class="text-success">Paid</td>
                    @endif
                </tr> --}}
            </tbody>
        </table>
        </div>
    </div>
</div>

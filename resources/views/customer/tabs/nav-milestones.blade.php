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
                <tr>
                    <td>01</td>
                    <td>Initial payment</td>
                    <td>£2300</td>
                    <td>£360</td>
                    <td class="text-success">Paid</td>
                    @if ($status == 'project_started')
                        <td></td>
                    @endif
                </tr>
                <tr>
                    <td>02</td>
                    <td>Milestone 1</td>
                    <td>£2300</td>
                    <td>£360</td>
                    <td class="text-success">Paid</td>
                    @if ($status == 'project_started')
                        <td></td>
                    @endif
                </tr>
                <tr>
                    <td>03</td>
                    <td>Milestone 2</td>
                    <td>£2300</td>
                    <td>£360 <span class="max_">(Max. £800)</span></td>
                    <td class="text-warning">Pending</td>
                    @if ($status == 'project_started')
                        <td><a href="pay-now.html" class="btn btn-view">Pay now</a></td>
                    @endif
                </tr>
                <tr>
                    <td>04</td>
                    <td>Milestone 3</td>
                    <td>£2300</td>
                    <td>£360 <span class="max_">(Max. £800)</span></td>
                    <td class="text-warning">Pending</td>
                    @if ($status == 'project_started')
                        <td><a href="pay-now.html" class="btn btn-view">Pay now</a></td>
                    @endif
                </tr>
            </tbody>
        </table>
        </div>
    </div>
</div>

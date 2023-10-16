@extends('email.base')

@section('content')
<p>Unfortunately your estimate for the project @if(@$data && @$data['project_name'])titled "{{ $data['project_name'] }}" @endif has not been successful on this occasion.</p>
<p style="margin-bottom: 40px; margin-top: 40px;">This could be due to a number of reasons, for example the customer changing their plans about the project.</p>
<p>There will be more project requests in the future, and we wish you good luck in securing your next project.</p>
@endsection

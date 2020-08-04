@extends('crypto-evaluator::layouts.app')
@section('content')
<h2>{{ __('crypto-evaluator::tracing.overview') }}</h2>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('crypto-evaluator::tracing.ip') }}</th>
                <th>{{ __('crypto-evaluator::tracing.isp') }}</th>
                <th>{{ __('crypto-evaluator::tracing.city') }}</th>
                <th>{{ __('crypto-evaluator::tracing.organisation') }}</th>
                <th>{{ __('crypto-evaluator::tracing.postalcode') }}</th>
                <th>{{ __('crypto-evaluator::tracing.timestamp') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitors as $visitor)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $visitor->ip }}</td>
                <td>{{ $visitor->ISP }}</td>
                <td>{{ $visitor->city }}</td>
                <td>{{ $visitor->organisation }}</td>
                <td>{{ $visitor->postalcode }}</td>
                <td>{{ $visitor->timestamp->format('d-m-Y H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
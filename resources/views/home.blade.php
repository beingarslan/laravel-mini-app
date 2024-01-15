@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">

                    @if($election)
                    <div class="alert alert-success" role="alert">
                        Elections are currently running.
                    </div>
                    @foreach($candidates as $candidate)
                    <div class="card mt-3">
                        <div class="card-header">{{$candidate->candidate}}</div>
                        <div class="card-body">
                            <p>Party: {{$candidate->party->party_name}}</p>
                            <p>Constituency: {{$candidate->constituency->constituency_name}}</p>
                        </div>
                        @if(!auth()->user()->constituency_id)
                        <div class="card-footer">
                            <form action="{{route('vote')}}" method="POST">
                                @csrf
                                <input type="hidden" name="candidate_id" value="{{$candidate->id}}">
                                <button class="btn btn-primary w-100" type="submit">Vote</button>
                            </form>
                        </div>
                        @endif
                    </div>
                    @endforeach
                    @else
                    <div class="alert alert-warning" role="alert">
                        Elections are currently not running.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

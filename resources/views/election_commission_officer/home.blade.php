@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Election Commission Officer\'s Dashboard') }}</div>
                <div class="card-body">
                    @if($election)
                    <div class="alert alert-success" role="alert">
                        Elections are currently running.
                    </div>
                    <form action="{{route('election_commission_officer.elections.update')}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$election->id}}" name="election_id" />
                        <button type="submit" class="btn btn-danger">End Elections</button>
                    </form>
                    @foreach($candidates as $candidate)
                    <div class="card mt-3">
                        <div class="card-header">{{$candidate->candidate}}</div>
                        <div class="card-body">
                            <p><strong>Party:</strong> {{$candidate->party->party_name}}</p>
                            <p><strong>Constituency:</strong> {{$candidate->constituency->constituency_name}}</p>
                            <p><strong>Votes:</strong> {{$candidate->vote_count}}</p>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="alert alert-warning" role="alert">
                        Elections are currently not running.
                    </div>
                    <form action="{{route('election_commission_officer.elections.update')}}" method="post">
                        @csrf
                        <input type="hidden" value="0" name="election_id" />
                        <button type="submit" class="btn btn-primary">Start Elections</button>
                    </form>

                    @endif
                </div>
            </div>
            @if(!$election)
            <div class="card mt-5">
                <div class="card-header">{{ __('Announce Winners') }}</div>
                <div class="card-body">
                    <div class="alert alert-warning" role="alert">
                        Elections are currently not running.
                    </div>
                    <form action="{{route('election_commission_officer.announcement')}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success">Announce Winners</button>
                    </form>

                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

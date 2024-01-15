@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Election Commission Officer\'s Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form action="{{route('election_commission_officer.elections.update')}}" method="post">
                        @csrf
                        @if($election)
                        <div class="alert alert-success" role="alert">
                            Elections are currently running.
                        </div>
                        <input type="hidden" value="{{$election->id}}" name="election_id" />
                        <button type="submit" class="btn btn-danger">End Elections</button>
                        @else
                        <div class="alert alert-warning" role="alert">
                            Elections are currently not running.
                        </div>
                        <input type="hidden" value="0" name="election_id" />
                        <button type="submit" class="btn btn-primary">Start Elections</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

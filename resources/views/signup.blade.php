@extends('layouts.app')


@section('content')

<div class="container mt-5" id="show1">
    <div class="row">
        <div class="col-md-6">
                    <div class="card" >
                    <img src="{{ asset('images/freelancer.png') }}" class="card-img-top" alt="...">
                    <div class="card-body text-center">
                    <h2>Register as Freelancer</h2>
                    <button class="btn btn-info mt-3">Create Freelance Account</button>
                    </div>
                    </div>
        </div>
        <div class="col-md-6">
                <div class="card" >
                <img src="{{ asset('images/client.png') }}" class="card-img-top" alt="...">
                <div class="card-body text-center">
                   <h2 >Register as Client</h2>
                   <button class="btn btn-success mt-3">Create Client Account</button>
                </div>
                </div>
        </div>
    </div>
</div>




@endsection
<!-- Page Content -->
@extends('owner.master')
@section('body')
    <div id="content">
        <h1 class="mb-4">Owner Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary text-white text-center p-3">
                    <h4>Total Hotels</h4>
                    <p>10</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white text-center p-3">
                    <h4>Total Users</h4>
                    <p>150</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white text-center p-3">
                    <h4>Bookings</h4>
                    <p>45</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white text-center p-3">
                    <h4>Pending Requests</h4>
                    <p>5</p>
                </div>
            </div>
        </div>
    </div>
@endsection

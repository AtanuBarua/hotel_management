@extends('front.master')
@section('body')
    <!-- Featured Hotels -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Featured Hotels</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Hotel">
                        <div class="card-body">
                            <h5 class="card-title">Luxury Hotel</h5>
                            <p class="card-text">A wonderful place to stay.</p>
                            <a href="#" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Hotel">
                        <div class="card-body">
                            <h5 class="card-title">Cozy Inn</h5>
                            <p class="card-text">Affordable and comfortable.</p>
                            <a href="#" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/350x200" class="card-img-top" alt="Hotel">
                        <div class="card-body">
                            <h5 class="card-title">Beach Resort</h5>
                            <p class="card-text">Enjoy the sea view.</p>
                            <a href="#" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

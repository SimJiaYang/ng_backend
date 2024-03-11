@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Plant Inventory</h5>
                <div class="card-body">
                    @foreach ($plant as $plants)
                        <form method="POST" action="" enctype="">
                            @csrf
                            {{-- Stock --}}
                            <div class="col-md-12 mt-md-1 mt-sm-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="number" class="form-control" placeholder="9" name="quantity"
                                        onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"
                                        min="0" required value="{{ $plants->quantity }}" readonly />
                                    <label for="inventory">Plant Inventory</label>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('plant.index') }}" class="btn btn-primary" value="Back">Back</a>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

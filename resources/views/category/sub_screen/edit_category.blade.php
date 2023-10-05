@extends('layouts.app')

@section('content')
    <style>
        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration {
            background-color: #ECFFDC;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        /* .card-registration .select-arrow {
                                                                                                                                                                                                                                                                                top: 13px;
                                                                                                                                                                                                                                                                            } */
    </style>

    <section class=" gradient-custom">
        <div class="container py-5 h-100">
            <div class="row  h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 display-5">Edit Category</h3>
                            @foreach ($category as $categories)
                                <form method="POST" action="{{ route('category.update', $categories->id) }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 mb-4 d-flex align-items-center">
                                            <div class="form-outline">
                                                <input type="text" id="id" name="id"
                                                    class="form-control form-control-lg" placeholder="ID"
                                                    value="{{ $categories->id }}" readonly />
                                                <label class="form-label" for="name">ID</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4 d-flex align-items-center">
                                            <div class="form-outline">
                                                <input type="text" id="name" name="name"
                                                    class="form-control form-control-lg" placeholder="Category Name"
                                                    value="{{ $categories->name }}" required />
                                                <label class="form-label" for="name">Category Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4 ">
                                            <select class="select form-control-lg px-3" id="selectOption" name="type">
                                                <option hidden value="{{ $categories->type }}">
                                                    {{ $categories->type }}</option>
                                                <option value="plant">Plant</option>
                                                <option value="product">Product</option>
                                            </select>
                                            <div class="w-100"></div>
                                            <label class="form-label">Category Type</label>
                                        </div>
                                    </div>

                                    <div class="mt-1 pt-2">
                                        <input class="btn btn-lg" style="background-color: #00A36C; color: white;"
                                            type="submit" value="Submit" />
                                        <a href="{{ route('category.index') }}" class="btn btn-lg"
                                            style="background-color: #00A36C; color: white;" type="submit"
                                            value="Back">Back</a>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

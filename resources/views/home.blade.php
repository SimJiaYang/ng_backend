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
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 display-5">Admin Dashboard</h3>

                            <div class="row col-md-10 ">
                                <div class="col-md-10 mb-0 d-flex align-items-center">
                                    {{-- Customer --}}
                                    <a href="{{ route('customer.index') }}"
                                        class="list-group-item list-group-item-action ripple py-2">
                                        <img src="{{ url('/icon/find-job-icon.png') }}" alt="" width="20"
                                            height="20" class="d-inline-block align-text-top mx-2">
                                        <span class="mt-1 h5 fw-normal">Customer</span>
                                    </a>
                                </div>
                                {{-- <div class="col-md-6 mb-4 d-flex align-items-center">
                                </div> --}}
                            </div>

                            <hr class="bg-danger border-2 border-top border-dark" />

                            <div class="row col-md-10">
                                <div class="col-md-5 mb-0 d-flex align-items-center">
                                    {{-- Plant --}}
                                    <a href="{{ route('plant.index') }}"
                                        class="list-group-item list-group-item-action ripple py-2">
                                        <img src="{{ url('/icon/flower-plant-icon.png') }}" alt="" width="20"
                                            height="20" class="d-inline-block align-text-top mx-2">
                                        <span class="mt-3 h5 fw-normal">Plant</span>
                                    </a>
                                </div>
                                <div class="col-md-5 mb-0 d-flex align-items-center">
                                    <a href="{{ route('plant.insert') }}"
                                        class="list-group-item list-group-item-action ripple py-2">
                                        <img src="{{ url('/icon/add_icon.png') }}" alt="" width="20"
                                            height="20" class="d-inline-block align-text-top mx-2">
                                        <span class="mt-3 h5 fw-normal">Add Plant</span>
                                    </a>
                                </div>

                            </div>

                            <hr class="bg-danger border-2 border-top border-dark" />

                            <div class="row col-md-10">
                                <div class="col-md-5 mb-0 d-flex align-items-center">
                                    {{-- Product --}}
                                    <a href="{{ route('product.index') }}"
                                        class="list-group-item list-group-item-action ripple py-2">
                                        <img src="{{ url('/icon/box-package-icon.png') }}" alt="" width="20"
                                            height="20" class="d-inline-block align-text-top mx-2">
                                        <span class="mt-3 h5 fw-normal">Product</span>
                                    </a>
                                </div>
                                <div class="col-md-5 mb-0 d-flex align-items-center">
                                    <a href="{{ route('product.insert') }}"
                                        class="list-group-item list-group-item-action ripple py-2">
                                        <img src="{{ url('/icon/add_icon.png') }}" alt="" width="20"
                                            height="20" class="d-inline-block align-text-top mx-2">
                                        <span class="mt-3 h5 fw-normal">Add Product</span>
                                    </a>
                                </div>

                            </div>

                            <hr class="bg-danger border-2 border-top border-dark" />

                            <div class="row col-md-10">
                                <div class="col-md-5 mb-0 d-flex align-items-center">
                                    {{-- Category --}}
                                    <a href="{{ route('category.index') }}"
                                        class="list-group-item list-group-item-action ripple py-2">
                                        <img src="{{ url('/icon/list-round-bullet-icon.png') }}" alt=""
                                            width="20" height="20" class="d-inline-block align-text-top mx-2">
                                        <span class="mt-3 h5 fw-normal">Categories</span>
                                    </a>
                                </div>

                                <div class="col-md-5 mb-0 d-flex align-items-center">
                                    <a href="{{ route('category.insert') }}"
                                        class="list-group-item list-group-item-action ripple py-2">
                                        <img src="{{ url('/icon/add_icon.png') }}" alt="" width="20"
                                            height="20" class="d-inline-block align-text-top mx-2">
                                        <span class="mt-3 h5 fw-normal">Add Category</span>
                                    </a>
                                </div>
                            </div>

                            <hr class="bg-danger border-2 border-top border-dark" />

                            <div class="row col-md-10">
                                <div class="col-md-10 mb-0 d-flex align-items-center">
                                    {{-- Order --}}
                                    <a href="{{ route('order.index') }}"
                                        class="list-group-item list-group-item-action ripple py-2">
                                        <img src="{{ url('/icon/text-document-check-icon.png') }}" alt=""
                                            width="20" height="20" class="d-inline-block align-text-top mx-2">
                                        <span class="mt-3 h5 fw-normal">Orders</span>
                                    </a>
                                </div>

                            </div>

                            <hr class="bg-danger border-2 border-top border-dark" />

                            <div class="row col-md-10">
                                <div class="col-md-10 mb-0 d-flex align-items-center">
                                    {{-- Bidding --}}
                                    <a href="{{ route('bidding.index') }}"
                                        class="list-group-item list-group-item-action ripple py-2">
                                        <img src="{{ url('/icon/penalty-icon.png') }}" alt="" width="20"
                                            height="20" class="d-inline-block align-text-top mx-2">
                                        <span class="mt-3 h5 fw-normal">Biddings</span>
                                    </a>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

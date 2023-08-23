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
    <script>
        function preview() {
            frame.src = URL.createObjectURL(event.target.files[0]);
        }

        function clearImage() {
            document.getElementById('formFile').value = null;
            frame.src = "";
        }
    </script>

    <section class=" gradient-custom">
        <div class="container py-5 h-100">
            <div class="row  h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 display-5">Edit Product</h3>
                            @foreach ($product as $products)
                                <form method="POST" action="{{ route('product.update', $products->id) }}"
                                    onsubmit="return getSelectedOption();" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6 mb-4 d-flex align-items-center">
                                            <div class="form-outline">
                                                <input type="text" id="id" name="id"
                                                    class="form-control form-control-lg" placeholder="ID"
                                                    value="{{ $products->id }}" readonly />
                                                <label class="form-label" for="name">Product ID</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-4 d-flex align-items-center">
                                            <div class="form-outline">
                                                <input type="text" id="name" name="name"
                                                    class="form-control form-control-lg" placeholder="Product Name"
                                                    value="{{ $products->name }}" required />
                                                <label class="form-label" for="name">Product Name</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">


                                        <div class="col-md-4 mb-4 ">
                                            <input type="number" id="quantity" name="quantity"
                                                onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                min="0" class="form-control form-control-lg"
                                                placeholder="Product Inventory" required
                                                value="{{ $products->quantity }}" />
                                            <div class="w-100"></div>
                                            <label class="form-label">Product Quantity</label>
                                        </div>

                                        <div class="col-md-4 mb-4 d-flex align-items-center">

                                            <div class="form-outline">
                                                <input type="number" id="price" name="price" step=".01"
                                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                                    event.charCode == 46 || event.charCode == 0 "
                                                    min="0" class="form-control form-control-lg"
                                                    placeholder="Product Price" required value="{{ $products->price }}" />
                                                <label class="form-label" for="price">Product Price</label>
                                            </div>


                                        </div>

                                        <div class="col-md-4 mb-4 d-flex align-items-center">
                                            <div class="form-outline">
                                                <select class="select form-control-lg px-3 col-md-12" id="selectCategory"
                                                    name="category_id">
                                                    <option hidden value="{{ $products->cat_id }}">{{ $products->cat_name }}
                                                    </option>
                                                    @foreach ($category as $categories)
                                                        <option value="{{ $categories->id }}">{{ $categories->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="w-100"></div>
                                                <label class="form-label">Product Category</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-12 mb-4 d-flex align-items-center">
                                            <div class="form-outline col-md-12">
                                                <textarea class="form-control col-md-12" id="description" rows="3" name="description" maxlength="500" required
                                                    value="{{ $products->description }}">{{ $products->description }}</textarea>
                                                <label class="form-label" for="name">Product Description</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4 d-flex align-items-center">
                                            <div class="form-outline">
                                                <input class="form-control" type="file" id="formFile" name="image"
                                                    onchange="preview()" value="{{ $products->image }}"
                                                    placeholder="{{ $products->image }}">
                                                <label class="form-label" for="name">Product Image</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 mb-4 d-flex align-items-center">
                                            <div class="form-outline">
                                                <img id="frame" class="img-fluid m-1" style="height:200px; width:200px"
                                                    src="/{{ $products->image }}" />
                                                <div class="w-100">
                                                </div>
                                                <label class="form-label" for="name">Product Image Preview</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-1 pt-2">
                                        <input class="btn btn-lg" style="background-color: #00A36C; color: white;"
                                            type="submit" value="Submit" />
                                        <a href="{{ route('product.index') }}" class="btn btn-lg"
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

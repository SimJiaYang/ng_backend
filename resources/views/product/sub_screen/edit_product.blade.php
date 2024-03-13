@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Edit product</h5>
                <div class="card-body">
                    @foreach ($product as $products)
                        <form method="POST" action="{{ route('product.update', $products->id) }}"
                            onsubmit="return getSelectedOption();" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Personal Info -->
                                <div class="col-12">
                                    <h6 class="mt-2">1. Product Information</h6>
                                    <hr class="mt-0" />
                                </div>

                                <!-- Plant Details -->
                                {{-- Product ID --}}
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" placeholder="Soil" name="id"
                                            required value="{{ $products->id }}" readonly />
                                        <label for="id">Product ID</label>
                                    </div>
                                </div>

                                {{-- Name --}}
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" placeholder="Soil" name="name"
                                            required value="{{ $products->name }}" />
                                        <label for="name">Product Name</label>
                                    </div>
                                </div>

                                {{-- Price --}}
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" class="form-control" placeholder="99.99" name="price"
                                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                            event.charCode == 46 || event.charCode == 0 "
                                            min="1" step="0.01" required value="{{ $products->price }}" />
                                        <label for="price">Product Price</label>
                                    </div>
                                </div>

                                {{-- Category --}}
                                <div class="form-floating form-floating-outline col-md-6 mb-3">
                                    <select class="form-select" id="selectCategory" aria-label="Default select example"
                                        name="category_id">
                                        <option hidden value="{{ $products->category_id }}">
                                            {{ $products->cat_name }}
                                        </option>
                                        @foreach ($category as $categories)
                                            <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="exampleFormControlSelect1">Category</label>
                                </div>

                                {{-- Material --}}
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" placeholder="Soil" name="material"
                                            required value="{{ $products->material }}" />
                                        <label for="material">Product Material</label>
                                    </div>
                                </div>

                                {{-- Size --}}
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" class="form-control" placeholder="99.99" name="size"
                                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                            event.charCode == 46 || event.charCode == 0 "
                                            min="1" step="0.01" required value="{{ $products->size }}" />
                                        <label for="price">Product Size</label>
                                    </div>
                                </div>

                                {{-- Weight --}}
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" class="form-control" placeholder="99.99" name="weight"
                                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                            event.charCode == 46 || event.charCode == 0 "
                                            min="1" step="0.01" required value="{{ $products->weight }}" />
                                        <label for="weight">Product Weight</label>
                                    </div>
                                </div>

                                {{-- Length --}}
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" class="form-control" placeholder="99.99" name="length"
                                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                            event.charCode == 46 || event.charCode == 0 "
                                            min="0" step="0.01" value="{{ $products->length }}" required />
                                        <label for="length">Product Length</label>
                                    </div>
                                </div>

                                {{-- Plant Status --}}
                                <div class="form-floating form-floating-outline col-md-12 mb-3 mt-sm-3 mt-md-0">
                                    <select class="form-select" id="status" name="status">
                                        <option hidden value="{{ $products->status }}">
                                            {{ $products->status == true ? 'Show' : 'Hide' }}
                                        </option>
                                        <option value={{ 1 }}>Show</option>
                                        <option value={{ 0 }}>Hide</option>
                                    </select>
                                    <label for="exampleFormControlSelect1">Product Status</label>
                                </div>


                                {{-- Description --}}
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control h-px-100" name="description" maxlength="500"
                                            placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmm ad minim veniam......"
                                            rows="3" required value="{{ $products->description }}">{{ $products->description }}</textarea>
                                        <label for="description">Product description</label>
                                    </div>
                                </div>

                                {{-- Additional Description --}}
                                <div class="col-md-12">
                                    <div class="form-floating form-floating-outline">
                                        <textarea class="form-control h-px-100" name="other" maxlength="1000"
                                            placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmm ad minim veniam......"
                                            rows="3" value="{{ $products->other }}">{{ $products->other }}</textarea>
                                        <label for="description">Addtional description(Optional)</label>
                                    </div>
                                </div>

                                <h6 class="mt-3">Product Image &amp; Preview</h6>
                                @foreach ($products->image_file_name as $image)
                                    <div class="col m-3 ">
                                        <div class="form-floating form-floating-outline">
                                            <img id="frame" class="img-fluid m-1" style="height:200px; width:200px"
                                                src="{{ asset('product_image') }}/{{ $image }}" />
                                        </div>
                                    </div>
                                @endforeach

                                {{-- Image --}}
                                <div class="col-md-12">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="file" id="formFile" name="image[]"
                                            multiple accept="image/*">
                                        <label for="formValidationFile">Plant Image</label>
                                    </div>
                                </div>

                                <!-- Plant Image Info -->
                                <div class="col-12 mt-3">
                                    <h6 class="mt-2">3. Stock Information </h6>
                                    <hr class="mt-0" />
                                </div>

                                {{-- Stock --}}
                                <div class="col-md-6 mt-md-1 mt-sm-3">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" class="form-control" placeholder="9" name="quantity"
                                            onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"
                                            min="0" required value="{{ $products->quantity }}" readonly />
                                        <label for="inventory">Product Inventory</label>
                                    </div>
                                </div>

                                {{-- Button --}}
                                <div class="col-md-12 mt-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ route('product.index') }}" class="btn btn-primary"
                                        value="Back">Back</a>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        function preview() {
            frame.src = URL.createObjectURL(event.target.files[0]);
        }

        function clearImage() {
            document.getElementById('formFile').value = null;
            frame.src = "";
        }
    </script>
@endsection

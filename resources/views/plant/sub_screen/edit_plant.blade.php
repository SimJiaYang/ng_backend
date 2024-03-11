@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Edit plant</h5>
                <div class="card-body">


                    @foreach ($plant as $plants)
                        <form method="POST" action="{{ route('plant.update', $plants->id) }}"
                            onsubmit="return getSelectedOption();" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Personal Info -->
                                <div class="col-12">
                                    <h6 class="mt-2">1. Plant Information</h6>
                                    <hr class="mt-0" />
                                </div>

                                <!-- Plant Details -->
                                <div class="col-md-12 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" id="id" name="id" class="form-control"
                                            placeholder="ID" value="{{ $plants->id }}" readonly />
                                        <label for="name">ID</label>
                                    </div>
                                </div>

                                {{--    Plant Name --}}
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" placeholder="Lotus" name="name"
                                            value="{{ $plants->name }}"" required />
                                        <label for="name">Plant Name</label>
                                    </div>
                                </div>

                                {{--    Plant Price --}}
                                <div class="col-md-6 mb-3">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" class="form-control" placeholder="99.99" name="price"
                                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                    event.charCode == 46 || event.charCode == 0 "
                                            min="1" step="0.01" value="{{ $plants->price }}" required />
                                        <label for="price">Plant Price</label>
                                    </div>
                                </div>

                                {{-- Plant Placement --}}
                                <div class="form-floating form-floating-outline col-md-6">
                                    <select class="form-select" id="placement" name="placement">
                                        <option hidden value="{{ $plants->placement }}" selected>
                                            {{ $plants->placement }}</option>
                                        <option value="Indoor">Indoor</option>
                                        <option value="Outdoor">Outdoor</option>
                                    </select>
                                    <label for="exampleFormControlSelect1">Placement</label>
                                </div>

                                {{-- Temperature --}}
                                <div class="col-md-6 mt-sm-3 mt-md-0">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" class="form-control" placeholder="26 Celsius"
                                            name="temperature" value="{{ $plants->temperature }}"
                                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                        event.charCode == 46 || event.charCode == 0 "
                                            min="1" step="0.01" required />
                                        <label for="price">Temperature</label>
                                    </div>
                                </div>

                                {{-- Water Need --}}
                                <div class="form-floating form-floating-outline col-md-6 mb-3 mt-3">
                                    <select class="form-select" id="selectWater" name="water">
                                        <option hidden value="{{ $plants->water_need }}">
                                            {{ $plants->water_need }}</option>
                                        <option value="High">High</option>
                                        <option value="Moderate">Moderate</option>
                                        <option value="Low">Low</option>
                                    </select>
                                    <label for="exampleFormControlSelect1">Water Need</label>
                                </div>

                                {{-- Height --}}
                                <div class="col-md-6 mb-3 mt-md-3">
                                    <div class="form-floating form-floating-outline ">
                                        <input type="number" class="form-control" placeholder="1.15" name="height"
                                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                                    event.charCode == 46 || event.charCode == 0 "
                                            min="0" step="0.01" required value="{{ $plants->height }}" />
                                        <label for="price">Mature Height</label>
                                    </div>
                                </div>

                                {{-- Sunlight Need --}}
                                <div class="form-floating form-floating-outline col-md-6 mb-3">
                                    <select class="form-select" id="selectSunlight" name="sunlight">
                                        <option hidden value="{{ $plants->sunlight_need }}">
                                            {{ $plants->sunlight_need }}</option>
                                        <option value="Full">Full</option>
                                        <option value="Partial">Partial</option>
                                        <option value="Shade">Shade</option>
                                    </select>
                                    <label for="exampleFormControlSelect1">Sunlight Need</label>
                                </div>

                                {{-- Size --}}
                                <div class="col-md-6 mt-md-0 mt-sm-0">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" class="form-control" placeholder="5 CM" name="size"
                                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                    event.charCode == 46 || event.charCode == 0 "
                                            min="0" step="0.01" value="{{ $plants->size }}" required />
                                        <label for="price">Size</label>
                                    </div>
                                </div>

                                {{-- Weight --}}
                                <div class="col-md-6 mt-md-0 mt-sm-3">
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" class="form-control" placeholder="5 KG" name="weight"
                                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                    event.charCode == 46 || event.charCode == 0 "
                                            min="0" step="0.01" value="{{ $plants->weight }}" required />
                                        <label for="price">Weight</label>
                                    </div>
                                </div>

                                {{-- Origin --}}
                                <div class="col-md-6 mt-md-0 mt-sm-3">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" placeholder="Malaysia" name="origin"
                                            value="{{ $plants->origin }}" required />
                                        <label for="origin">Plant Origin</label>
                                    </div>
                                </div>

                                {{-- Category --}}
                                <div class="form-floating form-floating-outline col-md-6 mb-3 mt-md-3 mt-sm-3">
                                    <select class="form-select" id="selectCategory" aria-label="Default select example"
                                        name="category_id">
                                        <option hidden value="{{ $plants->category_id }}">{{ $plants->cat_name }}
                                            @foreach ($category as $categories)
                                        <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                    @endforeach
                    </select>
                    <label for="exampleFormControlSelect1">Category</label>
                </div>

                {{-- Experience --}}
                <div class="form-floating form-floating-outline col-md-6 mt-md-3">
                    <select class="form-select" id="selectExperience" name="experience">
                        <option hidden value="{{ $plants->experience }}"> {{ $plants->experience }} </option>
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Experienced">Experienced</option>
                    </select>
                    <label for="exampleFormControlSelect1">Experience Level</label>
                </div>

                {{-- Plant Status --}}
                <div class="form-floating form-floating-outline col-md-12 mb-3 mt-sm-3 mt-md-0">
                    <select class="form-select" id="status" name="status">
                        <option hidden value="{{ $plants->status }}">
                            {{ $plants->status == true ? 'Show' : 'Hide' }}
                        </option>
                        <option value={{ 1 }}>Show</option>
                        <option value={{ 0 }}>Hide</option>
                    </select>
                    <label for="exampleFormControlSelect1">Plant Status</label>
                </div>

                {{-- Plant Description --}}
                <div class="col-md-12">
                    <div class="form-floating form-floating-outline col-md-12 mb-3">
                        <div class="form-floating form-floating-outline ">
                            <textarea class="form-control h-px-100" name="description" maxlength="500"
                                placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmm ad minim veniam......"
                                rows="3" required value="{{ $plants->description }}">{{ $plants->description }}</textarea>
                            <label for="description">Plant description</label>
                        </div>
                    </div>
                </div>

                {{-- Additional Description --}}
                <div class="col-md-12">
                    <div class="form-floating form-floating-outline">
                        <textarea class="form-control h-px-100" name="other" maxlength="1000"
                            placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmm ad minim veniam......"
                            rows="3" value="{{ $plants->other }}">{{ $plants->other }}</textarea>
                        <label for="description">Addtional description(Optional)</label>
                    </div>
                </div>

                <h6 class="mt-3">Plant Image &amp; Preview</h6>
                @foreach ($plants->image_file_name as $image)
                    <div class="col m-3 ">
                        <div class="form-floating form-floating-outline">
                            <img id="frame" class="img-fluid m-1" style="height:200px; width:200px"
                                src="{{ asset('plant_image') }}/{{ $image }}" />
                        </div>
                    </div>
                @endforeach

                {{-- Image --}}
                <div class="col-md-12">
                    <div class="form-floating form-floating-outline">
                        <input class="form-control" type="file" id="formFile" name="image[]" multiple
                            accept="image/*">
                        <label for="formValidationFile">Plant Image</label>
                    </div>
                </div>

                <!-- Pot Information -->
                <div class="col-12 mt-3">
                    <h6 class="mt-2">2. Pot Information (Optional) </h6>
                    <hr class="mt-0" />
                </div>

                {{-- Pot Name --}}
                <div class="col-md-6 mt-md-1 mt-sm-3">
                    <div class="form-floating form-floating-outline">
                        <input type="text" class="form-control" placeholder="Pot..." name="pot_name"
                            value="{{ $plants->pot_name }}" />
                        <label for="name">Pot Name</label>
                    </div>
                </div>

                {{-- Size --}}
                <div class="col-md-6 mt-md-1 mt-sm-3">
                    <div class="form-floating form-floating-outline">
                        <input type="number" class="form-control" placeholder="10 CM" name="pot_size"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) ||
                                event.charCode == 46 || event.charCode == 0 "
                            min="0" step="0.01" value="{{ $plants->pot_size }}" />
                        <label for="price">Size</label>
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
                            min="0" required value="{{ $plants->quantity }}" readonly />
                        <label for="inventory">Plant Inventory</label>
                    </div>
                </div>

                <div class="col-md-12 mb-3 mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('plant.index') }}" class="btn btn-primary" value="Back">Back</a>
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

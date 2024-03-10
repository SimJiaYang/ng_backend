@extends('layouts.app')

@section('content')
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Create new category</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('category.store') }}" onsubmit="return getSelectedOption();">
                        @csrf
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="name" name="name" class="form-control"
                                id="basic-default-fullname" placeholder="Name" required />
                            <label for="basic-default-fullname">Name</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="slug" name="slug" class="form-control"
                                id="basic-default-fullname" placeholder="Slug" required />
                            <label for="basic-default-fullname">Slug</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <select class="form-select" id="selectOption" aria-label="Default select example"
                                onchange="getCategory()" name="type">
                                <option value="" disabled selected>Choose option</option>
                                <option value="Plant">Plant</option>
                                <option value="Product">Product</option>
                            </select>
                            <label for="exampleFormControlSelect1">Type</label>
                        </div>

                        @if ($category->count() > 0)
                            <div class="form-floating form-floating-outline mb-4" id="parent_dom" hidden>
                                <select class="form-select" id="parent_id" aria-label="Default select example"
                                    name="parent_id">
                                    <option value="" disabled selected>Choose option</option>
                                    @foreach ($category as $categories)
                                        @if ($categories->type == 'Plant')
                                            @if (old('type') === 'Plant')
                                                <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                            @endif
                                        @elseif ($categories->type == 'Product')
                                            @if (old('type') === 'Product')
                                                <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                                <label for="parent_id" id="parent_id_label">Parent</label>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('category.index') }}" class="btn btn-primary" value="Back">Back</a>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function getSelectedOption() {
                var selectElement = document.getElementById("selectOption");
                var selectedOptionValue = selectElement.value;

                if (selectedOptionValue === "") {
                    alert("Please select an option");
                    return false; // Prevent form submission
                } else {
                    return true; // Allow form submission
                }
            }

            function getCategory() {
                var selectedCategory = document.getElementById('selectOption').value;
                var parentDropdown = document.getElementById('parent_id');

                // Show parent dropdown if type is selected
                document.getElementById('parent_dom').hidden = false;

                // Clear existing options
                parentDropdown.innerHTML = '<option value="" disabled selected>Choose option</option>';

                // Filter and populate options based on selected category
                @foreach ($category as $categories)
                    @if ($categories->type == 'Plant')
                        if (selectedCategory === "Plant") {
                            var option = document.createElement('option');
                            option.value = "{{ $categories->id }}";
                            option.text = "{{ $categories->name }}";
                            parentDropdown.appendChild(option);
                        }
                    @elseif ($categories->type == 'Product')
                        if (selectedCategory === "Product") {
                            var option = document.createElement('option');
                            option.value = "{{ $categories->id }}";
                            option.text = "{{ $categories->name }}";
                            parentDropdown.appendChild(option);
                        }
                    @endif
                @endforeach
            }
        </script>
    @endsection

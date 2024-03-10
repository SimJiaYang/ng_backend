@extends('layouts.app')

@section('content')
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Category</h5>
                </div>
                <div class="card-body">
                    @foreach ($category as $categories)
                        <form method="POST" action="{{ route('category.update', $categories->id) }}">
                            @csrf
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" id="id" name="id" class="form-control"
                                    id="basic-default-fullname" placeholder="ID" value="{{ $categories->id }}" readonly />
                                <label for="basic-default-fullname">ID</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" id="name" name="name" class="form-control"
                                    id="basic-default-fullname" placeholder="Name" value="{{ $categories->name }}"
                                    required />
                                <label for="basic-default-fullname">Name</label>
                            </div>
                            <div class="form-floating form-floating-outline mb-4">
                                <input type="text" id="slug" name="slug" class="form-control"
                                    id="basic-default-fullname" placeholder="Name" value="{{ $categories->slug }}"
                                    required />
                                <label for="basic-default-fullname">Slug</label>
                            </div>

                            <div class="form-floating form-floating-outline mb-4">
                                <select class="form-select" id="selectOption" aria-label="Default select example"
                                    onchange="getCategory()" name="type">
                                    <option hidden value="{{ $categories->type }}">
                                        {{ $categories->type }}</option>
                                    <option value="Plant">Plant</option>
                                    <option value="Product">Product</option>
                                </select>
                                <label for="exampleFormControlSelect1">Type</label>
                            </div>

                            <div class="form-floating form-floating-outline mb-4" id="parent_dom">
                                <select class="form-select" id="parent_id" aria-label="Default select example"
                                    name="parent_id">
                                    {{-- Check if null --}}
                                    @if ($categories->parent_id == null)
                                        <option hidden value={{ null }}>
                                            -</option>
                                    @else
                                        <option hidden value="{{ $categories->parent_id }}">
                                            {{ $categories->parent }}</option>
                                    @endif

                                    {{-- Check if not null, add null selection --}}
                                    @if ($categories->parent_id != null)
                                        <option value={{ null }}>
                                            -</option>
                                    @endif

                                    {{-- Populate options initially --}}
                                    @if ($categories->type == 'Plant')
                                        @foreach ($all_category as $all_categories)
                                            @if ($all_categories->type == 'Plant' && $all_categories->id != $categories->id)
                                                <option value="{{ $all_categories->id }}">{{ $all_categories->name }}
                                                </option>\
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach ($all_category as $all_categories)
                                            @if ($all_categories->type == 'Product' && $all_categories->id != $categories->id)
                                                <option value="{{ $all_categories->id }}">{{ $all_categories->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endif

                                    {{-- Populate options --}}
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


                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('category.index') }}" class="btn btn-primary" value="Back">Back</a>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>

        <script>
            function getCategory() {
                var id = document.getElementById('id').value;
                var selectedCategory = document.getElementById('selectOption').value;
                var parentDropdown = document.getElementById('parent_id');

                // Clear existing options
                parentDropdown.innerHTML = '<option value="" disabled selected>Choose option</option>';

                // If parentoption not null, append null sellection
                if (parentDropdown.value != null) {
                    var option = document.createElement('option');
                    option.value = null;
                    option.text = "-";
                    parentDropdown.appendChild(option);
                }

                // Filter and populate options based on selected category
                @foreach ($all_category as $categories)
                    @if ($categories->type == 'Plant')
                        if (selectedCategory === "Plant") {
                            var option = document.createElement('option');
                            // If not same id, append option
                            if ({{ $categories->id }} != id) {
                                option.value = "{{ $categories->id }}";
                                option.text = "{{ $categories->name }}";
                                parentDropdown.appendChild(option);
                            }
                        }
                    @elseif ($categories->type == 'Product')
                        if (selectedCategory === "Product") {
                            var option = document.createElement('option');
                            // If not same id, append option
                            if ({{ $categories->id }} != id) {
                                option.value = "{{ $categories->id }}";
                                option.text = "{{ $categories->name }}";
                                parentDropdown.appendChild(option);
                            }
                        }
                    @endif
                @endforeach

            }
        </script>
    @endsection

@extends('layouts.app')
@section('content')
    <style>
        #table {
            /* background-color: #ECFFDC; */
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 5px 0 rgb(0 0 0 / 12%);
            display: flex;
            justify-content: center;
        }
    </style>

    <h1 class="display-5 mx-4">Plant List</h1>

    <div class="row justify-content-md-start col-md-7 col-sm-7">
        <div class="col-md-4 col-sm-4">
            <form action="{{ route('plant.search') }}" method="POST">
                @csrf
                <div class="input-group col-md-12 col-sm-12 mx-4 my-3">
                    <div class="form-outline col-md-8 col-sm-8">
                        <input id="name" name="name" type="search" id="form1" class="form-control"
                            placeholder="Name" />
                    </div>
                    <button id="search-button" type="submit" class="btn btn-primary col-md-4 col-sm-4 p-0"
                        style="background-color: #00A36C; color: white;">
                        Search
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-auto">
            <form action="{{ route('plant.insert') }}" method="GET">
                @csrf
                <div class="mx-4 my-2 py-2">
                    <button id="search-button" type="submit" class="btn btn-primary col-md-auto col-sm-auto"
                        style="background-color: #00A36C; color: white;">
                        Add Plant
                    </button>
                </div>

            </form>
        </div>


    </div>

    <div class="table-responsive col-11 mx-4" id="table">
        <table class="table align-middle mb-0 table-bordered border-secondary" id="tb">
            <thead class="bg-dark">
                <tr>
                    <th scope="col-1">ID</th>
                    <th scope="col-1">Image</th>
                    <th scope="col-1">Name</th>
                    <th scope="col-1">Category</th>
                    <th scope="col-1">Inventory</th>
                    <th scope="col-1">Price</th>
                    <th scope="col-1">Origin</th>
                    <th scope="col-1">Sunlight <br>Need</th>
                    <th scope="col-1">Water <br>Need</th>
                    <th scope="col-1">Mature <br>Height</th>
                    <th scope="col-1">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($plant as $plants)
                    <tr>
                        {{-- ID --}}
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-1">
                                    <p class="fw-bold mb-1">{{ $plants->id }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Image --}}
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-1">
                                    <img src="{{ asset('plant_image') }}/{{ $plants->image }}" class="img-fluid"
                                        style="height:100px; width:120px">
                                </div>
                            </div>
                        </td>

                        {{-- Name --}}
                        <td>
                            <p class="fw-normal mb-1">{{ $plants->name }}</p>
                        </td>

                        {{-- Category --}}
                        <td>
                            <div class="d-flex align-items-center">
                                <p class="mb-1">{{ $plants->cat_name }}</p>
                            </div>
                        </td>

                        {{-- Quantity --}}
                        <td>
                            <div class="d-flex align-items-center">
                                <p class="mb-1">{{ $plants->quantity }}</p>
                            </div>
                        </td>

                        {{-- Price --}}
                        <td>
                            <div class="d-flex align-items-center">
                                <p class="mb-1">{{ $plants->price }}</p>
                            </div>
                        </td>

                        {{-- Origin --}}
                        <td>
                            <div class="d-flex align-items-center">
                                <p class="mb-1">{{ $plants->origin }}</p>
                            </div>
                        </td>

                        {{-- Sunlight --}}
                        <td>
                            <div class="d-flex align-items-center">
                                <p class="mb-1">{{ $plants->sunglight_need }}</p>
                            </div>
                        </td>

                        {{-- Water --}}
                        <td>
                            <div class="d-flex align-items-center">
                                <p class="mb-1">{{ $plants->water_need }}</p>
                            </div>
                        </td>

                        {{-- Height --}}
                        <td>
                            <div class="d-flex align-items-center">
                                <p class="mb-1">{{ $plants->mature_height }}</p>
                            </div>
                        </td>

                        <td>
                            <a class="navbar-brand px-2" href="{{ route('plant.edit', $plants->id) }}">
                                <img src="{{ url('/icon/edit.png') }}" height="25" alt="" />
                            </a>

                            <a class="navbar-brand px-2" onclick="return confirm('Are you sure you want to delete?')"
                                href="{{ route('plant.delete', $plants->id) }}">
                                <img src="{{ url('/icon/delete.png') }}" height="25" alt="" />
                            </a>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>

    <div class="m-4 d-flex justify-content-between">
        {{-- {{ $customer->links('pagination.using-post') }} --}}
        {!! $plant->links('vendor.pagination.bootstrap-5') !!}
    </div>
@endsection

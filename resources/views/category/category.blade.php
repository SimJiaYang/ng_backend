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

    <h1 class="display-5 mx-4">Category List</h1>

    <div class="row justify-content-md-start col-md-7 col-sm-7">
        <div class="col-md-4 col-sm-4">
            <form action="{{ route('category.search') }}" method="POST">
                @csrf
                <div class="input-group col-md-12 col-sm-12 mx-4 my-3">
                    <div class="form-outline col-md-8 col-sm-8">
                        <input id="name" name="name" type="search" id="form1" class="form-control" />
                    </div>
                    <button id="search-button" type="submit" class="btn btn-primary col-md-4 col-sm-4 p-0"
                        style="background-color: #00A36C; color: white;">
                        Search
                    </button>
                </div>
            </form>
        </div>
        <div class="col-md-auto">
            <form action="{{ route('category.insert') }}" method="GET">
                @csrf
                <div class="mx-4 my-2 py-2">
                    <button id="search-button" type="submit" class="btn btn-primary col-md-auto col-sm-auto"
                        style="background-color: #00A36C; color: white;">
                        Add Category
                    </button>
                </div>

            </form>
        </div>


    </div>

    <div class="table-responsive col-6 m-4" id="table">
        <table class="table align-middle mb-0 table-bordered border-secondary" id="tb">
            <thead class="bg-dark">
                <tr>
                    <th scope="col-1">ID</th>
                    <th scope="col-2">Name</th>
                    <th scope="col-1">Type</th>
                    <th scope="col-2">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($category as $categories)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <p class="fw-bold mb-1">{{ $categories->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{ $categories->name }}</p>
                        </td>
                        <td>
                            <p>{{ $categories->type }}</p>
                        </td>
                        <td>
                            <a class="navbar-brand px-2" href="{{ route('category.edit', $categories->id) }}">
                                <img src="{{ url('/icon/edit.png') }}" height="25" alt="" />
                            </a>

                            <a class="navbar-brand px-2" onclick="return confirm('Are you sure you want to delete?')"
                                href="{{ route('category.delete', $categories->id) }}">
                                <img src="{{ url('/icon/delete.png') }}" height="25" alt="" />
                            </a>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>
@endsection

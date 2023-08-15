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

    <h1 class="display-5 mx-4">Customer List</h1>

    <div class="row justify-content-md-start col-md-7 col-sm-7">
        <div class="col-md-4 col-sm-4">
            <form action="{{ route('customer.search') }}" method="POST">
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


    </div>

    <div class="table-responsive col-6 m-4" id="table">
        <table class="table align-middle mb-0 table-bordered border-secondary" id="tb">
            <thead class="bg-dark">
                <tr>
                    <th scope="col-1">ID</th>
                    <th scope="col-2">Name</th>
                    <th scope="col-1">Email</th>
                    <th scope="col-2">Gender</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($customer as $customers)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <p class="fw-bold mb-1">{{ $customers->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{ $customers->name }}</p>
                        </td>
                        <td>
                            <p>{{ $customers->email }}</p>
                        </td>
                        <td>
                            <p>{{ $customers->gender }}</p>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
    <div class="m-4 d-flex justify-content-between">
        {{-- {{ $customer->links('pagination.using-post') }} --}}
        {!! $customer->links('vendor.pagination.bootstrap-5') !!}
    </div>
@endsection

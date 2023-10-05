@extends('layouts.app')

@section('content')
    <!-- Search -->
    <div class="navbar-nav align-items-left">
        <div class="nav-item d-flex align-items-left">
            <i class="mdi mdi-magnify mdi-24px lh-0"></i>
            <input type="text" class="form-control border-0 shadow-none bg-body" placeholder="Search..."
                aria-label="Search..." />
        </div>
    </div>
    <!-- /Search -->

    <br>

    <!-- Data Tables -->
    <div class="col-12">
        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th class="text-truncate">ID</th>
                            <th class="text-truncate">Name</th>
                            <th class="text-truncate">Type</th>
                            <th class="text-truncate">Action</th>
                            <th class="text-truncate">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $categories)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <p class="fw-bold mb-1">{{ $categories->id }}</p>
                                    </div>
                                </td>
                                <td class="text-truncate">
                                    <p class="fw-normal mb-1">{{ $categories->name }}</p>
                                </td>
                                <td class="text-truncate">
                                    <p class="fw-normal mb-1">{{ $categories->type }}</p>
                                </td>
                                <td class="text-truncate">
                                    <a class="navbar-brand px-2" href="{{ route('category.edit', $categories->id) }}">
                                        <img src="{{ url('/icon/edit.png') }}" height="25" alt="" />
                                    </a>

                                    <a class="navbar-brand px-2"
                                        onclick="return confirm('Are you sure you want to delete?')"
                                        href="{{ route('category.delete', $categories->id) }}">
                                        <img src="{{ url('/icon/delete.png') }}" height="25" alt="" />
                                    </a>
                                </td>
                                <td><span class="badge bg-label-warning rounded-pill">Pending</span>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Data Tables -->
@endsection

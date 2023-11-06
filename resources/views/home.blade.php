@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xl flex-grow-1 container-p-y">
            <div class="row gy-4">
                <!-- Congratulations card -->
                <div class="col-md-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-1">Congratulations🎉</h4>
                            <p class="pb-0">The company has earn</p>
                            <h4 class="text-primary mb-1">$42.8k</h4>
                            <p class="mb-2 pb-1">78% of target 🚀</p>
                            <a href="javascript:;" class="btn btn-sm btn-primary">View Sales</a>
                        </div>
                        <img src="../assets/img/icons/misc/triangle-light.png"
                            class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background"
                            data-app-light-img="icons/misc/triangle-light.png"
                            data-app-dark-img="icons/misc/triangle-dark.png" />
                        <img src="../assets/img/illustrations/trophy.png"
                            class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 mb-4 pb-2" width="83"
                            alt="view sales" />
                    </div>
                </div>
                <!--/ Congratulations card -->

                <!-- Transactions -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title m-0 me-2">Transactions</h5>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                        <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3"><span class="fw-medium">Total 48.5% growth</span> 😎 this month</p>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-primary rounded shadow">
                                                <i class="mdi mdi-trending-up mdi-24px"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <div class="small mb-1">Sales</div>
                                            <h5 class="mb-0">245k</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-success rounded shadow">
                                                <i class="mdi mdi-account-outline mdi-24px"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <div class="small mb-1">Customers</div>
                                            <h5 class="mb-0">12.5k</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-warning rounded shadow">
                                                <i class="mdi mdi-cellphone-link mdi-24px"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <div class="small mb-1">Product</div>
                                            <h5 class="mb-0">1.54k</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-info rounded shadow">
                                                <i class="mdi mdi-currency-usd mdi-24px"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <div class="small mb-1">Revenue</div>
                                            <h5 class="mb-0">$88k</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Transactions -->


                <!--/ Weekly Overview Chart -->

                <!-- Total Earnings -->
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Total Earning</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="totalEarnings" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalEarnings">
                                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 mt-md-3 mb-md-5">
                                <div class="d-flex align-items-center">
                                    <h2 class="mb-0">$24,895</h2>
                                    <span class="text-success ms-2 fw-medium">
                                        <i class="mdi mdi-menu-up mdi-24px"></i>
                                        <small>10%</small>
                                    </span>
                                </div>
                                <small class="mt-1">Compared to $84,325 last year</small>
                            </div>
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-4 pb-md-2">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="../assets/img/icons/misc/zipcar.png" alt="zipcar" class="rounded" />
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Zipcar</h6>
                                            <small>Vuejs, React & HTML</small>
                                        </div>
                                        <div>
                                            <h6 class="mb-2">$24,895.65</h6>
                                            <div class="progress bg-label-primary" style="height: 4px">
                                                <div class="progress-bar bg-primary" style="width: 75%"
                                                    role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-md-2">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="../assets/img/icons/misc/bitbank.png" alt="bitbank" class="rounded" />
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Bitbank</h6>
                                            <small>Sketch, Figma & XD</small>
                                        </div>
                                        <div>
                                            <h6 class="mb-2">$8,6500.20</h6>
                                            <div class="progress bg-label-info" style="height: 4px">
                                                <div class="progress-bar bg-info" style="width: 75%" role="progressbar"
                                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-md-3">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="../assets/img/icons/misc/aviato.png" alt="aviato" class="rounded" />
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Aviato</h6>
                                            <small>HTML & Angular</small>
                                        </div>
                                        <div>
                                            <h6 class="mb-2">$1,2450.80</h6>
                                            <div class="progress bg-label-secondary" style="height: 4px">
                                                <div class="progress-bar bg-secondary" style="width: 75%"
                                                    role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/ Total Earnings -->

                <!-- Four Cards -->
                <div class="col-xl-4 col-md-6">
                    <div class="row gy-4">
                        <!-- Total Profit line chart -->
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-header pb-0">
                                    <h4 class="mb-0">$86.4k</h4>
                                </div>
                                <div class="card-body">
                                    <div id="totalProfitLineChart" class="mb-3"></div>
                                    <h6 class="text-center mb-0">Total Profit</h6>
                                </div>
                            </div>
                        </div>
                        <!--/ Total Profit line chart -->
                        <!-- Total Profit Weekly Project -->
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-secondary rounded-circle shadow">
                                            <i class="mdi mdi-poll mdi-24px"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="totalProfitID"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalProfitID">
                                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body mt-mg-1">
                                    <h6 class="mb-2">Total Profit</h6>
                                    <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
                                        <h4 class="mb-0 me-2">$25.6k</h4>
                                        <small class="text-success mt-1">+42%</small>
                                    </div>
                                    <small>Weekly Project</small>
                                </div>
                            </div>
                        </div>
                        <!--/ Total Profit Weekly Project -->
                        <!-- New Yearly Project -->
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-primary rounded-circle shadow-sm">
                                            <i class="mdi mdi-wallet-travel mdi-24px"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="newProjectID"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="newProjectID">
                                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body mt-mg-1">
                                    <h6 class="mb-2">New Project</h6>
                                    <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
                                        <h4 class="mb-0 me-2">862</h4>
                                        <small class="text-danger mt-1">-18%</small>
                                    </div>
                                    <small>Yearly Project</small>
                                </div>
                            </div>
                        </div>
                        <!--/ New Yearly Project -->
                        <!-- Sessions chart -->
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-header pb-0">
                                    <h4 class="mb-0">2,856</h4>
                                </div>
                                <div class="card-body">
                                    <div id="sessionsColumnChart" class="mb-3"></div>
                                    <h6 class="text-center mb-0">Sessions</h6>
                                </div>
                            </div>
                        </div>
                        <!--/ Sessions chart -->
                    </div>
                </div>
                <!--/ Total Earning -->

                <!-- Sales by Countries -->
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Sales by Countries</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="saleStatus" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="saleStatus">
                                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <div class="avatar-initial bg-label-success rounded-circle">US</div>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center gap-1">
                                            <h6 class="mb-0">$8,656k</h6>
                                            <i class="mdi mdi-chevron-up mdi-24px text-success"></i>
                                            <small class="text-success">25.8%</small>
                                        </div>
                                        <small>United states of america</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h6 class="mb-0">894k</h6>
                                    <small>Sales</small>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <span class="avatar-initial bg-label-danger rounded-circle">UK</span>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center gap-1">
                                            <h6 class="mb-0">$2,415k</h6>
                                            <i class="mdi mdi-chevron-down mdi-24px text-danger"></i>
                                            <small class="text-danger">6.2%</small>
                                        </div>
                                        <small>United Kingdom</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h6 class="mb-0">645k</h6>
                                    <small>Sales</small>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <span class="avatar-initial bg-label-warning rounded-circle">IN</span>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center gap-1">
                                            <h6 class="mb-0">865k</h6>
                                            <i class="mdi mdi-chevron-up mdi-24px text-success"></i>
                                            <small class="text-success"> 12.4%</small>
                                        </div>
                                        <small>India</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h6 class="mb-0">148k</h6>
                                    <small>Sales</small>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <span class="avatar-initial bg-label-secondary rounded-circle">JA</span>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center gap-1">
                                            <h6 class="mb-0">$745k</h6>
                                            <i class="mdi mdi-chevron-down mdi-24px text-danger"></i>
                                            <small class="text-danger">11.9%</small>
                                        </div>
                                        <small>Japan</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h6 class="mb-0">86k</h6>
                                    <small>Sales</small>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <span class="avatar-initial bg-label-danger rounded-circle">KO</span>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center gap-1">
                                            <h6 class="mb-0">$45k</h6>
                                            <i class="mdi mdi-chevron-up mdi-24px text-success"></i>
                                            <small class="text-success">16.2%</small>
                                        </div>
                                        <small>Korea</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h6 class="mb-0">42k</h6>
                                    <small>Sales</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Sales by Countries -->


            </div>
        </div>
    @endsection

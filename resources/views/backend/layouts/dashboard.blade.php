@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">


                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right"></ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="info-box mb-3 d-flex justify-content-between align-items-center bg-primary text-white">
                            <div class="info-box-content">
                                <span class="info-box-text fw-bold" style="font-size: 2rem;">Product Gallery Manager</span>
                                <span class="info-box-number" style="font-size: .7rem;">
                                The Product Gallery Manager efficiently organizes and displays product images!
                            </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @php
                        $cardHeight = '150px';
                    @endphp

                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <div class="info-box d-flex justify-content-between align-items-center shadow-sm border rounded p-3" style="min-height: {{ $cardHeight }};">
                            <div class="info-box-content d-flex flex-column justify-content-center">
                                <span class="info-box-text fw-bold" style="font-size: 1.5rem;">Total Users</span>
                                <span class="info-box-number text-primary" style="font-size: 2rem;">{{ $totalUsers ?? 0 }}</span>
                            </div>
                            <span class="info-box-icon bg-white elevation-1 text-dark rounded-circle d-flex align-items-center justify-content-center" style="width:60px; height:60px;">
                               <i class="fas fa-users" style="font-size: 2rem;"></i>
                            </span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <div class="info-box d-flex justify-content-between align-items-center shadow-sm border rounded p-3" style="min-height: {{ $cardHeight }};">
                            <div class="info-box-content d-flex flex-column justify-content-center">
                                <span class="info-box-text fw-bold" style="font-size: 1.5rem;">Total Categories</span>
                                <span class="info-box-number text-primary" style="font-size: 2rem;">{{ $totalCategories ?? 0 }}</span>
                            </div>
                            <span class="info-box-icon bg-white elevation-1 text-dark rounded-circle d-flex align-items-center justify-content-center" style="width:60px; height:60px;">
                                <i class="fas fa-tags" style="font-size: 2rem;"></i>
                            </span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 mb-3">
                        <div class="info-box d-flex justify-content-between align-items-center shadow-sm border rounded p-3" style="min-height: {{ $cardHeight }};">
                            <div class="info-box-content d-flex flex-column justify-content-center">
                                <span class="info-box-text fw-bold" style="font-size: 1.5rem;">Total Products</span>
                                <span class="info-box-number text-primary" style="font-size: 2rem;">{{ $totalProducts ?? 0 }}</span>
                            </div>
                            <span class="info-box-icon bg-white elevation-1 text-dark rounded-circle d-flex align-items-center justify-content-center" style="width:60px; height:60px;">
                               <i class="fas fa-shopping-bag" style="font-size: 2rem;"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">{{ Auth()->user()->name }} - Dashboard</h5>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                            <i class="fas fa-wrench"></i>
                                        </button>
                                    </div>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        Welcome to {{ Auth()->user()->name }} - Dashboard
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

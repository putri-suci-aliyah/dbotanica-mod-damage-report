@extends('layouts.main')

@section('header')

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Dashboard</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

@endsection

@section('content')
    <div class="row">

        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h4 class="card-title text-white">Temuan Kerusakan</h4>
                            <h2 class="card-subtitle text-white">{{ $data_draft->count() }}</h2>
                        </div>
                        {{-- <div class="ml-auto">
                            <button type="button" class="btn btn-primary p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-settings"></i>
                            </button>

                        </div> --}}
                    </div>
                    <div id="spark4"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card bg-info">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h4 class="card-title text-white">Dalam Pengerjaan</h4>
                            <h2 class="card-subtitle text-white">{{ $data_sedang_diperbaiki->count() }}</h2>
                        </div>
                        {{-- <div class="ml-auto">
                            <button type="button" class="btn btn-info p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-settings"></i>
                            </button>

                        </div> --}}
                    </div>
                    <div id="spark5"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card bg-success">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h4 class="card-title text-white">Selesai Perbaikan</h4>
                            <h2 class="card-subtitle text-white">{{ $data_selesai_pengerjaan->count() }}</h2>
                        </div>
                        {{-- <div class="ml-auto">
                            <button type="button" class="btn btn-success  p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-settings"></i>
                            </button>

                        </div> --}}
                    </div>
                    <div id="spark6"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <div class="card bg-warning">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h4 class="card-title text-white">Total</h4>
                            <h2 class="card-subtitle text-white">{{ $data_keseluruhan->count() }}</h2>
                        </div>
                        {{-- <div class="ml-auto">
                            <button type="button" class="btn btn-warning p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-settings"></i>
                            </button>

                        </div> --}}
                    </div>
                    <div id="spark7"></div>
                </div>
            </div>
        </div>
        <!-- Column -->











    </div>




    <div class="row">
        <!-- column -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Temuan Kerusakan</h4>
                </div>
                <div class="comment-widgets scrollable" style="height:430px;">
                    <!-- Comment Row -->


                    @foreach ($data_draft as $item)
                        <div class="d-flex flex-row comment-row m-t-0">
                            <div class="p-2">

                            </div>
                            <div class="comment-text w-100">
                                <h6 class="font-medium">{{$item->user->name}} | {{$item->no_perbaikan}}</h6>
                                <span class="m-b-15 d-block">{{$item->nama_perbaikan}}. </span>
                                <span class="m-b-15 d-block">Ditujukan kepada {{$item->divisi_tujuan->nama_divisi}}. </span>
                                <br/>
                                <div class="comment-footer">
                                    <span class="text-muted float-right">Tanggal Temuan : {{ \Carbon\Carbon::parse($item->tanggal_temuan_kerusakan)->format('j M Y') }}</span>
                                    <span class="label label-rounded label-primary">Draft</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Dalam Pengerjaan</h4>
                </div>
                <div class="comment-widgets scrollable" style="height:430px;">
                    <!-- Comment Row -->


                    @foreach ($data_sedang_diperbaiki as $item)
                        <div class="d-flex flex-row comment-row m-t-0">
                            <div class="p-2">

                            </div>
                            <div class="comment-text w-100">
                                <h6 class="font-medium">{{$item->user->name}} | {{$item->no_perbaikan}}</h6>
                                <span class="m-b-15 d-block">{{$item->nama_perbaikan}}. </span>
                                <span class="m-b-15 d-block">Ditujukan kepada {{$item->divisi_tujuan->nama_divisi}}. </span>
                                <br/>
                                <div class="comment-footer">
                                    <span class="text-muted float-right">Batas Pengerjaan : {{ \Carbon\Carbon::parse($item->tanggal_batas_pengerjaan)->format('j M Y') }}</span>
                                    <span class="label label-success label-rounded">Dalam Pengerjaan</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
        <!-- column -->
        {{-- <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center p-b-15">
                        <div>
                            <h4 class="card-title mb-0">Dalam Pengerjaan</h4>
                        </div>
                        <div class="ml-auto">
                            <div class="dl">
                                <select class="custom-select border-0 text-muted">
                                    <option value="0" selected="">August 2018</option>
                                    <option value="1">May 2018</option>
                                    <option value="2">March 2018</option>
                                    <option value="3">June 2018</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="todo-widget scrollable" style="height:422px;">
                        <ul class="list-task todo-list list-group m-b-0" data-role="tasklist">
                            <li class="list-group-item todo-item" data-role="task">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                    <label class="custom-control-label todo-label" for="customCheck">
                                        <span class="todo-desc">Simply dummy text of the printing and
                                            typesetting</span> <span
                                            class="badge badge-pill badge-success float-right">Project</span>
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item todo-item" data-role="task">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label todo-label" for="customCheck1">
                                        <span class="todo-desc">Lorem Ipsum is simply dummy text of the
                                            printing and typesetting industry. Lorem Ipsum has
                                            been.</span><span
                                            class="badge badge-pill badge-danger float-right">Project</span>
                                    </label>
                                </div>

                            </li>
                            <li class="list-group-item todo-item" data-role="task">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck2">
                                    <label class="custom-control-label todo-label" for="customCheck2">
                                        <span class="todo-desc">Ipsum is simply dummy text of the
                                            printing</span> <span
                                            class="badge badge-pill badge-info float-right">Project</span>
                                    </label>
                                </div>

                            </li>
                            <li class="list-group-item todo-item" data-role="task">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck3">
                                    <label class="custom-control-label todo-label" for="customCheck3">
                                        <span class="todo-desc">Simply dummy text of the printing and
                                            typesetting</span> <span
                                            class="badge badge-pill badge-info float-right">Project</span>
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item todo-item" data-role="task">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck4">
                                    <label class="custom-control-label todo-label" for="customCheck4">
                                        <span class="todo-desc">Lorem Ipsum is simply dummy text of the
                                            printing and typesetting industry. Lorem Ipsum has been.</span>
                                        <span
                                            class="badge badge-pill badge-purple float-right">Project</span>
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item todo-item" data-role="task">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck5">
                                    <label class="custom-control-label todo-label" for="customCheck5">
                                        <span class="todo-desc">Ipsum is simply dummy text of the
                                            printing</span> <span
                                            class="badge badge-pill badge-success float-right">Project</span>
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item todo-item" data-role="task">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck6">
                                    <label class="custom-control-label todo-label" for="customCheck6">
                                        <span class="todo-desc">Simply dummy text of the printing and
                                            typesetting</span> <span
                                            class="badge badge-pill badge-primary float-right">Project</span>
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

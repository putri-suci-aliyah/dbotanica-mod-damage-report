@extends('layouts.main')

@section('header')
    <div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Profil Saya</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Profil Saya</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

@if ($errors->any())
    <div class="pt-3">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30"> <img src="../../assets/images/users/5.jpg" class="rounded-circle" width="150" />
                    <h4>&nbsp;</h4>
                    <h4 class="card-title m-t-10">{{ $data->name}}</h4>
                    <h6 class="card-subtitle">{{ $data->divisi->kode_divisi}}</h6>

                </center>
            </div>
            <div>
                <hr> </div>
            <div class="card-body"> <small class="text-muted">Email</small>
                <h6>{{ $data->email}}</h6> <small class="text-muted p-t-30 db">Divisi</small>
                <h6>{{ $data->divisi->kode_divisi}} - {{ $data->divisi->nama_divisi}}</h6> <small class="text-muted p-t-30 db">Roles</small>
                <h6>
                    @if ($data->is_super_admin == 1)
                        Super Admin
                    @else
                        Non-Super Admin
                    @endif

                </h6>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Tabs -->
            <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-setting-tab" data-toggle="pill" href="#previous-month" role="tab" aria-controls="pills-setting" aria-selected="false">Setting</a>
                </li>
            </ul>
            <!-- Tabs -->
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade  show active" id="previous-month" role="tabpanel" aria-labelledby="pills-setting-tab">
                    <div class="card-body">
                        <form
                            class="form-horizontal form-material"
                            action='{{ url('profile/'.$data->id) }}'
                            method='post'
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="col-md-12">Nama</label>
                                <div class="col-md-12">
                                    <input type="text" value="{{ $data->name}}" name="name" class="form-control" id="name" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Divisi</label>
                                <div class="col-md-12">
                                    <input type="text" value="{{ $data->divisi->kode_divisi}} - {{ $data->divisi->nama_divisi}}" name="divisi_id" class="form-control" id="divisi_id" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" value="{{ $data->email}}" id="email" name="email" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Password</label>
                                <div class="col-md-12">
                                    <input type="password" value="{{$data->password}}" id="password" name="password" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <a href="{{ url('dashboard') }}" class="btn btn-dark mr-2">Batal</a>
                                    <button class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>


@endsection

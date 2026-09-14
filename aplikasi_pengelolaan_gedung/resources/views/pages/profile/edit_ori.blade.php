@extends('layouts.main')

@section('header')
    <div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">My Profile</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">My Profile</li>
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="m-t-30" action='{{ url('profile/'.$data->id) }}' method='post'>
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <label for="name">Nama User</label>
                            <input type="text" value="{{ $data->name}}" name="name" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label>Divisi</label>
                            <input type="text" value="{{ $data->divisi->kode_divisi}} - {{ $data->divisi->nama_divisi}}" name="divisi_id" class="form-control" id="divisi_id" readonly>

                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" value="{{ $data->email}}" id="email" name="email" class="form-control" placeholder="email_pengguna@example.com" readonly>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" value="{{$data->password}}" id="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <br/>
                        </div>
                        <div class="form-group">
                            <a href="{{ url('dashboard') }}" class="btn btn-dark mr-2">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

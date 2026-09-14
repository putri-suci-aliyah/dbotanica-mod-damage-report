@extends('layouts.main')

@section('header')
    <div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Divisi</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Divisi</li>
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
                    <form class="m-t-30" action='{{ url('divisi') }}' method='post'>
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kode Divisi</label>
                            <input type="text" class="form-control" name="kode_divisi" id="kode_divisi" required>
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <label for="nama_divisi">Nama Divisi</label>
                            <input type="text" name="nama_divisi" class="form-control" id="nama_divisi" required>
                        </div>
                        <div class="form-group">
                        </div>
                        {{-- <div class="form-group">
                            <label>Keterangan</label>
                            <textarea id="editor1" name="keterangan_divisi"></textarea>
                        </div> --}}
                        <div class="form-group">
                            <br/>
                        </div>
                        <div class="form-group">
                            <a href="{{ url('divisi') }}" class="btn btn-dark mr-2">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@extends('layouts.main')

@section('header')
    <div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Users</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                    <form class="m-t-30" action='{{ url('users') }}' method='post'>
                        @csrf
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <label for="name">Nama User</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="email_pengguna@example.com" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Divisi</label>
                            <select id="divisi_id" name="divisi_id" class="form-control select2" style="width: 100%;">
                                @foreach ($divisi as $data_divisi)
                                    <option value="{{ $data_divisi->id }}">
                                        {{ $data_divisi->kode_divisi }} - {{ $data_divisi->nama_divisi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Super Admin</label>
                            <select id="is_super_admin" name="is_super_admin" class="form-control select2" style="width: 100%;">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>

                        <div class="form-group" id="roles-section">
                            <label>Roles</label>
                            <div class="form-group row p-t-20">
                                <div class="col-sm-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="is_create" name="is_create">
                                        <label class="custom-control-label" for="is_create">Create</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="is_read" name="is_read">
                                        <label class="custom-control-label" for="is_read">Read</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="is_update" name="is_update">
                                        <label class="custom-control-label" for="is_update">Update</label>
                                    </div>
                                    {{-- <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="is_delete" name="is_delete">
                                        <label class="custom-control-label" for="is_delete">Delete</label>
                                    </div> --}}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea id="editor1" name="keterangan_user"></textarea>
                        </div>
                        <div class="form-group">
                            <br/>
                        </div>
                        <div class="form-group">
                            <a  href="{{ url('users') }}" class="btn btn-dark mr-2">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

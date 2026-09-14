@extends('layouts.main')

@section('header')
    <div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Temuan Kerusakan</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Temuan Kerusakan</li>
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
                    <form
                        id="perbaikan-form"
                        class="m-t-30"
                        action='{{ url('perbaikan') }}'
                        enctype="multipart/form-data"
                        method='post'>
                        @csrf
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <label for="name">Nomer</label>
                            <input
                                type="text"
                                name="no_perbaikan"
                                class="form-control"
                                id="no_perbaikan"
                                value="AUTO GENERATE"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="nama_perbaikan" class="form-control" id="nama_perbaikan" required>
                        </div>
                        <div class="form-group">
                            <label for="lantai">Lantai</label>
                            <input type="text" name="lantai" class="form-control" id="lantai" required>
                        </div>

                        <div class="form-group">
                            <label>User</label>
                            <select id="user_id" name="user_id" class="form-control select2" style="width: 100%;" @readonly(true)>
                                @foreach ($user as $data_user)
                                    @if ($data_user->id == auth()->user()->id)
                                        <option value="{{ $data_user->id }}" selected>
                                            {{ $data_user->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Divisi Asal</label>
                            <select id="divisi_asal_id" name="divisi_asal_id" class="form-control select2" style="width: 100%;" @readonly(true)>
                                @foreach ($divisi_asal as $data_divisi_asal)
                                    @if ($data_divisi_asal->id == auth()->user()->divisi_id)
                                        <option value="{{ $data_divisi_asal->id }}" selected>
                                            {{ $data_divisi_asal->nama_divisi }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Divisi Tujuan</label>
                            <select id="divisi_tujuan_id" name="divisi_tujuan_id" class="form-control select2" style="width: 100%;">
                                @foreach ($divisi_tujuan as $data_divisi_tujuan)
                                    <option value="{{ $data_divisi_tujuan->id }}">
                                        {{ $data_divisi_tujuan->nama_divisi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Temuan</label>
                            <input class="form-control" type="date" id="tanggal_temuan_kerusakan" name="tanggal_temuan_kerusakan" required>
                        </div>
                        {{-- <div class="form-group">
                            <label>Tanggal Batas Perbaikan</label>
                            <input class="form-control" type="date" id="tanggal_batas_pengerjaan" name="tanggal_batas_pengerjaan" required>
                        </div> --}}
                        {{-- <div class="form-group">
                            <label>Upload Gambar Temuan Kerusakan</label>
                            <div class="dropzone" id="image-dropzone"></div>
                        </div>
                        <div class="form-group">
                            <label>Keterangan Temuan Kerusakan</label>
                            <textarea id="editor1" name="keterangan_temuan"></textarea>
                        </div> --}}


                        <div class="form-group">
                            <div class="card">
                                <h4 class="card-title m-b-40">&nbsp;</h4>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home5" role="tab" aria-controls="home5" aria-expanded="true"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Temuan Kerusakan</span></a> </li>
                                </ul>
                                <div class="tab-content tabcontent-border p-20" id="myTabContent">

                                    <div role="tabpanel" class="tab-pane fade show active" id="home5" aria-labelledby="home-tab">
                                        <p>&nbsp;</p>
                                        <div id="image-dropzone" class="dropzone"></div>
                                        <p>&nbsp;</p>
                                        <textarea id="editor1" name="keterangan_temuan"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <a  href="{{ url('perbaikan') }}" class="btn btn-dark mr-2">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

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

                    <div class="form-group">
                    </div>
                    <div class="form-group">
                        <label for="name">No. Perbaikan</label>
                        <input type="text" value="{{ $data->no_perbaikan}}" name="no_perbaikan" class="form-control" id="no_perbaikan" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Perbaikan</label>
                        <input type="text" value="{{ $data->nama_perbaikan}}" name="nama_perbaikan" class="form-control" id="nama_perbaikan" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name">Lantai</label>
                        <input type="text" value="{{ $data->lantai}}" name="lantai" class="form-control" id="lantai" readonly>
                    </div>
                    <div class="form-group">
                        <label>User</label>

                        <select id="user_id" name="user_id" class="form-control select2" style="width: 100%;" @readonly(true)>
                            @foreach ($user as $data_user)
                                @if ($data_user->id == $data->user->id)
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
                                @if ($data_divisi_asal->id == $data->divisi_asal->id)
                                    <option value="{{ $data_divisi_asal->id }}" selected>
                                        {{ $data_divisi_asal->nama_divisi }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Divisi Tujuan</label>
                        <select id="divisi_asal_id" name="divisi_asal_id" class="form-control select2" style="width: 100%;" @readonly(true)>
                            @foreach ($divisi_tujuan as $data_divisi_tujuan)
                                @if ($data_divisi_tujuan->id == $data->divisi_tujuan->id)
                                    <option value="{{ $data_divisi_tujuan->id }}" selected>
                                        {{ $data_divisi_tujuan->nama_divisi }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Temuan</label>
                        <input value="{{$data->tanggal_temuan_kerusakan}}" class="form-control" type="date" readonly>
                    </div>
                    {{-- <div class="form-group">
                        <label>Tanggal Deadline</label>
                        <input value="{{$data->tanggal_batas_pengerjaan}}" class="form-control" type="date"  readonly>
                    </div> --}}

                    <div class="form-group">
                        <label>Status</label>
                        <input value="{{$data->status_perbaikan}}" class="form-control" type="text"  readonly>
                    </div>

                    <div class="form-group">
                        <div class="card">
                            <h4 class="card-title m-b-40">&nbsp;</h4>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home5" role="tab" aria-controls="home5" aria-expanded="true"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Detail Temuan Kerusakan</span></a> </li>
                            </ul>
                            <div class="tab-content tabcontent-border p-20" id="myTabContent">

                                <div role="tabpanel" class="tab-pane fade show active" id="home5" aria-labelledby="home-tab">
                                    <p>&nbsp;</p>
                                    <div id="myDropzonePerbaikan" class="dropzone"></div>
                                    <p>&nbsp;</p>
                                    <textarea readonly  id="editor1" name="keterangan_temuan">{{$data->keterangan_temuan}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (auth()->user()->divisi->id == $data->divisi_tujuan->id && auth()->user()->is_update == true)
                        <div class="modal fade" id="confirmModal-{{ $data->id }}" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin akan memulai pekerjaan ini ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                        <form class="d-inline" action="{{ url('perbaikan/mulai_pengerjaan/'.$data->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn-primary btn-sm">Mulai</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn waves-effect waves-light btn-info mb-2 text-light" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $data->id }}">
                            <i class="mdi mdi-wrench"></i>&nbsp;Mulai Perbaikan
                        </button>
                    @endif
            </div>
        </div>
    </div>
</div>


@endsection

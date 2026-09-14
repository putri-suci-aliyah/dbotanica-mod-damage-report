@extends('layouts.main')

@section('header')
    <div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Selesai Perbaikan</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Selesai Perbaikan</li>
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
                        id="perbaikan-pengerjaan-form"
                        class="m-t-30" 
                        enctype="multipart/form-data" 
                        method='post'>
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <label for="name">Nomer</label>
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
                                    {{-- <option value="{{ $data_user->id }}" {{ $data_user->id == $data->user->id ? 'selected' : '' }}>
                                        {{ $data_user->name }}
                                    </option> --}}
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
                            <label>Tanggal Temuian</label>
                            <input value="{{$data->tanggal_temuan_kerusakan}}" class="form-control" type="date" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Batas Pengerjaan</label>
                            <input value="{{$data->tanggal_batas_pengerjaan}}" class="form-control" type="date"  readonly>                           
                        </div>

                        <div class="form-group">
                            <label>Tanggal Selesai Pengerjaan</label>
                            <input value="{{$data->tanggal_selesai_pengerjaan}}" class="form-control" type="date"  readonly>                           
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <input value="{{$data->status_perbaikan}}" class="form-control" type="text"  readonly>                           
                        </div>

                        <div class="form-group">
                            <div class="card">
                                <h4 class="card-title m-b-40">&nbsp;</h4>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home5" role="tab" aria-controls="home5" aria-expanded="true"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Temuan Kerusakan</span></a> </li>
                                    <li class="nav-item"> <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile5" role="tab" aria-controls="profile"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Pengerjaan Perbaikan</span></a></li>                                    
                                </ul>
                                <div class="tab-content tabcontent-border p-20" id="myTabContent">

                                    <div role="tabpanel" class="tab-pane fade show active" id="home5" aria-labelledby="home-tab">
                                        <p>&nbsp;</p>
                                        <div id="myDropzonePerbaikan" class="dropzone"></div>
                                        <p>&nbsp;</p>
                                        <textarea readonly  id="editor1" name="keterangan">{{$data->keterangan_temuan}}</textarea>
                                    </div>
                                    <div class="tab-pane fade" id="profile5" role="tabpanel" aria-labelledby="profile-tab">
                                        <p>&nbsp;</p>
                                        <div id="myDropzoneSelesaiPerbaikan" class="dropzone"></div>
                                        <p>&nbsp;</p>
                                        <textarea readonly  id="editor2" name="keterangan_perbaikan">{{$data->keterangan_perbaikan}}</textarea>
                                    </div>
                                    
                                </div>
                            
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

   
@endsection
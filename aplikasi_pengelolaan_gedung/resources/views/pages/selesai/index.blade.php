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
@if (Session::has('success'))
    <div class="pt.3">
        <div class="alert bg-success text-white">
            {{ Session::get('success') }}
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="alt_pagination" 
                            class="table table-striped table-bordered display"
                            style="width:100%; font-size: 15px;">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Lantai</th>
                                    <th>Divisi Asal</th>
                                    <th>Divisi Tujuan</th>
                                    <th>Tanggal Temuan</th>
                                    <th>Tanggal Batas Pengerjaan</th>
                                    <th>Tanggal Selesai Pengerjaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item->no_perbaikan}}</td>
                                        <td>{{$item->nama_perbaikan}}</td>
                                        <td>{{$item->lantai}}</td>
                                        <td>{{$item->divisi_asal->nama_divisi}}</td>
                                        <td>{{$item->divisi_tujuan->nama_divisi}}</td>
                                        <td>{{$item->tanggal_temuan_kerusakan}}</td>
                                        <td>{{$item->tanggal_batas_pengerjaan}}</td>
                                        <td>{{$item->tanggal_selesai_pengerjaan}}</td>
                                        <td>
                                                                                        
                                            <a href='{{ url('selesai_perbaikan/'.$item->id.'/show')}}' class="btn waves-effect waves-light btn-warning mb-2">
                                                <i class="fas fa-bullseye"></i> Lihat
                                            </a>                                           

                                        </td>                                        
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
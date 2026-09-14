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
                    <a href='{{ url('divisi/create') }}' class="btn btn-primary mb-2">
                        <i class="fas fa-plus"></i>&nbsp; Tambah Data
                    </a>
                    <div class="table-responsive">
                        <table
                            id="alt_pagination"
                            class="table table-striped table-bordered display"
                            style="width:100%;font-size: 15px;">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    {{-- <th>Keterangan</th> --}}
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item->kode_divisi}}</td>
                                        <td>{{$item->nama_divisi}}</td>
                                        {{-- <td>{!! $item->keterangan_divisi !!}</td> --}}
                                        <td>
                                            <a href='{{ url('divisi/'.$item->id.'/edit')}}' class="btn waves-effect waves-light btn-success mb-2"><i class="fas fa-edit"></i> Ubah</a>

                                            <div class="modal fade" id="confirmModal-{{ $item->id }}" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah Anda ingin menghapus data ini?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                            <form class="d-inline" action="{{ url('divisi/soft_delete_divisi/'.$item->id) }}" method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" class="btn waves-effect waves-light btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $item->id }}">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>

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

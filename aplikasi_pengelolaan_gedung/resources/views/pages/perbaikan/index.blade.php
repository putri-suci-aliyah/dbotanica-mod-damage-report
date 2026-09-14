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
                    @if (auth()->user()->is_super_admin)
                        <a href='{{ url('perbaikan/create') }}' class="btn btn-primary mb-2">
                            <i class="fas fa-plus"></i>&nbsp; Tambah Data
                        </a>
                    @else

                        @if (auth()->user()->is_create)
                            <a href='{{ url('perbaikan/create') }}' class="btn btn-primary mb-2">
                                <i class="fas fa-plus"></i>&nbsp; Tambah Data
                            </a>
                        @endif

                    @endif
                    <div class="table-responsive">
                        <table id="alt_pagination"
                            class="table table-striped table-bordered display"
                            style="width:100%; font-size: 15px;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Lantai</th>
                                    <th>Divisi Asal</th>
                                    <th>Divisi Tujuan</th>
                                    <th>Tanggal Temuan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item->no_perbaikan}}</td>
                                        <td>{{$item->lantai}}</td>
                                        <td>{{$item->divisi_asal->nama_divisi}}</td>
                                        <td>{{$item->divisi_tujuan->nama_divisi}}</td>
                                        <td>{{$item->tanggal_temuan_kerusakan}}</td>
                                        <td>


                                            @if (auth()->user()->is_super_admin)


                                                <a href='{{ url('perbaikan/'.$item->id.'/edit')}}' class="btn waves-effect waves-light btn-success mb-2"><i class="fas fa-edit"></i> Ubah</a>

                                                <a href="{{ route('perbaikan.show', $item->id) }}" class="btn waves-effect waves-light btn-warning mb-2">
                                                    <i class="fas fa-bullseye"></i> Lihat
                                                </a>

                                                <div class="modal fade" id="confirmModal-{{ $item->id }}" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
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
                                                                <form class="d-inline" action="{{ url('perbaikan/mulai_pengerjaan/'.$item->id) }}" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn-primary btn-sm">Mulai</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn waves-effect btn-info mb-2 text-white" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $item->id }}">
                                                    <i class="mdi mdi-wrench"></i>&nbsp;Perbaikan
                                                </button>



                                                <div class="modal fade" id="deleteConfirmModal-{{ $item->id }}" tabindex="-1" aria-labelledby="deleteConfirmLabel-{{ $item->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteConfirmLabel-{{ $item->id }}">Konfirmasi Hapus</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin akan menghapus data ini?
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                                <form class="d-inline" action="{{ url('perbaikan/'.$item->id) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn waves-effect waves-light btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal-{{ $item->id }}">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>

                                            @else
                                                {{-- {{auth()->user()->divisi->id}}
                                                {{$item->divisi_asal->id}} --}}
                                                {{-- @if (auth()->user()->divisi->id == $item->divisi_asal->id)
                                                    <a href='{{ url('perbaikan/'.$item->id.'/edit')}}' class="btn waves-effect waves-light btn-success mb-2"><i class="fas fa-edit"></i> Ubah</a>

                                                @endif --}}

                                                <a href="{{ route('perbaikan.show', $item->id) }}" class="btn waves-effect waves-light btn-warning mb-2">
                                                    <i class="fas fa-bullseye"></i> Lihat
                                                </a>

                                                @if (auth()->user()->divisi->id == $item->divisi_asal->id && auth()->user()->is_update == true)
                                                    <a href='{{ url('perbaikan/'.$item->id.'/edit')}}' class="btn waves-effect waves-light btn-success mb-2"><i class="fas fa-edit"></i> Ubah</a>
                                                @endif

                                                @if (auth()->user()->divisi->id == $item->divisi_tujuan->id && auth()->user()->is_update == true)
                                                    {{-- <a href='{{ url('perbaikan/'.$item->id.'/edit')}}' class="btn waves-effect waves-light btn-success mb-2"><i class="fas fa-edit"></i> Ubah</a> --}}
                                                    <div class="modal fade" id="confirmModal-{{ $item->id }}" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
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
                                                                    <form class="d-inline" action="{{ url('perbaikan/mulai_pengerjaan/'.$item->id) }}" method="post">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" class="btn-primary btn-sm">Mulai</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="button" class="btn waves-effect waves-light btn-info mb-2" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $item->id }}">
                                                        <i class="mdi mdi-wrench"></i>&nbsp;Perbaikan
                                                    </button>
                                                @endif

                                            @endif

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

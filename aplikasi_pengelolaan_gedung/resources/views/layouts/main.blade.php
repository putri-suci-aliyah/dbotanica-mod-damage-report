<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/logo-botanica-text.png')}}">
    <title>Aplikasi Pengelolaan Gedung</title>
    <!-- Custom CSS -->
    {{-- <link rel="preload" href="{{asset('dist/css/icons/material-design-iconic-font/fonts/materialdesignicons-webfont.woff2?v=1.8.36')}}"  as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{asset('dist/css/icons/font-awesome/webfonts/fa-solid-900.woff2')}}"  as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{asset('dist/css/icons/simple-line-icons/fonts/Simple-Line-Icons.ttf?-i3a2kk')}}" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{asset('dist/css/icons/themify-icons/fonts/themify.woff')}}"  as="font" type="font/woff2" crossorigin="anonymous"> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}"  rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    <style>
        .modal-full-width {
            max-width: 100%;
            margin: 0;
        }
        .modal-content {
            height: 70%;
            border-radius: 0;
        }
    </style>

</head>

<body class="toggle-sidebar">
    @php
        use App\Models\Divisi;
        $divisi = Divisi::where('is_active',TRUE)->orderBy('nama_divisi')->get();
    @endphp
    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="GET" action="{{ route('export_excel') }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="searchModalLabel">Unduh Ke Excel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row align-items-center">
                            <label for="name" class="col-sm-3 col-form-label">Divisi Asal</label>
                            <div class="col-sm-9">
                                <select id="divisi_asal_id" name="divisi_asal_id" class="form-control select2" style="width: 100%;">
                                    <option value="0">--- Seluruh Divisi ---</option>
                                    @foreach ($divisi as $data_divisi)
                                        <option value="{{ $data_divisi->id }}">
                                            {{ $data_divisi->nama_divisi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="name" class="col-sm-3 col-form-label">Divisi Tujuan</label>
                            <div class="col-sm-9">
                                <select id="divisi_tujuan_id" name="divisi_tujuan_id" class="form-control select2" style="width: 100%;">
                                    <option value="0">--- Seluruh Divisi ---</option>
                                    @foreach ($divisi as $data_divisi)
                                        <option value="{{ $data_divisi->id }}">
                                            {{ $data_divisi->nama_divisi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="name" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                                <select id="status_perbaikan" name="status_perbaikan" class="form-control select2" style="width: 100%;">
                                    <option value="0">--- Semua Status ---</option>
                                    <option value="Draft">Draft</option>
                                    <option value="Dalam Pengerjaan">Dalam Pengerjaan</option>
                                    <option value="Selesai Pengerjaan">Selesai Pengerjaan</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="name" class="col-sm-3 col-form-label">Batas Tanggal</label>
                        </div>
                        <div class="form-group row align-items-center">
                            <label for="name" class="col-sm-3 col-form-label">Temuan Awal</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="date" id="tanggal" name="tanggal" required>
                            </div>
                        </div>

                        <div class="form-group row align-items-center">
                            <label for="name" class="col-sm-3 col-form-label">Temuan Akhir</label>
                            <div class="col-sm-9">
                                <input class="form-control" type="date" id="tanggal_akhir" name="tanggal_akhir" required>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Unduh</button>
                    </div>
                </div>
            </form>
        </div>
    </div>




    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <a class="logo">
                            <!-- Logo icon -->
                            <b class="logo-icon">
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon -->
                                {{-- <img src="{{asset('assets/images/logo-botanica-text.png')}}" alt="homepage" class="dark-logo" /> --}}
                                <!-- Light Logo icon -->
                                <img src="{{asset('assets/images/logo_dbotanica_medium.png')}}" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text">
                                {{-- <!-- dark Logo text -->
                                <img src="{{asset('assets/images/logo-text.png')}}" alt="homepage" class="dark-logo" />
                                <!-- Light Logo text -->
                                <img src="{{asset('assets/images/logo-light-text.png')}}" class="light-logo" alt="homepage" /> --}}
                            </span>
                        </a>
                        <a class="sidebartoggler d-none d-md-block" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                            <i class="mdi mdi-toggle-switch mdi-toggle-switch-off font-20"></i>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-more"></i>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->

                    <ul class="navbar-nav float-left mr-auto">
                        <!-- <li class="nav-item d-none d-md-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                                <i class="mdi mdi-menu font-24"></i>
                            </a>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        {{-- <li class="nav-item search-box">
                            <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
                                <div class="d-flex align-items-center">
                                    <i class="mdi mdi-magnify font-20 mr-1"></i>
                                    <div class="ml-1 d-none d-sm-block">
                                        <span>Search</span>
                                    </div>
                                </div>
                            </a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter">
                                <a class="srh-btn">
                                    <i class="ti-close"></i>
                                </a>
                            </form>
                        </li> --}}
                    </ul>



                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->


                        @php
                            use App\Models\PerbaikanGedung;

                            if(auth()->user()->is_super_admin){
                                $data = PerbaikanGedung::where('status_perbaikan','Draft')
                                    ->orderBy('id','asc')->get();
                                $total_count = $data->count();
                            }else{
                                $data = PerbaikanGedung::where('status_perbaikan','Draft')
                                    ->where('divisi_tujuan_id',auth()->user()->divisi->id)
                                    ->orderBy('id','asc')->get();
                                $total_count = $data->count();
                            }

                        @endphp

                        <li class="nav-item dropdown border-right">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-bell-outline font-22"></i>
                                <span class="badge badge-pill badge-info noti">{{$total_count}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                                <span class="with-arrow">
                                    <span class="bg-primary"></span>
                                </span>
                                <ul class="list-style-none">
                                    <li>
                                        <div class="drop-title bg-primary text-white">
                                            <h4 class="m-b-0 m-t-5">Data Terbaru</h4>
                                            <span class="font-light">Notifikasi</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center notifications">
                                            <!-- Message -->
                                            @foreach ($data->take(4) as $item)
                                                @php
                                                    $icons = [
                                                        ['class' => 'btn-danger', 'icon' => 'fa fa-link'],
                                                        ['class' => 'btn-success', 'icon' => 'ti-calendar'],
                                                        ['class' => 'btn-warning', 'icon' => 'fa fa-bell'],
                                                        ['class' => 'btn-info', 'icon' => 'fa fa-envelope']
                                                    ];

                                                    $style = $icons[$loop->index] ?? ['class' => 'btn-secondary', 'icon' => 'fa fa-info'];
                                                @endphp

                                                <a href='{{ url('perbaikan/'.$item->id.'/show')}}' class="message-item">
                                                    <span class="btn {{ $style['class'] }} btn-circle">
                                                        <i class="mdi mdi-wrench"></i>
                                                    </span>
                                                    <div class="mail-contnet">
                                                        <h5 class="message-title">{{ $item->no_perbaikan }}</h5>
                                                        <span class="mail-desc">{{ $item->lantai }}</span>
                                                        <span class="time">Temuan : {{ \Carbon\Carbon::parse($item->tanggal_temuan_kerusakanbatas_pengerjaan)->format('j M Y') }}</span>
                                                    </div>
                                                </a>
                                            @endforeach

                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link text-center m-b-5 text-dark" href="/perbaikan">
                                            <strong>Cek semua notifikasi</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>




                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('assets/images/users/2.jpg')}}" alt="user" class="rounded-circle" width="40">
                                <span class="m-l-5 font-medium d-none d-sm-inline-block">{{ auth()->user()->name }} <i class="mdi mdi-chevron-down"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <span class="with-arrow">
                                    <span class="bg-primary"></span>
                                </span>
                                <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                                    <div class="m-l-10">
                                        <h4 class="m-b-0">&nbsp;&nbsp;</h4>
                                        <p class=" m-b-0">&nbsp;&nbsp;</p>
                                    </div>
                                    <div class="m-l-10">
                                        <img src="{{asset('assets/images/users/2.jpg')}}" alt="user" class="rounded-circle"
                                            width="60">
                                    </div>
                                    <div class="m-l-10">
                                        <h4 class="m-b-0">&nbsp;</h4>
                                        <h4 class="m-b-0">&nbsp;{{ auth()->user()->name }}</h4>
                                        <p class=" m-b-0">&nbsp;{{ auth()->user()->email }}</p>
                                    </div>
                                </div>
                                <div class="profile-dis scrollable">
                                    <a class="dropdown-item" href="{{ url('profile/'.auth()->user()->id.'/edit')}}">
                                        <i class="ti-user m-r-5 m-l-5"></i> Profil Saya</a>

                                    <a
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form-right').submit();"
                                        class="dropdown-item"
                                        >
                                        <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout
                                        <form id="logout-form-right" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </a>
                                    <div class="dropdown-divider"></div>


                                </div>

                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->

        @include('layouts.sidebar')


        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
             @yield('header')
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->

                @yield('content')

                <!-- ============================================================== -->
                <!-- Recent comment and chats -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            {{-- <footer class="footer text-center">
                All Rights Reserved by Nice admin. Designed and Developed by
                <a href="https://wrappixel.com">WrapPixel</a>.
            </footer> --}}
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->
    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->

    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}" ></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}" ></script>
    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}" ></script>
    <!-- apps -->
    <script src="{{asset('dist/js/app.min.js')}}" ></script>
    <script src="{{asset('dist/js/app.init.js')}}" ></script>
    <script src="{{asset('dist/js/app-style-switcher.js')}}" ></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}" ></script>
    <script src="{{asset('assets/extra-libs/sparkline/sparkline.js')}}" ></script>
    <!--Wave Effects -->
    <script src="{{asset('dist/js/waves.js')}}" ></script>
    <!--Menu sidebar -->
    <script src="{{asset('dist/js/sidebarmenu.js')}}" ></script>
    <!--Custom JavaScript -->
    <script src="{{asset('dist/js/custom.min.js')}}" ></script>
    <!--This page plugins -->
    <script src="{{asset('assets/libs/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/libs/ckeditor/samples/js/sample.js')}}"></script>
    <script src="{{asset('assets/extra-libs/DataTables/datatables.min.js')}}" ></script>
    <script src="{{asset('dist/js/pages/datatable/datatable-basic.init.js')}}" ></script>
    <script src="{{asset('dist/js/pages/dashboards/dashboard3.js')}}"></script>


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const superAdminSelect = document.getElementById('is_super_admin');
        const rolesSection = document.getElementById('roles-section');

        function toggleRolesSection() {
            if (superAdminSelect.value === '1') {  // if Super Admin = Ya
                rolesSection.style.display = 'none';  // hide roles
            } else {
                rolesSection.style.display = '';  // show roles (default)
            }
        }

        // Initial check on page load
        toggleRolesSection();

        // Listen for changes on select
        superAdminSelect.addEventListener('change', toggleRolesSection);
    });
    </script>


    {{-- <script>
        $(document).ready(function() {
            function toggleDeleteCheckbox() {
                if ($('#is_super_admin').val() == '0') {
                    $('#is_create').closest('.custom-control').show();
                    $('#is_read').closest('.custom-control').show();
                    $('#is_update').closest('.custom-control').show();
                    $('#is_delete').closest('.custom-control').hide();
                } else {
                    $('#is_create').closest('.custom-control').hide();
                    $('#is_read').closest('.custom-control').hide();
                    $('#is_update').closest('.custom-control').hide();
                    $('#is_delete').closest('.custom-control').hide();
                }
            }

            // Initial check on page load
            toggleDeleteCheckbox();

            // Run check when select changes
            $('#is_super_admin').change(function() {
                toggleDeleteCheckbox();
            });
        });
    </script> --}}
    {{-- <script>

        document.addEventListener('DOMContentLoaded', function () {
    const superAdminSelect = document.getElementById('is_super_admin');

    if (!superAdminSelect) {
        console.warn("'is_super_admin' element not found.");
        return; // Stop if element is missing
    }
    const permissions = ['is_create', 'is_read', 'is_update', 'is_delete'];

    function togglePermissions() {
        const isSuperAdmin = superAdminSelect.value === '1';
        permissions.forEach(id => {
            const checkbox = document.getElementById(id);
            if (checkbox) {
                if (isSuperAdmin) {
                    // If super admin, check and disable all checkboxes
                    checkbox.checked = true;
                    checkbox.disabled = true;
                } else {
                    // If not super admin, enable checkboxes and set checked state from PHP data
                    checkbox.disabled = false;
                    checkbox.checked = permissionsState[id]; // use the passed data
                }
            }
        });
    }

    superAdminSelect.addEventListener('change', togglePermissions);

    // Run once on page load
    togglePermissions();
});


    </script> --}}

    <script>
        Dropzone.autoDiscover = false;

        let uploadedImages = [];

        let imageDropzone = new Dropzone("#image-dropzone", {
            url: "{{ route('perbaikan.upload') }}", // Laravel route to upload images
            paramName: "file",
            maxFilesize: 5, // MB
            maxFiles: 10,
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            autoProcessQueue: true, // Upload immediately
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                uploadedImages.push(response.fileName);

                // Append hidden inputs to the form with uploaded file names
                let input = document.createElement("input");
                input.type = "hidden";
                input.name = "uploaded_temuan_kerusakan_images[]";
                input.value = response.fileName;
                document.getElementById("perbaikan-form").appendChild(input);
            },
            removedfile: function(file) {
                let name = file.upload.filename;
                uploadedImages = uploadedImages.filter(f => f !== name);
                file.previewElement.remove();
            },
            error: function(file, errorMessage) {
                console.error("Upload error:", errorMessage);
            }
        });
    </script>



    <script>
        Dropzone.autoDiscover = false;

        let existingPengerjaanFiles = @json($imagePengerjaanUrls ?? []);



        let uploadedPengerjaanImages = [];

        let imagePengerjaanDropzone = new Dropzone("#image-pengerjaan-dropzone", {
            url: "{{ route('pengerjaan_perbaikan.upload') }}", // Laravel route to upload images
            paramName: "file",
            maxFilesize: 5, // MB
            maxFiles: 10,
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            autoProcessQueue: true, // Upload immediately
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },


            init: function () {
                let dz = this;

                existingPengerjaanFiles.forEach(function (url, index) {
                    let mockFile = {
                        name: url.substring(url.lastIndexOf('/') + 1),
                        size: 123456,
                        type: 'image/jpeg',
                        accepted: true
                    };

                    dz.emit("addedfile", mockFile);
                    dz.emit("thumbnail", mockFile, url);
                    dz.emit("complete", mockFile);
                    dz.files.push(mockFile);

                    // Add click event to preview to open full image
                    let previewElement = mockFile.previewElement;
                    if (previewElement) {
                        previewElement.style.cursor = "pointer";
                        previewElement.addEventListener('click', function () {
                            window.open(url, '_blank');
                        });
                    }
                });
            },



            success: function(file, response) {
                uploadedPengerjaanImages.push(response.fileName);

                // Append hidden inputs to the form with uploaded file names
                let input = document.createElement("input");
                input.type = "hidden";
                input.name = "uploaded_pengerjaan_images[]";
                input.value = response.fileName;
                document.getElementById("perbaikan-pengerjaan-form").appendChild(input);
            },
            removedfile: function(file) {
                let name = file.upload.filename;
                uploadedPengerjaanImages = uploadedPengerjaanImages.filter(f => f !== name);
                file.previewElement.remove();
            },
            error: function(file, errorMessage) {
                console.error("Upload error:", errorMessage);
            }
        });
    </script>

    {{-- <script>
        Dropzone.autoDiscover = false;

        let existingFiles = @json($imageUrls ?? []);

        let myDropzone = new Dropzone("#myDropzone", {
            url: "/dummy-url", // Required, but won't be used in "show"
            autoProcessQueue: false, // Since we're just previewing
            addRemoveLinks: true,
            dictDefaultMessage: 'Drag files here or click to upload.',
            init: function () {
                let dz = this;

                existingFiles.forEach(function (url, index) {
                    let mockFile = {
                        name: url.substring(url.lastIndexOf('/') + 1),
                        size: 123456, // Use approximate or real size if known
                        type: 'image/jpeg',
                        accepted: true
                    };

                    dz.emit("addedfile", mockFile);
                    dz.emit("thumbnail", mockFile, url);
                    dz.emit("complete", mockFile);
                    dz.files.push(mockFile);
                });
            }
        });
    </script> --}}

    {{-- <script>
        Dropzone.autoDiscover = false;

        let existingFiles = @json($imageUrls ?? []);

        let myDropzone = new Dropzone("#myDropzone", {
            url: "/dummy-url",
            autoProcessQueue: false,
            addRemoveLinks: true,
            dictDefaultMessage: 'Drag files here or click to upload.',
            init: function () {
                let dz = this;

                existingFiles.forEach(function (url, index) {
                    let mockFile = {
                        name: url.substring(url.lastIndexOf('/') + 1),
                        size: 123456,
                        type: 'image/jpeg',
                        accepted: true
                    };

                    dz.emit("addedfile", mockFile);
                    dz.emit("thumbnail", mockFile, url);
                    dz.emit("complete", mockFile);
                    dz.files.push(mockFile);

                    // Add click event to preview to open full image
                    let previewElement = mockFile.previewElement;
                    if (previewElement) {
                        previewElement.style.cursor = "pointer";
                        previewElement.addEventListener('click', function () {
                            window.open(url, '_blank');
                        });
                    }
                });
            }
        });


    </script> --}}


    <script>
        Dropzone.autoDiscover = false;

        let existingPerbaikanFiles = @json($imagePerbaikanUrls ?? []);

        let myDropzonePerbaikan = new Dropzone("#myDropzonePerbaikan", {
            url: "/dummy-url",
            autoProcessQueue: false,
            addRemoveLinks: false,
            dictDefaultMessage: 'Drag files here or click to upload.',
            init: function () {
                let dz = this;
                dz.disable();
                existingPerbaikanFiles.forEach(function (url, index) {
                    let mockFile = {
                        name: url.substring(url.lastIndexOf('/') + 1),
                        size: 123456,
                        type: 'image/jpeg',
                        accepted: true
                    };

                    dz.emit("addedfile", mockFile);
                    dz.emit("thumbnail", mockFile, url);
                    dz.emit("complete", mockFile);
                    dz.files.push(mockFile);

                    // Add click event to preview to open full image
                    let previewElement = mockFile.previewElement;
                    if (previewElement) {
                        previewElement.style.cursor = "pointer";
                        previewElement.addEventListener('click', function () {
                            window.open(url, '_blank');
                        });
                    }
                });
            }
        });


    </script>



    <script>
        Dropzone.autoDiscover = false;

        let existingPerbaikanPengerjaanFiles = @json($imagePengerjaanUrls ?? []);

        let myDropzonePerbaikanPengerjaan = new Dropzone("#myDropzonePerbaikanPengerjaan", {
            url: "/dummy-url",
            autoProcessQueue: false,
            addRemoveLinks: false,
            dictDefaultMessage: 'Drag files here or click to upload.',
            init: function () {
                let dz = this;
                dz.disable();
                existingPerbaikanPengerjaanFiles.forEach(function (url, index) {
                    let mockFile = {
                        name: url.substring(url.lastIndexOf('/') + 1),
                        size: 123456,
                        type: 'image/jpeg',
                        accepted: true
                    };

                    dz.emit("addedfile", mockFile);
                    dz.emit("thumbnail", mockFile, url);
                    dz.emit("complete", mockFile);
                    dz.files.push(mockFile);

                    // Add click event to preview to open full image
                    let previewElement = mockFile.previewElement;
                    if (previewElement) {
                        previewElement.style.cursor = "pointer";
                        previewElement.addEventListener('click', function () {
                            window.open(url, '_blank');
                        });
                    }
                });
            }
        });


    </script>






    <script>
        Dropzone.autoDiscover = false;

        let existingEditablePerbaikanFiles = @json($imagePerbaikanUrls ?? []);

        let myDropzoneEditablePerbaikan = new Dropzone("#myDropzoneEditablePerbaikan", {
            url: "/dummy-url",
            autoProcessQueue: false,
            addRemoveLinks: false,
            dictDefaultMessage: 'Drag files here or click to upload.',
            init: function () {
                let dz = this;

                existingEditablePerbaikanFiles.forEach(function (url, index) {
                    let mockFile = {
                        name: url.substring(url.lastIndexOf('/') + 1),
                        size: 123456,
                        type: 'image/jpeg',
                        accepted: true
                    };

                    dz.emit("addedfile", mockFile);
                    dz.emit("thumbnail", mockFile, url);
                    dz.emit("complete", mockFile);
                    dz.files.push(mockFile);

                    // Add click event to preview to open full image
                    let previewElement = mockFile.previewElement;
                    if (previewElement) {
                        previewElement.style.cursor = "pointer";
                        previewElement.addEventListener('click', function () {
                            window.open(url, '_blank');
                        });
                    }
                });
            }
        });


    </script>


    <script>
        Dropzone.autoDiscover = false;

        let existingSelesaiPerbaikanFiles = @json($imageSelesaiPerbaikanUrls ?? []);

        let myDropzoneSelesaiPerbaikan = new Dropzone("#myDropzoneSelesaiPerbaikan", {
            url: "/dummy-url",
            autoProcessQueue: false,
            addRemoveLinks: false,
            dictDefaultMessage: 'Drag files here or click to upload.',
            init: function () {
                let dz = this;
                dz.disable();
                existingSelesaiPerbaikanFiles.forEach(function (url, index) {
                    let mockFile = {
                        name: url.substring(url.lastIndexOf('/') + 1),
                        size: 123456,
                        type: 'image/jpeg',
                        accepted: true
                    };

                    dz.emit("addedfile", mockFile);
                    dz.emit("thumbnail", mockFile, url);
                    dz.emit("complete", mockFile);
                    dz.files.push(mockFile);

                    // Add click event to preview to open full image
                    let previewElement = mockFile.previewElement;
                    if (previewElement) {
                        previewElement.style.cursor = "pointer";
                        previewElement.addEventListener('click', function () {
                            window.open(url, '_blank');
                        });
                    }
                });
            }
        });


    </script>





    <script>

        CKEDITOR.replace('editor1', {
            extraAllowedContent: 'div',
            height: 460
        });

        CKEDITOR.replace('editor2', {
            extraPlugins: 'sourcedialog',
            removePlugins: 'sourcearea'
        });

    </script>




    <script>
        Dropzone.autoDiscover = false;

        let existingPerbaikanEditedFiles = @json($imagePerbaikanEditableUrls ?? []);
        let uploadedPerbaikanEditableImages = [];

        let imagePerbaikanEditableDropzone = new Dropzone("#image-perbaikan-editable-dropzone", {
            url: "{{ route('perbaikan.upload') }}", // Laravel route to upload images
            paramName: "file",
            maxFilesize: 5, // MB
            maxFiles: 10,
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            autoProcessQueue: true, // Upload immediately
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },


            init: function () {
                let dz = this;

                existingPerbaikanEditedFiles.forEach(function (url, index) {
                    let mockFile = {
                        name: url.substring(url.lastIndexOf('/') + 1),
                        size: 123456,
                        type: 'image/jpeg',
                        accepted: true
                    };

                    dz.emit("addedfile", mockFile);
                    dz.emit("thumbnail", mockFile, url);
                    dz.emit("complete", mockFile);
                    dz.files.push(mockFile);

                    // Add click event to preview to open full image
                    let previewElement = mockFile.previewElement;
                    if (previewElement) {
                        previewElement.style.cursor = "pointer";
                        previewElement.addEventListener('click', function () {
                            window.open(url, '_blank');
                        });
                    }
                });
            },



            success: function(file, response) {
                uploadedPerbaikanEditableImages.push(response.fileName);

                // Append hidden inputs to the form with uploaded file names
                let input = document.createElement("input");
                input.type = "hidden";
                input.name = "uploaded_perbaikan_editable_images[]";
                input.value = response.fileName;
                document.getElementById("perbaikan-editable-form").appendChild(input);
            },
            removedfile: function(file) {
                let name = file.upload.filename;
                uploadedPerbaikanEditableImages = uploadedPerbaikanEditableImages.filter(f => f !== name);
                file.previewElement.remove();
            },
            error: function(file, errorMessage) {
                console.error("Upload error:", errorMessage);
            }
        });
    </script>

    <script>
        Dropzone.options.avatarUpload = {
            paramName: "avatar", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            acceptedFiles: 'image/*',
            dictDefaultMessage: "Drag an avatar here or click to upload",
        };

    </script>

</body>

</html>

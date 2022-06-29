<div class="vertical-menu">

    <div data-simplebar class="h-100">

        @if (Auth::user()->role == "superadmin")
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title" data-key="t-menu">Management</li>

                    <li>
                        <a href="{{ route('admin.dashboard.index') }}">
                            <i data-feather="home"></i>
                            
                            <span data-key="t-dashboard">Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-title" data-key="t-menu">Master</li>
                    <li>
                        <a href="{{ route('admin.poli.index')}}" >
                            <i data-feather="folder"></i>
                            <span data-key="t-apps">Kelola Poli</span>
                        </a>

                    </li>

                    <li>
                        <a href="{{ route('admin.verifikasiktp.index') }}">
                            <i data-feather="file-text"></i>
                            <span class="badge rounded-pill bg-soft-danger text-danger float-end">7</span>
                            <span data-key="t-pages">Konfirmasi KTP</span>
                        </a>
                    </li>


                    <li class="menu-title mt-2" data-key="t-components">Konfigurasi</li>

                    <li>
                        <a href="javascript: void(0);">
                            <i data-feather="sliders"></i>
                            <span data-key="t-components">Website Setting</span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('admin.antrian.index') }}">
                            <i data-feather="sliders"></i>
                            <span data-key="t-components">Antrian Poli</span>
                        </a>
                    </li>

                </ul>
            </div>
        @endif

         <!--- User Role Admin1 -->
        @if (Auth::user()->role == "admin1")
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title" data-key="t-menu">Management</li>

                    <li>
                        <a href="{{ route('admin.dashboard.index') }}">
                            <i data-feather="home"></i>
                            
                            <span data-key="t-dashboard">Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-title" data-key="t-menu">Administrasi</li>
                    <li>
                        <a href="{{ route('admin.pendaftaran-pemeriksaan.index')}}" >
                            <i data-feather="folder"></i>
                            <span data-key="t-apps">Pendaftaran Pemeriksaan</span>
                        </a>
                    </li>
                    <li class="menu-title" data-key="t-menu">Master</li>
                    <li>
                        <a href="{{ route('admin.poli.index')}}" >
                            <i data-feather="folder"></i>
                            <span data-key="t-apps">Kelola Poli</span>
                        </a>

                    </li>

                    <li>
                        <a href="{{ route('admin.verifikasiktp.index') }}">
                            <i data-feather="file-text"></i>
                            <span class="badge rounded-pill bg-soft-danger text-danger float-end">7</span>
                            <span data-key="t-pages">Konfirmasi KTP</span>
                        </a>
                    </li>



                    <li class="menu-title mt-2" data-key="t-components">Konfigurasi</li>

                    <li>
                        <a href="javascript: void(0);">
                            <i data-feather="sliders"></i>
                            <span data-key="t-components">Website Setting</span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('admin.antrian.index') }}">
                            <i data-feather="sliders"></i>
                            <span data-key="t-components">Antrian Poli</span>
                        </a>
                    </li>

                </ul>
            </div>
        @endif

        @if (Auth::user()->role == "dokter")
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title" data-key="t-menu">Management</li>

                    <li>
                        <a href="{{ route('admin.dashboard.index') }}">
                            <i data-feather="home"></i>
                            
                            <span data-key="t-dashboard">Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-title" data-key="t-menu">Administrasi</li>
                    <li>
                        <a href="{{ route('admin.pemeriksaandokter.index')}}" >
                            <i data-feather="folder"></i>
                            <span data-key="t-apps">Pemeriksaan Dokter</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.suratrujukan.index')}}" >
                            <i data-feather="folder"></i>
                            <span data-key="t-apps">Surat Rujukan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pemeriksaanlab.index')}}" >
                            <i data-feather="folder"></i>
                            <span data-key="t-apps">Pemeriksaan Lab</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.riwayatpasien.index')}}" >
                            <i data-feather="folder"></i>
                            <span data-key="t-apps">Riwayat Berobat Pasien</span>
                        </a>
                    </li>
                    <li class="menu-title" data-key="t-menu">Master</li>
                    <li>
                        <a href="{{ route('admin.poli.index')}}" >
                            <i data-feather="folder"></i>
                            <span data-key="t-apps">Kelola Poli</span>
                        </a>

                    </li>

                    <li>
                        <a href="{{ route('admin.verifikasiktp.index') }}">
                            <i data-feather="file-text"></i>
                            <span class="badge rounded-pill bg-soft-danger text-danger float-end">7</span>
                            <span data-key="t-pages">Konfirmasi KTP</span>
                        </a>
                    </li>

                    <li class="menu-title mt-2" data-key="t-components">Konfigurasi</li>

                    <li>
                        <a href="javascript: void(0);">
                            <i data-feather="sliders"></i>
                            <span data-key="t-components">Website Setting</span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('admin.antrian.index') }}">
                            <i data-feather="sliders"></i>
                            <span data-key="t-components">Antrian Poli</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif

        <!-- Sidebar -->
    </div>
</div>

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

                    <li>
                        <a href="layouts-horizontal.html">
                            <i data-feather="layout"></i>
                            <span data-key="t-horizontal">Horizontal</span>
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

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="gift"></i>
                            <span data-key="t-ui-elements">Extended</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="extended-lightbox.html" data-key="t-lightbox">Lightbox</a></li>
                            <li><a href="extended-rangeslider.html" data-key="t-range-slider">Range Slider</a></li>
                            <li><a href="extended-sweet-alert.html" data-key="t-sweet-alert">SweetAlert 2</a></li>
                            <li><a href="extended-session-timeout.html" data-key="t-session-timeout">Session Timeout</a></li>
                            <li><a href="extended-rating.html" data-key="t-rating">Rating</a></li>
                            <li><a href="extended-notifications.html" data-key="t-notifications">Notifications</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);">
                            <i data-feather="box"></i>
                            <span class="badge rounded-pill bg-soft-danger text-danger float-end">7</span>
                            <span data-key="t-forms">Forms</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="form-elements.html" data-key="t-form-elements">Basic Elements</a></li>
                            <li><a href="form-validation.html" data-key="t-form-validation">Validation</a></li>
                            <li><a href="form-advanced.html" data-key="t-form-advanced">Advanced Plugins</a></li>
                            <li><a href="form-editors.html" data-key="t-form-editors">Editors</a></li>
                            <li><a href="form-uploads.html" data-key="t-form-upload">File Upload</a></li>
                            <li><a href="form-wizard.html" data-key="t-form-wizard">Wizard</a></li>
                            <li><a href="form-mask.html" data-key="t-form-mask">Mask</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="sliders"></i>
                            <span data-key="t-tables">Tables</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="tables-basic.html" data-key="t-basic-tables">Bootstrap Basic</a></li>
                            <li><a href="tables-datatable.html" data-key="t-data-tables">DataTables</a></li>
                            <li><a href="tables-responsive.html" data-key="t-responsive-table">Responsive</a></li>
                            <li><a href="tables-editable.html" data-key="t-editable-table">Editable</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="pie-chart"></i>
                            <span data-key="t-charts">Charts</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="charts-apex.html" data-key="t-apex-charts">Apexcharts</a></li>
                            <li><a href="charts-echart.html" data-key="t-e-charts">Echarts</a></li>
                            <li><a href="charts-chartjs.html" data-key="t-chartjs-charts">Chartjs</a></li>
                            <li><a href="charts-knob.html" data-key="t-knob-charts">Jquery Knob</a></li>
                            <li><a href="charts-sparkline.html" data-key="t-sparkline-charts">Sparkline</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="cpu"></i>
                            <span data-key="t-icons">Icons</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="icons-boxicons.html" data-key="t-boxicons">Boxicons</a></li>
                            <li><a href="icons-materialdesign.html" data-key="t-material-design">Material Design</a></li>
                            <li><a href="icons-dripicons.html" data-key="t-dripicons">Dripicons</a></li>
                            <li><a href="icons-fontawesome.html" data-key="t-font-awesome">Font Awesome 5</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="map"></i>
                            <span data-key="t-maps">Maps</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="maps-google.html" data-key="t-g-maps">Google</a></li>
                            <li><a href="maps-vector.html" data-key="t-v-maps">Vector</a></li>
                            <li><a href="maps-leaflet.html" data-key="t-l-maps">Leaflet</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="share-2"></i>
                            <span data-key="t-multi-level">Multi Level</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="javascript: void(0);" data-key="t-level-1-1">Level 1.1</a></li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow" data-key="t-level-1-2">Level 1.2</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="javascript: void(0);" data-key="t-level-2-1">Level 2.1</a></li>
                                    <li><a href="javascript: void(0);" data-key="t-level-2-2">Level 2.2</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        @endif

        <!-- Sidebar -->
    </div>
</div>

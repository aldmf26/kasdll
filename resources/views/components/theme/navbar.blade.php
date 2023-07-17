<header class="mb-5">
    <div class="header-top">
        <div class="container">
            <div class="logo">
                <a href="dashboard"><img src="/assets/login/img/empat.svg" alt="Logo"></a>
                <h5>KAS DLL</h5>
            </div>
            <div class="header-top-right">

                <div class="dropdown">
                    <a href="#" id="topbarUserDropdown"
                        class="user-dropdown d-flex align-items-center dropend dropdown-toggle "
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar avatar-md2">
                            @php
                                $idPosisi = auth()->user()->posisi->id_posisi;
                                $gambar = $idPosisi == 1 ? 'kitchen' : 'server';
                            @endphp
                            <img src='{{ asset("img/$gambar.png") }}' alt="Avatar">
                        </div>
                        <div class="text">
                            <h6 class="user-dropdown-name">{{ ucwords(auth()->user()->name) }}</h6>
                            <p class="user-dropdown-status text-sm text-muted">
                                {{ ucwords(auth()->user()->posisi->nm_posisi) }}
                            </p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                        </li>
                        <li>
                            <form id="myForm" method="post" action="{{ route('logout') }}">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="#"
                                onclick="document.getElementById('myForm').submit();">Logout</a>
                        </li>
                    </ul>
                </div>

                <!-- Burger button responsive -->
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </div>
        </div>
    </div>
    <nav class="main-navbar">
        <div class="container font-bold">
            <ul>
                <li class="menu-item">
                    <a href="dashboard"
                        class='menu-link {{ request()->route()->getName() == ' dashboard'
                            ? 'active'
                            : '' }}'>
                        <span>Dashboard</span>
                    </a>
                </li>
                @php
                    
                    $nav = [
                        [
                            'nama' => 'data master',
                            'route' => 'data_master',
                            'isi' => ['data_master', 'gudang', 'proyek'],
                        ],
                        [
                            'nama' => 'Buku Besar',
                            'route' => 'buku_besar',
                            'isi' => ['buku_besar', 'akun', 'jurnal', 'jurnal.add', 'summary_buku_besar.index', 'saldo_awal', 'summary_buku_besar.detail', 'profit', 'cashflow.index'],
                        ],
                        [
                            'nama' => 'Penjualan',
                            'route' => 'penjualan',
                            'isi' => ['penjualan', 'faktur_penjualan'],
                        ],
                        [
                            'nama' => 'Pembelian',
                            'route' => 'pembelian',
                            'isi' => ['pembelian', 'po.index'],
                        ],
                        [
                            'nama' => 'persediaan barang',
                            'route' => 'persediaan_barang',
                            'isi' => ['persediaan_barang', 'produk', 'opname.index', 'opname.add', 'stok_masuk.index', 'stok_masuk.add', 'bahan_baku.index', 'bahan_baku.stok_masuk', 'bahan_baku.stok_masuk_segment'],
                        ],
                    ];
                @endphp
                @foreach ($nav as $d)
                    <li class="menu-item">
                        <a href="{{ route($d['route']) }}"
                            class='menu-link 
                    {{ in_array(request()->route()->getName(),$d['isi'])? ' active': '' }}'>
                            <span>{{ ucwords($d['nama']) }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>

</header>

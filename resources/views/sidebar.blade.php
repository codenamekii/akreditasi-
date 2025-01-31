<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile border-bottom">
            <a href="#" class="nav-link flex-column">
                <div class="nav-profile-image">
                    <img src="/assets/images/teknik-logo.jpg" alt="profile" />
                </div>
                <div class="nav-profile-text d-flex ml-0 mb-3 flex-column">
                    <span class="font-weight-semibold mb-1 mt-2 text-center">{{ auth()->user()->name }}</span>
                    <span class="text-secondary icon-sm text-center">{{ auth()->user()->role }}</span>
                </div>
            </a>
        </li>
        <li class="nav-item pt-3">
            <a class="nav-link d-block" href="#">
                <h3 class="sidebar-brand-logo"><strong class="text-center">SIAKSI</strong></h3>
                <div class="small font-weight-light pt-1">
                  <a href="https://lamteknik.or.id/akreditasi/instrumen-akreditasi/">LAM TEKNIK</a> &
                  <a href="https://laminfokom.or.id/official/instrumen1.html">LAM INFOKOM</a>
                </div>
            </a>
        </li>
        <li class="pt-2 pb-1">
            <span class="nav-item-head">Menu</span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/dashboard">
                <i class="mdi mdi-view-dashboard menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/dataprodi">
                <i class="mdi mdi-archive menu-icon"></i>
                <span class="menu-title">Data Program Studi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/datakeuangan">
                <i class="mdi mdi-currency-usd menu-icon"></i>
                <span class="menu-title">Keuangan</span>
            </a>
        </li>

        @if(auth()->user()->role == 'admin prodi')
        <li class="pt-2 pb-1">
            <span class="nav-item-head">MASTER DATA</span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dosen.index') }}">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Data Dosen</span>
            </a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="mdi mdi-book menu-icon"></i>
                <span class="menu-title">Data Matakuliah</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="mdi mdi-briefcase menu-icon"></i>
                <span class="menu-title">Data Tenik</span>
            </a>
        </li> -->
        @endif

        <li class="pt-2 pb-1">
            <span class="nav-item-head">DATA KUANTITATIF LED</span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/kriteria1">
                <i class="mdi mdi-target menu-icon"></i>
                <span class="menu-title">K.1 Visi, Misi, Tujuan dan Sasaran</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/kriteria2">
                <i class="mdi mdi-gavel menu-icon"></i>
                <span class="menu-title">K.2 Tata Pamong, Tata Kelola, dan Kerjasama</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/kriteria3">
                <i class="mdi mdi-account-multiple-outline menu-icon"></i>
                <span class="menu-title">K.3 Mahasiswa</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/kriteria4">
                <i class="mdi mdi-account-tie menu-icon"></i>
                <span class="menu-title">K.4 Sumber Daya Manusia</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/kriteria5">
                <i class="mdi mdi-office-building menu-icon"></i>
                <span class="menu-title">K.5 Keuangan, Sarana, dan Prasarana</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/kriteria6">
                <i class="mdi mdi-book-open-page-variant menu-icon"></i>
                <span class="menu-title">K.6 Pendidikan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/kriteria7">
                <i class="mdi mdi-flask-outline menu-icon"></i>
                <span class="menu-title">K.7 Penelitian</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/kriteria8">
                <i class="mdi mdi-human-handsup menu-icon"></i>
                <span class="menu-title">K.8 Pengabdian kepada Masyarakat</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/kriteria9">
                <i class="mdi mdi-trophy-outline menu-icon"></i>
                <span class="menu-title">K.9 Luaran dan Capaian Tridharma</span>
            </a>
        </li>
        @if(auth()->user()->role != 'fakultas')
        <li class="pt-2 pb-1">
            <span class="nav-item-head">Repository</span>
        </li>
          @if(auth()->user()->role == 'admin prodi')
        <li class="nav-item">
            <a class="nav-link" href="/repository/form">
                <i class="mdi mdi-folder-plus menu-icon"></i>
                <span class="menu-title">Tambah repository</span>
            </a>
        </li>
        @endif
        
        <li class="nav-item">
            <a class="nav-link" href="/repository/semua">
                <i class="mdi mdi-database menu-icon"></i>
                <span class="menu-title">Manajemen repository</span>
            </a>
        </li>

        @if(auth()->user()->role == 'admin prodi')
        <li class="nav-item">
            <a class="nav-link" href="/dokumen">
                <i class="mdi mdi-file-document-outline menu-icon"></i>
                <span class="menu-title">Semua dokumen</span>
            </a>
        </li>
        @endif
        @endif
        <li class="pt-2 pb-1">
            <span class="nav-item-head">Menu akun</span>
        </li>
         @if(auth()->user()->role == 'root')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dataprodi.semua') }}">
                <i class="mdi mdi-domain menu-icon"></i>
                <span class="menu-title">Kelola prodi</span>
            </a>
        </li>
         @endif
         @if(auth()->user()->role != 'asesor')
        <li class="nav-item">
            <a class="nav-link" href="/akun/index">
                <i class="mdi mdi-account-group-outline menu-icon"></i>
                <span class="menu-title">Kelola Akun Pengguna</span>
            </a>
        </li>
        @endif

        <li class="nav-item">
            <a class="nav-link" href="{{ route('akun.profil') }}">
                <i class="mdi mdi-account-card-details-outline menu-icon"></i>
                <span class="menu-title">Info Akun</span>
            </a>
        </li>
    </ul>
</nav>

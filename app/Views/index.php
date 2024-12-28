<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center py-3">
    <h1>Sistem KRS</h1>
    <div class="dropdown">
        <a href="#" class="dropdown-toggle text-decoration-none d-flex align-items-center" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?= base_url('assets/img/profile.png') ?>" class="profile-picture" alt="Profile">
            <div class="ms-2">
                <strong>Nama Mahasiswa</strong><br>
                <span>NIM</span>
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item" href="/profile">Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item text-danger" href="/logout">Logout</a></li>
        </ul>
    </div>
</div>
<div class="my-4">
    <div id="contentCarousel" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Kotak 1</h5>
                        <p class="card-text">Informasi atau konten lainnya.</p>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Kotak 2</h5>
                        <p class="card-text">Informasi lainnya di sini.</p>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Kotak 3</h5>
                        <p class="card-text">Konten tambahan atau fitur.</p>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Kotak 2</h5>
                        <p class="card-text">Informasi atau konten lainnya.</p>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Kotak 2</h5>
                        <p class="card-text">Informasi lainnya di sini.</p>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Kotak 3</h5>
                        <p class="card-text">Konten tambahan atau fitur.</p>
                    </div>
                </div>
            </div>
        </div>

        

        <button class="carousel-control-prev" type="button" data-bs-target="#contentCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#contentCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<?= $this->endSection() ?>
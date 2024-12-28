<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Sistem KRS' ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css') ?>">
    <style>
        .sidebar {
            height: 100vh;
        }

        .profile-picture {
            border-radius: 50%;
            width: 50px;
            height: 50px;
        }

        /* Tambahkan CSS untuk sidebar responsif */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -250px;
                transition: left 0.3s ease-in-out;
            }

            .sidebar.show {
                left: 0;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>

    <!-- Tambahkan CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">

        <!-- Tombol Burger Menu -->
        <button class="btn btn-primary d-md-none my-3" id="sidebarToggle">
            &#9776; Menu
        </button>

        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block bg-light sidebar collapse" id="sidebarMenu">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= base_url('/') ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/krs') ?>">Input KRS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/bantuan') ?>">Bantuan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?= base_url('/logout') ?>">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        // Fungsi untuk toggle sidebar
        document.getElementById("sidebarToggle").addEventListener("click", function() {
            const sidebar = document.getElementById("sidebarMenu");
            const content = document.querySelector("main");
            sidebar.classList.toggle("show");
            content.classList.toggle("full");
        });
    </script>

</body>

</html>
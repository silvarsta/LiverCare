<?php
include('./koneksi.php');

session_start();
// Jika belum login, redirect ke halaman login
if (!isset($_SESSION['username'])) {
    header("Location: landing.php");
}

$id_user = $_SESSION['id'];
$user = mysqli_query($connect, "SELECT * FROM data_user WHERE id_user = $id_user ORDER BY id DESC LIMIT 1");
$data = mysqli_fetch_array($user);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Hasil Diagnosa</title>
    <link rel="shortcut icon" type="image/png" href="img/icon.png">
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid bg-white shadow-sm">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
                <a href="index.php" class="navbar-brand">
                    <h1 class="m-0 text-uppercase text-info"><i class="fa fa-clinic-medical me-3"></i>LiverCare</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <a href="index.php" class="nav-item nav-link">Home</a>
                        <a href="formdiagnosa.php" class="nav-item nav-link">Check up</a>
                        <a href="list.php" class="nav-item nav-link">Check up List</a>
                        <a href="index.php#article" class="nav-item nav-link">Article</a>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="index.php#about" class="dropdown-item">About</a>
                                <a href="index.php#service" class="dropdown-item">Service</a>
                                <a href="#blog" class="dropdown-item">Blog</a>
                                <br>
                                <a href="confussion.php" class="dropdown-item">Confussion Matriks</a>
                                <br>
                                <a href="#footer" class="dropdown-item">Contact</a>
                                <a href="logout.php" class="dropdown-item">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <form action="" method="post">
        <div class="container mt-5 mb-5 ">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <h5 class="card-title text-center">Hasil Diagnosa</h5>
                    <hr>
                    <div class="mb-5 table-responsive">
                        <table class="table table-striped-columns">
                            <thead>
                                <tr class="align-middle text-center">
                                    <th colspan="2">Biodata User</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="align-middle">
                                    <th scope="col">Nama</th>
                                    <td scope="col"><?= $data['nama'] ?></td>
                                </tr>
                                <tr class="align-middle">
                                    <th scope="col">Tanggal Cek</th>
                                    <td scope="col"><?= $data['tanggal'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="mb-5 mt-5 table-responsive">
                        <table class="table table-striped-columns">
                            <thead>
                                <tr class="align-middle text-center">
                                    <th scope="col">Kadar Alkphos Alkaline Phosphotase</th>
                                    <th scope="col">Kadar SGPT</th>
                                    <th scope="col">Kadar SGOT</th>
                                </tr>
                            </thead>
                            <!-- Ini pengennya di isi sesuai inputan user. tapi gamau keluar -->
                            <tbody>
                                <tr class="align-middle text-center">
                                    <td><?= $data['alkphos'] ?></td>
                                    <td><?= $data['sgpt'] ?></td>
                                    <td><?= $data['sgot'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="mb-5 mt-5 table-responsive">
                        <table class="table table-striped-columns">
                            <thead>
                                <tr class="align-middle text-center">
                                    <th scope="col">Metode</th>
                                    <th scope="col">Resiko</th>
                                    <th scope="col">Nilai kepastian </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="align-middle text-center">
                                    <td scope="row">K-Means</td>
                                    <td scope="row"><?php
                                                    if ($data['kmeans'] == 1) {
                                                        echo "Beresiko Terkena Penyakit Liver";
                                                    } else {
                                                        echo "Tidak Beresiko Terkena Penyakit Liver";
                                                    }
                                                    ?></td>
                                    <td scope="row">-</td>
                                </tr>
                                <tr class="align-middle text-center">
                                    <td scope="row">Bayes</td>
                                    <td scope="row"><?php
                                                    if ($data['bayes'] == 1) {
                                                        echo "Beresiko Terkena Penyakit Liver";
                                                    } else {
                                                        echo "Tidak Beresiko Terkena Penyakit Liver";
                                                    }
                                                    ?></td>
                                    <td scope="row"><?= $data['persentase'] ?> %</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="mb-3 mt-5 table-responsive">
                        <table class="table table-striped-columns">
                            <thead>
                                <tr class="align-middle text-center">
                                    <th colspan="3">Berdasarkan data yang telah dimasukkan, maka solusi dari sistem adalah:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="align-middle">
                                    <th scope="col">Solusi</th>
                                    <td scope="col" colspan="2">
                                        <?php
                                        if ($data['kmeans'] == 1 || $data['bayes'] == 1) {
                                            echo "
                                            <ol>
                                            <li>Menjalani pola hidup sehat, seperti menurunkan berat badan, berhenti minum alkohol, dan menghindari konsumsi obat-obatan tanpa saran dokter</li>
                                            <li>Memperbanyak minum air putih, istirahat yang cukup, serta mengonsumsi makanan yang sehat, terutama untuk mengatasi hepatitis A</li>
                                            <li>Mengonsumsi obat diuretik dan diet rendah garam, untuk menangani sirosis</li>
                                            </ol>
                                            ";
                                        } else {
                                            echo "
                                            <ol>
                                            <li>Jaga sanitasi yang baik dan kebersihan lingkungan sekitar</li>
                                            <li>Lakukan pemeriksaan rutin ke dokter untuk memantau kesehatan liver, karena beberapa obat yang dijual bebas (seperti paracetamol) bisa menyebabkan kerusakan liver jika dikonsumsi tidak sesuai aturan pakai</li>
                                            </ol>
                                            ";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr class="align-middle">
                                    <th scope="row">Saran Obat</th>
                                    <td>
                                        <?php
                                        if ($data['kmeans'] == 1 || $data['bayes'] == 1) {
                                            echo "
                                            <ol>
                                            <li>Kortikosteroid</li>
                                            <li>Antihipertensi</li>
                                            </ol>
                                            ";
                                        } else {
                                            echo "
                                            <ol>
                                            -
                                            </ol>
                                            ";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($data['kmeans'] == 1 || $data['bayes'] == 1) {
                                            echo "
                                            Obat disamping harus sesuai takaran dan resep dokter.
                                            ";
                                        } else {
                                            echo "";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <script>
        $(document).ready(function() {
            $("#form").submit(function(event) {
                event.preventDefault();

                var nama = $('#nama').val();
                var alkphos = $('#alkphos').val();
                var sgpt = $('#sgpt').val();
                var sgot = $('#sgot').val();

                $('#tabel').append("<tr><td>" + alkphos + "</td><td>" + sgpt + "</td><td>" + sgot + "</td></tr>");

                $("#nama").val("");
                $("#alkphos").val("");
                $("#sgpt").val("");
                $("#sgot").val("");

            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>
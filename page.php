<?php
ob_start();
include 'layouts/header.php';
?>
<div class="container">
    <main>
        <div class="container-fluid">
            <?php
            if (isset($_GET['q'])) {
                $q = $_GET['q'];
                switch ($q) {
                    //Home
                    case 'home':
                        include "../penilaian/home.php";
                        break;
                    //Karyawan Routes
                    case 'karyawanView':
                        include "../penilaian/Views/karyawanView.php";
                        break;
                    case 'karyawanEdit':
                        include "../penilaian/Forms/karyawanEdit.php";
                        break;
                    case 'karyawanAct':
                        include "../penilaian/Proses/karyawanProses.php";
                        break;
                    case 'karyawanInput':
                        include "../penilaian/Forms/karyawanInput.php";
                        break;
                    //Kriteria Routes
                    case 'kriteriaView':
                        include "../penilaian/Views/kriteriaView.php";
                        break;
                    case 'kriteriaEdit':
                        include "../penilaian/Forms/kriteriaEdit.php";
                        break;
                    case 'kriteriaAct':
                        include "../penilaian/Proses/kriteriaProses.php";
                        break;
                    case 'kriteriaInput':
                        include "../penilaian/Forms/kriteriaInput.php";
                        break;
                    //Penilaian Routes
                    case 'penilaianView':
                        include "../penilaian/Views/penilaianView.php";
                        break;
                    case 'dataView':
                        include "../penilaian/Views/dataPenilaianView.php";
                        break;
                    case 'penilaianEdit':
                        include "../penilaian/Forms/penilaianEdit.php";
                        break;
                    case 'penilaianAct':
                        include "../penilaian/Proses/penilaianProses.php";
                        break;
                    case 'penilaianInput':
                        include "../penilaian/Forms/penilaianInput.php";
                        break;
                    //Ranking Routes
                    case 'rankView':
                        include "../penilaian/Views/rankingView.php";
                        break;
                    case 'rankReport':
                        include "../penilaian/report/penilaianReport.php";
                        break;
                    //Login
                    case 'loginAct':
                        include "../penilaian/Proses/loginProses.php";
                        break;
                    case 'logout':
                        include "../penilaian/logout.php";
                        break;
                        // default:
                        //     // Redirect to home.php if the requested page is not found
                        //     header("Location: ../penilaian/home.php");
                        //     exit(); // Stop further execution
                        //     break;
                }
            } else {
                echo "<a href='../penilaian/index.php'>Kembali ke Beranda</a>";
            }
            ?>
            <?php
            include 'layouts/footer.php';
            ob_end_flush();
            ?>
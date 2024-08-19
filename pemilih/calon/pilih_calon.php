<?php
session_start();

// Koneksi ke database
$servername = "localhost";
$username = "root"; // ganti dengan username Anda
$password = "";     // ganti dengan password Anda
$dbname = "e_voting"; // ganti dengan nama database Anda

$koneksi = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($koneksi->connect_error) {
  die("Koneksi gagal: " . $koneksi->connect_error);
}

$data_id = $_SESSION["ses_id"];

if (isset($_GET['kode'])) {
    // Simpan data vote
    $sql_simpan = "INSERT INTO tb_vote (id_calon, id_pemilih, date) VALUES (?, ?, NOW())";
    $stmt = $koneksi->prepare($sql_simpan);
    $stmt->bind_param("ii", $_GET['kode'], $data_id);
    $stmt->execute();

    // Update status pemilih
    $sql_update = "UPDATE tb_pengguna SET status='0' WHERE id_pengguna=?";
    $stmt = $koneksi->prepare($sql_update);
    $stmt->bind_param("i", $data_id);
    $stmt->execute();

    if ($stmt) {
        echo "<script>
        Swal.fire({title: 'Anda Berhasil Memilih',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {if (result.value){
            window.location = 'index.php';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({title: 'Anda Gagal Memilih',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {if (result.value){
            window.location = 'index.php';
            }
        })</script>";
    }

    // Tutup statement
    $stmt->close();
}

// Tutup koneksi
$koneksi->close();
?>


<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_login");

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Cek apakah email sudah terdaftar
    $cek = "SELECT * FROM users WHERE email = '$email'";
    $hasil = mysqli_query($koneksi, $cek);

    if (mysqli_num_rows($hasil) > 0) {
        echo "Email sudah terdaftar. Silakan gunakan email lain.";
    } else {
        // Simpan user baru ke database
        $query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
        if (mysqli_query($koneksi, $query)) {
            echo "Pendaftaran berhasil. <a href='index.html'>Login sekarang</a>";
        } else {
            echo "Gagal mendaftar: " . mysqli_error($koneksi);
        }
    }
}
?>

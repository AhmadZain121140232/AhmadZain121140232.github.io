<?php
session_start();

include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $nim = isset($_POST['nim']) ? $_POST['nim'] : '';
    $kelamin = isset($_POST['kelamin']) ? $_POST['kelamin'] : '';
    $no_telepon = isset($_POST['no_telepon']) ? $_POST['no_telepon'] : '';

    $_SESSION['data'] = [
        'nama' => $nama,
        'nim' => $nim,
        'no_telepon' => $no_telepon,
        'kelamin' => $kelamin,
    ];

    $response = ['success' => true, 'message' => 'Data berhasil diterima di PHP.'];
    echo json_encode($response);

    $db = new Data("localhost", "root", "", "pemweb");

    $saveResult = $db->post($nama, $nim, $kelamin, $no_telepon);

    $db->closeConnection();
} else {
    $response = ['success' => false, 'message' => 'Unvalid method'];
    echo json_encode($response);
}
?>
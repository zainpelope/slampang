<?php
header("Content-Type: application/json");
include '../../koneksi.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Ambil data kontak
        $sql = "SELECT * FROM kontak";
        $result = $conn->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode(["status" => "success", "data" => $data]);
        break;

    case 'POST':
        // Tambah data kontak
        $input = json_decode(file_get_contents("php://input"), true);
        if (isset($input['name'], $input['email'], $input['subjeck'], $input['message'])) {
            $name = $conn->real_escape_string($input['name']);
            $email = $conn->real_escape_string($input['email']);
            $subjeck = $conn->real_escape_string($input['subjeck']);
            $message = $conn->real_escape_string($input['message']);
            $id_admin = 1;

            $sql = "INSERT INTO kontak (name, email, subjeck, message, id_admin) 
                    VALUES ('$name', '$email', '$subjeck', '$message', '$id_admin')";
            if ($conn->query($sql)) {
                echo json_encode(["status" => "success", "message" => "Data berhasil ditambahkan"]);
            } else {
                echo json_encode(["status" => "error", "message" => $conn->error]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
        }
        break;

    case 'DELETE':
        // Hapus data kontak berdasarkan ID
        parse_str(file_get_contents("php://input"), $input);
        if (isset($input['id'])) {
            $id = intval($input['id']);
            $sql = "DELETE FROM kontak WHERE id = $id";
            if ($conn->query($sql)) {
                echo json_encode(["status" => "success", "message" => "Data berhasil dihapus"]);
            } else {
                echo json_encode(["status" => "error", "message" => $conn->error]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "ID tidak diberikan"]);
        }
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Metode tidak diizinkan"]);
        break;
}

$conn->close();

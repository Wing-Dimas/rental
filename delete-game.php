<?php
require "config.php";
session_start();

if(isset($_SESSION) && isset($_SESSION["login"]) && !$_SESSION["login"]){
    header("Location: login.php");
    exit();
}

$id = $_GET["id"];

$sql = "DELETE FROM permainan WHERE id_permainan=$id";
$stmt = $conn->prepare($sql);

if($stmt->execute()){
    $_SESSION["flash"] = [
        "status" => "success",
        "message" => "Game Berhasil di hapus"
    ];
}else{
    $_SESSION["flash"] = [
        "status" => "danger",
        "message" => "Terjadi kesalahan saat menghapus game"
    ];
}

header("Location: halaman-daftar-game.php");
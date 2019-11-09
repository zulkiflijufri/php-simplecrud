<?php

session_start();

$conn = new mysqli("localhost", "root", "", "simplecrud") or die(mysqli_error($conn));

$id = 0;
$update = false;
$clubName = "";
$clubLocation = "";

if(isset($_POST["save"])) {
    $name = $_POST["clubName"];
    $location = $_POST["clubLocation"];

    $conn->query("INSERT into club (name, location) VALUES('$name', '$location')") or die($conn->error());

    $_SESSION["message"] = "Data berhasil ditambahkan!";
    $_SESSION["msg_type"] = "success";

    header("location: index.php");
}

if(isset($_GET["edit"])) {
    $update = true;
    $id = $_GET["edit"];
    
    $result = $conn->query("SELECT * FROM club WHERE id=$id") or die($conn->error());

    if(count($result) > 0) {
        $row = $result->fetch_array();
        $clubName = $row["name"];
        $clubLocation = $row["location"];
    }
}

if(isset($_POST["update"])) {
    $id = $_POST["id"];
    $name = $_POST["clubName"];
    $location = $_POST["clubLocation"];

    $conn->query("UPDATE club SET name='$name', location='$location' WHERE id=$id") or die($conn->error());

    $_SESSION["message"] = "Data berhasil diupdate!";
    $_SESSION["msg_type"] = "warning";

    header("location:index.php");
}

if(isset($_GET["delete"])) {
    $id = $_GET["delete"];

    $conn->query("DELETE FROM club where id=$id") or die($conn->error());

    $_SESSION["message"] = "Data berhasil dihapus!";
    $_SESSION["msg_type"] = "danger";

    header("location:index.php");
}
<?php
session_start();
require_once('../model/config/database.php');
$upload_dir = "../uploads/gallery";
$img = $_POST['img'];
$data = base64_decode($img);
$name = mktime() . ".png";
$file = $upload_dir . $name;
$success = file_put_contents($file, $data);
print ($success ? $file : 'Unable to save the file.');

try {
	$sql = "INSERT INTO $db.images (`path`, `userid`) VALUES (?, ?)";
	$stmt = $conn->prepare($sql);
	$stmt->execute(array("camagru/uploads/gallery/".$name, $_SESSION['userid']));

}
catch(PDOException $e)
    {
        $e->getMessage();
    } 
?>
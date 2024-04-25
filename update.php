<?php

// echo 'Hello World!'."</br>";
header('Content-Type: application/json');
$json = json_decode(file_get_contents('php://input'), true);
$student_id = $json['id'];
$student_fname = $json['fname'];
$student_email = $json['email'];
$student_password = $json['password'];
$student_number = $json['number'];
$student_gender = $json['gender'];
// die;


$conn = mysqli_connect("localhost", "root", "", "procedural") or die("Connection failed to connect");
$mysql = "UPDATE test_info SET fname = '{$student_fname}', email = '{$student_email}', password = '{$student_password}', contact_no = '{$student_number}', gender = '{$student_gender}' WHERE id = '{$student_id}'";
// $result = mysqli_query($conn, $mysql) or die(mysqli_error($conn));
// echo "Successfully uploaded";
if (mysqli_query($conn, $mysql)) {
    echo json_encode(array('message' => 'Record Updated',  'status' => true));
} else {
    echo json_encode(array('message' => 'Record Not Updated',  'status' => false));
}
// header("Location: index.php");

// $uid = $_POST['id'];
// $ufname = $_POST['fname'];
// $uemail = $_POST['email'];
// $upassword = $_POST['password'];
// $ucontact = $_POST['number'];
// $ugender = $_POST['gender'];
// $locations = $_POST['cities'];
// $ulocation = implode(',', $locations);

// $ufile_name = '';
// if (isset($_FILES['image'])) {
//     if (is_uploaded_file($_FILES["image"]["tmp_name"]) && $_FILES["image"]["error"] === 0) {
//         $ufile_name = $_FILES['image']['name'];
//         $file_tmp = $_FILES['image']['tmp_name'];
//         $image = move_uploaded_file($file_tmp, "uploadImages/" . $file_name);
//     }
// } else {
//     echo "<script>alert('Upload image in jpg,jpeg and png format only!');</script>";
// }
?>
<?php
header('Content-Type: application/json');
$json = json_decode(file_get_contents('php://input'), true);
$student_id = $json['id'];


// $uid = $_GET['id'];
$conn = mysqli_connect("localhost", "root", "", "procedural") or die("Connection failed to connect");
$del = "DELETE FROM test_info WHERE id = '{$student_id}'";
if (mysqli_query($conn, $del)) {
    echo json_encode(array('message' => 'Record Deleted',  'status' => true));
} else {
    echo json_encode(array('message' => 'Record Not Deleted',  'status' => false));
}
// $result = mysqli_query($conn, $del) or die("Error deleting record:". mysqli_error($conn));
// header("Location: index.php");
?>
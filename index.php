<?php
//  require_once "connection.php";
header('Content-Type: application/json');
// header('Acess-Control-Allow-Origin: *');

$json = json_decode(file_get_contents('php://input'), true);
$student_id = $json['id'];

$conn = mysqli_connect("localhost", "root", "", "procedural") or die('Could not connect to database');
$sql = "SELECT * FROM test_info WHERE id = {$student_id}";
$result = mysqli_query($conn, $sql) or die('Could not execute query');
if (mysqli_num_rows($result) > 0) {
    $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($output);
} else {
    echo json_encode(array('message' => 'No Record Found',  'status' => false));
}
die;
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <style>
        body {
            background-color: blanchedalmond;
            color: black;
        }

        form {
            width: 40%;
            background-color: violet;
            margin: 2rem auto;
            padding: 1rem;
            border-radius: 7px;
            color: white;
        }

        .input {
            /* display: block; */
            width: 100%;
            height: 1.4rem;
            color: black;
        }

        input[type="submit"] {
            background-color: #0000ff7d;
            cursor: pointer;
            color: white;
            width: 16%;
            height: 2rem;
            border-radius: 7px;
            border: none;
            margin: 1rem auto;
            font-size: 1rem;
            font-weight: 600;
        }

        table {
            width: 85%;
            margin: 0 auto;
            background-color: violet;
            color: white;
        }

        table th {
            color: blue
        }

        p {
            text-align: center;
            color: red;
            font-size: 1.5rem;
        }

        #edit {
            background-color: yellowgreen;
            color: white;
            border-radius: 5px;
            border: none;
            padding: 2px 4px;
            cursor: pointer;
            text-decoration: none;
            margin: auto 6px;
        }

        #delete {
            background-color: red;
            color: white;
            border-radius: 5px;
            border: none;
            padding: 2px 4px;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <form action="index.php" method="post" enctype="multipart/form-data">
        Name: <input class="input" type="text" name="fname" value="" required>
        Email: <input class="input" type="email" name="email" value="" required>
        Password: <input class="input" type="password" name="password" value="" required>
        Mobile No.: <input class="input" type="mobile" name="number" value="" required>
        Gender: </br><select name="gender">
            <option value="Male" name="gender">Male</option>
            <option value="Female" name="gender">Female</option>
            <option value="Other" name="gender">Other</option>
        </select></br>
        Image: <input class="input" type="file" name="image" value=""></br>
        Job Preferences: </br>
        <input type="checkbox" name="cities[]" value="Delhi">Delhi
        <input type="checkbox" name="cities[]" value="Banglore">Banglore
        <input type="checkbox" name="cities[]" value="Noida">Noida </br>

        <input type="submit" name="submit">
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Contact No.</th>
            <th>Gender</th>
            <th>Job Preferences</th>
            <th style="width: 8%">Image</th>
            <th style="width: 10%">Action</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['fname']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['password']}</td>";
                echo "<td>{$row['contact_no']}</td>";
                echo "<td>{$row['gender']}</td>";

                echo "<td>{$row['job_pref']}</td>";
                echo "<td><img src='uploadImages/{$row['image']}' alt='' width='70' height='30'> </td>";
                echo "<td>
                      <a id='edit' href='edit.php?id={$row['id']}'>Edit</a>
                      <a id='delete' href='delete.php?id={$row['id']}'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<p>0 record found</p>";
        }
        ?>
        <?php
      

        // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //     $fname = $_POST['fname'];
        //     $email = $_POST['email'];
        //     $password = $_POST['password'];
        //     $contact = $_POST['number'];
        //     $gender = $_POST['gender'];
        //     $locations = $_POST['cities'];
        //     $location = implode(', ', $locations);

        //     if (isset($_FILES['image'])) {
        //         if (is_uploaded_file($_FILES["image"]["tmp_name"]) && $_FILES["image"]["error"] === 0) {
        //             $file_name = $_FILES['image']['name'];
        //             $file_tmp = $_FILES['image']['tmp_name'];
        //             $image = move_uploaded_file($file_tmp, "uploadImages/" . $file_name);
        //         }
        //     } else {
        //         echo "<script>alert('Upload image in jpg,jpeg and png format only!');</script>";
        //     }


        //     if (empty($fname) || empty($email) || empty($password) || empty($contact) || empty($gender) || empty($image)) {
        //         echo "<p>Please fill all the fields</p>";
        //     } else {
        //         $mysql = "INSERT INTO test_info(fname, email, password, contact_no, gender, image, job_pref) VAlUES('{$fname}', '{$email}', '{$password}', '{$contact}', '{$gender}', '{$file_name}', '{$location}')";
        //         if ($conn->query($mysql) == true) {
        //             // header("Location: index.php");
        //             header("refresh:1;url=index.php");
        //         } else {
        //             return "Error: " . $sql . "<br>" . $conn->error;
        //         }
        //     }
        // }
        ?>
    </table>
</body>

</html>
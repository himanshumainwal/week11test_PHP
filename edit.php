<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <style>
        body {
            background-color: yellowgreen;
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
            display: block;
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
            /* color: white; */
        }

        table th {
            color: blue
        }
    </style>
</head>

<body>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "procedural") or die("Connection failed to connect");
    $sql = "SELECT * FROM test_info WHERE id = {$_GET['id']};";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            // print_r($row);
            // var_dump($row); die();

            $city = $row['job_pref'];
            $cities = explode(", ", $city);
            $test = [];
            foreach ($cities as $key => $citie) {
                $test[$citie] = $citie;
            }
            // echo "<pre>";
            // print_r($cities);
            //  die();
    ?>
            <form action="update.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                Name: <input type="text" class="input" name="fname" value="<?php echo $row['fname']; ?>">
                Email: <input type="email" class="input" name="email" value="<?php echo $row['email']; ?>">
                Password: <input type="text" class="input" name="password" value="<?php echo $row['password']; ?>">
                Mobile No.: <input type="mobile" class="input" name="number" value="<?php echo $row['contact_no']; ?>">

                Gender : </br>
                <select name="gender" value="<?php echo $row['gender']; ?>">
                    <option value="Male" <?php if ($row['gender'] == 'Male') echo 'selected="selected"'; ?> name="gender">Male</option>
                    <option value="Female" <?php if ($row['gender'] == 'Female') echo 'selected="selected"'; ?> name="gender">Female</option>
                    <option value="Other" <?php if ($row['gender'] == 'Other') echo 'selected="selected"'; ?> name="gender">Other</option>
                </select></br>
                Image:<img src="uploadImages/<?php echo $row['image'] ?>" alt='' width='400' height='300' style="border-radius: 50%;">
                <input type="file" name="image" value="uploadImages/<?php echo $row['image']; ?>"></br>
                Job Preferences: </br>


                <input type="checkbox" <?= (!empty($test['Delhi']) && $test['Delhi'] == 'Delhi') ? 'checked' : ''; ?> name="cities[]" value="Delhi">Delhi
                <input type="checkbox" <?= (!empty($test['Noida']) && $test['Noida'] == 'Noida') ? 'checked' : ''; ?> name="cities[]" value="Noida">Noida
                <input type="checkbox" <?= (!empty($test['Banglore']) && $test['Banglore'] == 'Banglore') ? 'checked' : ''; ?> name="cities[]" value="Banglore">Banglore</br>


                <input type="submit" name="submit" value="Save">

            </form>
    <?php
        }
    }
    ?>


</body>

</html>
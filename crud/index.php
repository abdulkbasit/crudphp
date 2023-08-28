<!DOCTYPE html>
<html>
<head>
    <title>CRUD Application</title>
</head>
<body>
    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crud";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Create operation
    if (isset($_POST['create'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $age = $_POST['age'];

        $sql = "INSERT INTO crd (name, email, age) VALUES ('$name', '$email', $age)";

        if (mysqli_query($conn, $sql)) {
            echo "Record inserted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Read operation
    $sql = "SELECT * FROM crd";
    $result = mysqli_query($conn, $sql);
    ?>
    
    <!-- Display records in a table -->
    <h2>User List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["age"] . "</td>";
                echo "<td><a href='edit.php?id=" . $row["id"] . "'>Edit</a></td>";
                echo "<td><a href='delete.php?id=" . $row["id"] . "'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }
        ?>
    </table>

    <!-- Create form -->
    <h2>Create User</h2>
    <form method="post" action="">
        Name: <input type="text" name="name"><br>
        Email: <input type="email" name="email"><br>
        Age: <input type="number" name="age"><br>
        <input type="submit" name="create" value="Create">
    </form>

    <?php
    mysqli_close($conn);
    ?>
</body>
</html>

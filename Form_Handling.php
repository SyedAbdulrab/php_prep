<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eseprep"; // Update with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM user");

if ($_SERVER['REQUEST_METHOD'] == "POST" && !isset($_POST['delete_user'])) {

    // adding the htmspecialchars prevents from HTML injection
    $name = htmlspecialchars($_POST["name"]);
    $age = htmlspecialchars($_POST["age"]);

    // trimming the input will remove all extra spaces from the input, Good Practice
    $name = trim($name);
    $age = trim($age);




    // Use prepared statements
    $stmt = $conn->prepare("INSERT INTO user (name, age) VALUES (?, ?)"); // Update with your actual table name
    $stmt->bind_param("ss", $name, $age);
    $stmt->execute();
    $stmt->close();

    $userData = "Name: $name, Age: $age\n";
    file_put_contents('user_data.txt', $userData, FILE_APPEND | LOCK_EX);

    // we will close the db connection later as we want to display the users as well
    header("Location: /webESE/Form_Handling.php");


}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete_user'])) {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    $user_name_to_delete = $_POST['name'];

    // Use prepared statement to delete user
    $stmt = $conn->prepare("DELETE FROM user WHERE name = ?");
    $stmt->bind_param("s", $user_name_to_delete);
    $stmt->execute();
    $stmt->close();

    // Redirect to refresh the page after deletion
    header("Location: /webESE/Form_Handling.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Form Handling</title>
</head>

<body>
    <div class="container mt-4">
        <h1>Form Handling in PHP</h1>
        <form action="/webESE/Form_Handling.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="helpId" />
                <small id="helpId" class="text-muted">Enter Thy Name, Sire!</small>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="text" name="age" id="age" class="form-control" placeholder="" aria-describedby="helpId" />
                <small id="helpId" class="text-muted">Enter Thy Age, Sire!</small>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>




        </form>

        <?php if ($result !== null) : // Check if $result is not null before trying to fetch data 
        ?>
            <!-- Display users in a table -->
            <hr>
            <h2 class="mt-4">Users</h2>
            <table class="table">
                <thead>
                    <tr>

                        <th>Name</th>
                        <th>Age</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Display users
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['age'] . '</td>';
                        echo '<td>
                        <form method="post" action="/webESE/Form_Handling.php">
                            <input type="hidden" name="name" value="' . $row['name'] . '">
                            <button type="submit" name="delete_user" class="btn btn-danger">Delete</button>
                        </form>';
                        echo '</tr>';
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
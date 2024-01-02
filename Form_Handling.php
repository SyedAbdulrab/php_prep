<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // adding the htmspecialchars prevents from HTML injection
    $name = htmlspecialchars($_POST["name"]);
    $age = htmlspecialchars($_POST["age"]);

    // trimming the input will remove all extra spaces from the input, Good Practice
    $name = trim($name);
    $age = trim($age);

    echo ' <div
       class="alert alert-success alert-dismissible fade show"
       role="alert"
   >
       <button
           type="button"
           class="btn-close"
           data-bs-dismiss="alert"
           aria-label="Close"
       ></button>
   
       <strong>Your name is ' . $name . '</strong> and you are ' . $age . ' years old!
   </div>';
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


    </div>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
<?php
include_once "./config/dbconnect.php";
if (isset($_REQUEST['search-filter'])) {
    $text_search = $_REQUEST['text-search'];
    $like = "%$text_search%";
    // $select_1 = $con->prepare("SELECT * FROM information Where Name LIKE ?;");
    $select_1 = $con->prepare("SELECT * FROM information Where  Name LIKE ?;");
    // $select_1->bindParam(':Name', $text_search);
    $select_1->execute([$like]);
    // $row = $select_1->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/style.css">
    <title>Search</title>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light  " style="background-color: #e3f2fd;">
            <div class="container">
                <a class="navbar-brand" href="./home.php">สถานที่ท่องเที่ยว</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link " href="index.php" tabindex="-1" aria-disabled="true">Login</a>
                    </div>
                </div>
            </div>
        </nav>

        <form class="row-center mt-3" action="./search.php" role="search" method="POST">
            <div class="row justify-content-center">
                <div class="col-6">
                    <input type="search" name="text-search" class="form-control" id="search1" placeholder="search" required>
                </div>
                <div class="col-3">
                    <input type="submit" name="search-filter" class="btn btn-primary" value="ค้นหา"> </input>
                </div>
            </div>
        </form>
        <div class="row">
            <div id="users_table"></div>
        </div>
    </div>
</body>

</html>
<script>
    function loadshowindex() {
        const xhttp = new XMLHttpRequest();
        xhttp.open("GET", "http://localhost/ProjectCIT3514/api/read.php");
        xhttp.send();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // console.log(this.responseText);
                var trHTML = '';
                const objects = JSON.parse(this.responseText);
                for (let object of objects) {
                    trHTML += '<div class="col-12 col-md-4 col-lg-4 my-2">';
                    trHTML += '<a href="./details.php?id=' + object['id'] + '" id="black">';
                    trHTML += '<div class="card">';
                    trHTML += '<img src="' + object['photo'] + '"  class="card-img-top" alt="" width="100%" height="200px">';
                    trHTML += '<div class="card-body">';
                    trHTML += '<h5 class="card-title">' + object['Name'] + '</h5>';
                    trHTML += '<h5 class="card-title">' + object['province'] + '</h5>';
                    // trHTML += '<a class="card-title" >' + object['province'] + '</a>';
                    trHTML += '</div>';
                    trHTML += '</div>';
                    trHTML += '</a>';
                    trHTML += '</div>';
                }
                document.getElementById("users_table").outerHTML = trHTML;
            }
        };
    }
    loadshowindex();
    
</script>
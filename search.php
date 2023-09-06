<?php
    session_start();

    if (!isset($_GET['key']) || empty($_GET['key'])){
        header("Location: index.php");
        exit;
    }

    $key = $_GET['key'];

    include "php/data_connection.php";

    include "php/authorizer_book.php";
    $books = search_books($con, $key);

    include "php/author.php";
    $author = get_all_author($con);

    include "php/auth_category.php";
    $category = get_all_category($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Book Store</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Store</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION['user_id'])){
                                ?>
                            <a class="nav-link" href="admin.php">Admin</a>
                            <?php }else{ ?>
                            <a class="nav-link" href="login.php">Login</a>
                        <?php } ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        Search Result for <b><?=$key?></b>

        <div class="d-flex pt-5">
            <?php if ($books == 0){ ?>
                <div class="alert alert-warning text-center p-1 pdf-list" role="alert">
                <img src="https://liferay-support.zendesk.com/hc/article_attachments/360032812612/no-web-content-found.png" class="p-3" width="30%" alt="">
                No <b>"<?=$key?>"</b> Content Was FOUND
            </div>
            <?php }else{ ?>
            <div class="pdf-list d-flex flex-wrap">
                <?php foreach ($books as $book) { ?>
                <div class="card m-1">
                    <img src="uploads/cover/64f36f31ac9688.17883200.png" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?=$book['title']?></h5>
                        <p class="card-text">
                        <?=$book['descript']?>
                        </p>
                        <a href="uploads/files/<?=$book['file']?>" class="btn btn-success rounded-0">Open Book</a>
                        <a href="uploads/files/<?=$book['file']?>" class="btn btn-primary rounded-0" download="The title">Download</a>
                    </div>

                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
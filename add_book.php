<?php
    session_start();
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){

        include "php/data_connection.php";

        include "php/auth_category.php";
        $category = get_all_category($con);

        include "php/author.php";
        $author = get_all_author($con);

        if (isset($_GET['title'])){
            $title = $_GET['title'];
        }else $title = "";

        if (isset($_GET['description'])){
            $description = $_GET['description'];
        }else $description = "";

        if (isset($_GET['category_id'])){
            $category_id = $_GET['category_id'];
        }else $category_id = 0;

        if (isset($_GET['author_id'])){
            $author_id = $_GET['author_id'];
        }else $author_id = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="admin.php">Admin Panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Store</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="add_book.php">Add Book</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="add_category.php">Add Category</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="add_author.php">Add Author</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <form action="php/add-book.php" method="post" enctype="multipart/form-data" class="shadow p-4 rounded-0 mt-5" style="width: 90%; max-width: 50rem;">
            <h1 class="text-center">Add Book</h1>
            <?php if (isset($_GET['error'])){?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($_GET['error']); ?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['success'])){?>
                <div class="alert alert-success" role="alert">
                    <?= htmlspecialchars($_GET['success']); ?>
                </div>
            <?php } ?>
            <div class="mb-3">
                <label class="form-label">Book Title</label>
                <input type="text" name="book_title" class="form-control rounded-0" value="<?=$title?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Book Description</label>
                <input type="text" name="book_description" class="form-control rounded-0" value="<?=$description?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Book Author</label>
                <select name="book_author" class="form-control">
                    <option value="0">
                        Select Author
                    </option>
                    <?php 
                        if ($author == 0){

                        }else{

                        }
                        foreach ($author as $auths){ 
                            if ($auths_id == $auths['id'])
                            {
                                
                        ?>
                            <option selected value="<?=$auths['id']?>">
                                <?=$auths['name']?>
                            </option>
                        <?php }else{ ?>
                            <option value="<?=$auths['id']?>">
                                <?=$auths['name']?>
                            </option>
                        <?php }} ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Book Category</label>
                <select name="book_category" class="form-control">
                    <option value="0">
                        Select Category
                    </option>
                    <?php 
                        if ($category == 0){

                        }else{

                        }
                        foreach ($category as $category){ 
                            if ($category_id == $category['id'])
                            {
                                
                        ?>
                            <option selected value="<?=$category['id']?>">
                                <?=$category['name']?>
                            </option>
                        <?php }else{ ?>
                            <option value="<?=$category['id']?>">
                                <?=$category['name']?>
                            </option>
                        <?php }} ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Book Cover</label>
                <input type="file" name="book_cover" class="form-control rounded-0">
            </div>
            <div class="mb-3">
                <label class="form-label">Book File</label>
                <input type="file" name="file" class="form-control rounded-0">
            </div>
            <button type="submit" class="btn btn-primary rounded-0">Add Book</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>

<?php }else{
    header("Location: login.php");
    exit;
} ?>
<?php
    session_start();
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])){

    include "php/data_connection.php";

    include "php/authorizer_book.php";
    $books = get_all_books($con);

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
    <title>ADMIN Control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="./admin.php">Admin Panel</a>
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

        <form action="search.php" style="width: 100%; max-width: 30rem">
            <div class="input-group my-5">
                <input type="text" class="form-control" name="key" placeholder="Search Books" aria-label="Search Books" aria-describedby="basic-addon2">
                <button class="input-group-text btn btn-primary" id="basic-addon2">Search</button>
            </div>
        </form>


        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['error']); ?>
		  </div>
		<?php } ?>
		<?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
			  <?=htmlspecialchars($_GET['success']); ?>
		  </div>
		<?php } ?>
        <?php if ($books == 0) { ?>
                <div class="alert alert-warning text-center p-1 pdf-list" role="alert">
                <img src="https://liferay-support.zendesk.com/hc/article_attachments/360032812612/no-web-content-found.png" class="p-3" width="30%" alt="">
                There is No Books Content Was FOUND
            </div>
        <?php } else {?>
        <h4 class="mt-5">Books List</h4>
        <table class="table table-bordered shadow">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Descipt</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0; foreach ($books as $book) { $i++; ?>
                <tr>
                    <td><?=$i?></td>
                    <td>
                        <a class="link-dark d-block text-center" href="uploads/files/<?=$book['file'];?>">
                            <?=$book['title'];?>
                        </a>
                    </td>
                    <td>
                        <?php 
                            if ($author == 0){
                                echo "Undefined";
                            }else{
                                foreach ($author as $auth){
                                    if ($auth['id'] == $book['author_id']){
                                        echo $auth['name'];
                                    }
                                }
                            }
                        ?>
                    </td>
                    <td><?=$book['descript']?></td>
                    <td>
                        <?php 
                            if ($category == 0){
                                echo "Undefined";
                            }else{
                                foreach ($category as $categorys){
                                    if ($categorys['id'] == $book['category_id']){
                                        echo $categorys['name'];
                                    }
                                }
                            }
                        ?>
                    </td>
                    <td>
                        <a href="edit_book.php?id=<?=$book['id']?>" class="btn btn-warning">Edit</a>
                        <a href="php/delete-book.php?id=<?=$book['id']?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <?php }?>

        <?php if ($category == 0) { ?>
            <div class="alert alert-warning text-center p-1" role="alert">
                <img src="https://dosi-in.com/file/logos/22/dosiin-F776951B-9AF4-4AA9-A40E-7BA3A69BDFC022058.jpeg?w=320&h=320&fm=webp" width="50" alt="">
                There is no category in the DataBase!!
            </div>
        <?php }else {?>
        <h4 class="mt-5">All Categories</h4>
        <table class="table table-bordered shadow">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $j = 0;
                    foreach ($category as $categories){
                        $j++;
                ?>
                <tr>
                    <td><?=$j?></td>
                    <td><?=$categories['name']?></td>
                    <td>
                        <a href="edit_category.php?id=<?=$categories['id']?>" class="btn btn-warning">Edit</a>
                        <a href="php/delete-category.php?id=<?=$categories['id']?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>

        

        <?php if ($author == 0) { ?>
            <div class="alert alert-warning text-center p-1" role="alert">
                <img src="https://dosi-in.com/file/logos/22/dosiin-F776951B-9AF4-4AA9-A40E-7BA3A69BDFC022058.jpeg?w=320&h=320&fm=webp" width="50" alt="">
                There is no author in the DataBase!!
            </div>
        <?php }else {?>
        <h4 class="mt-5">All Author</h4>
        <table class="table table-bordered shadow">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Author Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $k = 0;
                    foreach ($author as $auths){
                        $k++;
                ?>
                <tr>
                    <td><?=$k?></td>
                    <td><?=$auths['name']?></td>
                    <td>
                        <a href="edit_auths.php?id=<?=$auths['id']?>" class="btn btn-warning">Edit</a>
                        <a href="php/delete-auths.php?id=<?=$auths['id']?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>

<?php }else{
    header("Location: login.php");
    exit;
} ?>
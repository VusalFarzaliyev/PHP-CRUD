<?php
include "connect.php";
//Data Insert
if(isset($_POST['submit']) and !empty($_POST['name']) and !empty($_POST['name']))
{
    $name     = $_POST['name'];
    $surname  = $_POST['surname'];

    $sql = "INSERT INTO `user` (`name`,`surname`) VALUES('$name','$surname')";
    $query = mysqli_query($connect,$sql);
    if($query)
    {
        echo
        '
            <div class="alert alert-success" role="alert">
             Məlumat əlava edildi!
            </div>
        ';
    }
    else
    {
        echo "Date not inserted!";
        echo $sql;
        exit();
    }
}
//Data Delete
if(isset($_GET['delete']))
{
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM `user` WHERE id=$id";
    $query =mysqli_query($connect,$sql);
    if($query)
    {
        echo
        '
            <div class="alert alert-danger" role="alert">
            Məlumat uğurla silindi!
            </div>
        ';
    }
    else
    {
        echo "Data not inserted";
        echo $sql;
        exit();
    }



}
// ALL Data Delete
if(isset($_POST['delete_all']))
{
    $sql = "DELETE FROM `user` ";
    $query =mysqli_query($connect,$sql);
    if($query)
    {
        echo
        '
            <div class="alert alert-danger" role="alert">
              Bütün məlumatlar silindi!
            </div>
        ';
    }
    else
    {
        echo "Data not deleted";
        echo $sql;
        exit();
    }



}
//Data Update
if(isset($_GET['edit']))
{
    $id = $_GET['edit'];
    $update = true;
    $sql = "SELECT * FROM user WHERE id=$id";
    $query =mysqli_query($connect,$sql);
    if($query)
    {
        $row = $query->fetch_array();
        $name = $row['name'];
        $surname = $row['surname'];
    }
}
if(isset($_POST['update']))
{
    $id =$_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $sql = "UPDATE `user` SET `name`='$name', `surname`='$surname' WHERE id=$id";
    $query = mysqli_query($connect,$sql);
    if($query)
    {
        echo
        '
            <div class="alert alert-warning" role="alert">
              Məlumat uğurla dəyişdirildi!
            </div>
        ';

    }

}



?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="">
    <!-- Title-->
    <title>Crud operations</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 ">
            <form class="mt-5" action="index.php" method="post">
                <input name="id" type="hidden" value="<?=$id;?>">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Ad"  value="<?=$name;?>" >
                </div>
                <div class="form-group">
                    <input type="text" name="surname" class="form-control" placeholder="Soyad" value="<?=$surname;?>">
                </div>
                <?php
                    if($update==true):
                ?>
                <button type="submit" name="update" class="btn btn-success">Düzəlt</button>
                <?php
                    else:
                ?>
                <button type="submit" name="submit" class="btn btn-primary">Yadda saxla</button>
                <?php
                    endif;
                ?>
                <a href="index.php" class="btn btn-warning" type="reset" value="Reset">Yenilə</a>
                <button name="delete_all" class="btn btn-danger">Hamısını sil</button>
            </form>

        </div>
        <div class="col-md-8">
            <nav class="navbar navbar-light mt-5">
                <form class="form-inline" action="index.php" method="get">
                    <input class="form-control mr-sm-2" type="search" placeholder="Axtarış" name="text" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search">Axtar</button>
                </form>
            </nav>
            <table class="table table-bordered table-dark">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Ad</th>
                    <th scope="col">Soyad</th>
                    <th scope="col">Əməliyyatlar</th>
                </tr>
                </thead>
                <?php
                if(isset($_GET['text']))
                {
                    $searchKey = $_GET['text'];
                    $sql = "SELECT * FROM user WHERE CONCAT(name,surname)  LIKE '%$searchKey%'";
                }
                else
                {
                    $sql = "SELECT * FROM user ORDER BY id DESC";
                }
                $query =mysqli_query($connect,$sql);
                $all =mysqli_fetch_all($query,1);
                foreach ($all as $key => $value)
                {
                ?>

                <tbody>
                <tr>
                    <th><?=$value['id'];?></th>
                    <th><?=$value['name'];?></th>
                    <th><?=$value['surname'];?></th>
                    <th>
                        <a href="index.php?edit=<?=$value['id'];?>" class="btn btn-primary">Düzəlt</button>
                        <a href="index.php?delete=<?=$value['id'];?>" class="btn btn-danger ml-3">Sil</a>

                    </th>

                </tr>
                </tbody>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>

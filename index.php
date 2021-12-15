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
              Data inserted successfuly!
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
              Data deleted successfuly!
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
              Data updated successfuly!
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
                    <input type="text" name="name" class="form-control" placeholder="Name"  value="<?=$name;?>" >
                </div>
                <div class="form-group">
                    <input type="text" name="surname" class="form-control" placeholder="Surname" value="<?=$surname;?>">
                </div>
                <?php
                    if($update==true):
                ?>
                <button type="submit" name="update" class="btn btn-info">Update</button>
                <?php
                    else:
                ?>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                <?php
                    endif;
                ?>
            </form>
        </div>
        <div class="col-md-8">
            <table class="table table-bordered table-dark mt-5">
                <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Operation</th>
                </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM user ORDER BY id DESC";
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
                        <a href="index.php?edit=<?=$value['id'];?>" class="btn btn-primary">Edit</button>
                        <a href="index.php?delete=<?=$value['id'];?>" class="btn btn-danger ml-1">Delete</a>

                    </th>

                </tr>
                </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>

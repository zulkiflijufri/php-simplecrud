<?php
require_once 'proses.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simple Crud</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <br><br>
    <div class="container">
        <div class="row justify-content-center">
            <form action="proses.php" method="POST">

                <!-- for update data -->
                <input type="hidden" name="id" value=<?php echo $id; ?>>

                <div class="form-group">
                    <label>Club</label>
                    <input type="text" class="form-control" name="clubName" placeholder="Enter Club Name" value="<?php echo $clubName; ?>">
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <input type="text" class="form-control" name="clubLocation" placeholder="Enter Club Location" value="<?php echo $clubLocation; ?>">
                </div>
                <div class="form-group">
                    <?php if($update == true) : ?>
                        <button class="btn btn-sm btn-info btn-block" type="submit" name="update">Update</button>
                        <?php else: ?>
                            <button class="btn btn-sm btn-primary btn-block" type="submit" name="save">Save</button>
                        <?php endif ?>
                    </div>
                </form>
            </div>
            <br><br>

            <!-- Menampilkan data dari db -->
            <?php 
            $conn = new mysqli("localhost", "root", "", "simplecrud") or die(mysqli_error($conn));
            $result = $conn->query("SELECT * FROM club") or die($conn->error);
        //print_r($result->fetch_assoc());
            ?>

            <?php if(isset($_SESSION["message"])) : ?>
                <div class="alert alert-<?php echo $_SESSION["msg_type"]; ?>">
                    <?php
                    echo $_SESSION["message"];
                    unset($_SESSION["message"]);
            //session_destroy();
                    ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>

            <div class="row justify-content-center">
                <table class="table table-bordered">
                    <?php $no = 1; ?>
                    <tr>    
                        <th>No</th>
                        <th>Club</th>
                        <th>Location</th>
                        <th>Aksi</th>
                    </tr>

                    <?php while($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["location"]; ?></td>
                            <td>
                                <a href="index.php?edit=<?php echo $row["id"]; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="index.php?delete=<?php echo $row["id"]; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data <?php echo $row['name']; ?> ?') ">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile ?>
                </table>    
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
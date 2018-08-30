<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbuser";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

$id = $_GET['id'];

$sql = "SELECT * FROM tbl_user";
$result = $conn->query($sql);

if($id){
    $sql = "SELECT * FROM tbl_user where id_user='$id' ";
    $result2 = $conn->query($sql);
}

$sql = "SELECT * FROM tbl_user";
$result = $conn->query($sql);

if($_POST['act']=='insert'){
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    $sql = "INSERT INTO tbl_user (nama, email) VALUES ('$nama','$email')";
    $conn->query($sql);
    
    header("Location: localhost/tesphp/koneksi.php");

}
if($_POST['act']=='update'){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $id = $_GET['id'];

    $sql = "UPDATE tbl_user SET nama= '$nama', email = '$email' where id_user = '$id' ";
    $conn->query($sql);
    header("Location: koneksi.php");
}


?>
<br/>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<form method="post">
    <table border= "1" class="table" width="50%">
    <tr>
    <td>nama</td>
    <td>email</td>
    <td>aksi</td>
    </tr>
    <?php 
    if ($result2->num_rows > 0) {
        // output data of each row
        while($row2 = $result2->fetch_assoc()) {  
        $data = $row2;       
    ?> 
        
    <?php
        } ?>
        
    <?php } 
    ?>
    <tr>
            <td><input type="text" name="nama" value="<?=$data['nama']?>"></td>
            <td><input type="text" name="email" value="<?=$data['email']?>"></td>
            <td><input type="submit" name="submit" value="kirim"></td>
    <tr>
    </table>
    <?php if($id){
        $val = "update";
    } else {
        $val = "insert";
    }    
    ?>

    <input type="hidden" name="act" value="<?=$val?>">
    </form>
<br/>

<table border= "1">
<tr>
<td>id</td>
<td>nama</td>
<td>email</td>
</tr>
<?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo  $row["id_user"]?></td>
        <td><?php echo  $row["nama"]?></td>
        <td><?php echo  $row["email"]?></td>
        <td><a href="koneksi.php?id=<?= $row['id_user']?>">Edit</a><td>
    </tr>
    <?php 
    } ?>

<?php } else {
    echo "0 results";
}?>
</table>
<br/>
</body>
</html>

<?php
$conn->close();
?>

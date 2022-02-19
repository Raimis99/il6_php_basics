<?php include 'parts/header.php' ?>
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "password";
$dbName = 'user';

try {
$conn = new PDO("mysql:host=$servername;dbname=".$dbName, $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
echo "Connected successfully";
} catch (PDOException $e) {
echo "Connection failed: " . $e->getMessage();
}

$sql = 'SELECT * FROM cities';
$rez = $conn->query($sql);
$cities = $rez->fetchAll();
?>

<form action="submitad.php" method="post">
    <input type="text" name="name" placeholder="Name"><br>
    <input type="text" name="lastName" placeholder="Last Name"><br>
    <input type="email" name="email" placeholder="name@email.com"><br>
    <input type="password" name="pass1" placeholder="Password"><br>
    <input type="password" name="pass2" placeholder="Repeat password"><br>
    <input type="phone" name="phone" placeholder="+370xxxxxxxx"><br>
    <select name="city">
        <?php foreach ($cities as $city){
            echo '<option value="'.$city['id'].'">'.$city['name'].'</option>';
        } ?>
    </select><br>
    <input type="submit" value="create" name="createUser">
</form>
<?php include 'parts/footer.php' ?>

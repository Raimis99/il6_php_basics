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


if(isset($_POST['create'])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $price = $_POST['price'];
    $year = $_POST['year'];

    $sql = 'INSERT INTO ads (title, description, manufacturer_id, model_id, price, year, type_id, user_id) 
            VALUES ("'.$title.'", "'.$content.'", 1, 1, '.$price.', '.$year.', 1, 1)';

    echo $sql;
    $conn->query($sql);

}
if (isset($_POST['createUser'])) {

    $name = $_POST['name'];
    $lastName = $_POST['lastName'];
    $email = cleanEmail($_POST['email']);
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $phone = $_POST['phone'];
    $cityId = intval($_POST['city']);

    if (isPasswordValid($pass1, $pass2) && isEmailValid($email)) {

        $sql = 'INSERT INTO user (name, last_name, email, password, phone, city_id,created_at)
            VALUES ("' . $name . '", "' . $lastName . '", "' . $email . '", "' . $pass1 . '", "' . $phone . '", '.$cityId.',NOW())';
        $conn->query($sql);
    }else{
        echo 'check password and email';
    }
}

function isPasswordValid($pass1, $pass2){
    return $pass1 === $pass2 && strlen($pass1) > 3;
}

function isEmailValid($email){
    return strpos($email, '@') !== false;
}

function cleanEmail($email){
    return trim(strtolower($email));
}
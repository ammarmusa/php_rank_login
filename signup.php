<?php

$error = "";

function create_userid()
{
    $length = rand(4, 19);
    $number = "";
    for ($i = 0; $i < $length; $i++) {
        $new_rand = rand(0, 9);

        $number = $number . $new_rand;
    }

    return $number;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!$DB = new PDO("mysql:host=localhost;dbname=rank", "root", "")) {
        die("Could not connect to the database!");
    }

    $arr['userid'] = create_userid();
    $condition = true;
    while ($condition) {
        $query = "SELECT id FROM users WHERE userid = :userid limit 1";
        $stm = $DB->prepare($query);
        if ($stm) {
            $check = $stm->execute($arr);
            if ($check) {
                $data = $stm->fetchAll(PDO::FETCH_ASSOC);
                if (is_array($data) && count($data) > 0) {
                    $arr['userid'] = create_userid();
                    continue;
                }
            }
        }
        $condition = false;
    }


    $arr['name'] = $_POST['name'];
    $arr['email'] = $_POST['email'];
    $arr['password'] = hash('sha1', $_POST['password']);
    $arr['rank'] = "user";

    $query = "INSERT INTO users (userid, name, email, password, rank) values (:userid, :name, :email, :password, :rank)";
    $stm = $DB->prepare($query);
    if ($stm) {
        $check = $stm->execute($arr);
        if (!$check) {
            $error = "Could not save to database";
        }

        if ($error == "") {
            header("Location: login.php");
            die;
        }
    }
}
?>

<?php include "header.php"; ?>
<h1>Signup</h1>
<?php
if ($error != "") {
    echo "<br>" . $error . "<br>";
}
?>
<form action="" method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="name" name="name" placeholder="Name" required>
    <input type="password" name="password" placeholder="Password" required>

    <input type="submit" value="Signup">
</form>
<?php include "footer.php"; ?>
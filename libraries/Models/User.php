<?php
class Users
{
function VerifindINformationConnect()
{
    $pdo = getpdo();
    $query = "SELECT * FROM users
              WHERE (email = :email OR username =:email)";
    $query = $pdo->prepare($query);
    $query->execute([
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ]);
    $user = $query->fetch();
    return $user;
}

function findUserByUsername($username)
{
    $pdo = getpdo();
    $query = "SELECT * FROM users WHERE username = ?";
    $req = $pdo->prepare($query);
    $req->execute([$username]);
    return $req->fetch();
}

function findUserByEmail($email)
{
    $pdo = getpdo();
    $query = "SELECT * FROM users WHERE email = ?";
    $req = $pdo->prepare($query);
    $req->execute([$email]);
    return $req->fetch();
}

function VerifinderById($id)
{
    $pdo = getpdo();
    $id = $_GET['id'];
    $query = "SELECT * FROM users WHERE id = ?";
    $req = $pdo->prepare($query);
    $req->execute([$id]);
    return $req->fetch();
}


function findErrors()
{
    $pdo = getpdo();
    $errors = [];
    $query = "INSERT INTO users (username,email,password) VALUES(?,?,?)";
    $req = $pdo->prepare($query);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $req->execute([$_POST['username'], $_POST['email'], $password]);
    return $errors;
}


}
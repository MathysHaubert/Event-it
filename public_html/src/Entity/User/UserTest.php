<?php

require '../../../vendor/autoload.php';

use App\Entity\User\User;
use App\Entity\User\UserInterface;

// Define $param before calling getUser
$param = "bozo@example.com";

$userInstance = new User();

echo "Test createUser\n";
$data = ['email'=>"test@test", "password"=>"test", "firstName"=>"test","lastName"=>"test","role"=>""];
$newUser = $userInstance->createUser($data);
var_dump($newUser);
echo "\n done createUser\n";

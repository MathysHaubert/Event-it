<?php

require '../../../vendor/autoload.php';

use App\Entity\User\User;
use App\Entity\User\UserInterface;

// Define $param before calling getUser
$param = (['email' => "bozo@example.com"]);
$userInstance = new User();

echo "Test getUser\n";
$user = $userInstance->getUser($param);
// var_dump($user);
echo "\n done getUser\n";

$userInstance2 = new User();

echo "Test createUser\n";
$data = ['email'=>"test@test", "password"=>"test", "firstName"=>"test","lastName"=>"test","role"=>""];
$newUser = $userInstance2->createUser($data);
var_dump($newUser);
echo "\n done createUser\n";

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "bootstrap.php";

$response = file_get_contents("http://www.kongregate.com/api/user_info.json?username=decisi");
$response = json_decode($response);

$username = $response->user_vars->username;

if(count($em->getRepository('User')->findByUsername($username)) > 0) {
	$user = $em->getRepository('User')->findByUsername($username);
	$user = $user[0];
} else {
	$user = new User();
}

$user->setUsername($username);
$user->setLevel($response->user_vars->points);
$user->setPoints($response->user_vars->level);
$user->setUpdated(new \DateTime('now'));

$em->persist($user);
$em->flush();

?>
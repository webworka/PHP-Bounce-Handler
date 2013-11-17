<?php
/**
 * Created by PhpStorm.
 * User: oli
 * Date: 17.11.13
 * Time: 23:41
 */

require(dirname(__FILE__) . "/../../bounce_driver.class.php");

$emailString = file_get_contents(dirname(__FILE__) . "/email.eml");

// Creating Bouncehandler and print out result
$bounceHandler = new BounceHandler();
$bounceHandler->get_the_facts($emailString);

var_dump($bounceHandler->find_x_header('X-Priority'));

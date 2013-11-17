<?php
/**
 * Load an e-mail saved as local file an print out the result of the bounce_driver
 *
 * User: oli
 * Date: 17.11.13
 * Time: 17:07
 */

require(dirname(__FILE__) . "/../../bounce_driver.class.php");

$emailString = file_get_contents(dirname(__FILE__) . "/email.eml");

// Creating Bouncehandler and print out result
$bounceHandler = new BounceHandler();
print_r($bounceHandler->get_the_facts($emailString));

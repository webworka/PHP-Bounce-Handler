<?php
/**
 * Created by PhpStorm.
 * User: oli
 * Date: 17.11.13
 * Time: 23:26
 */

/* connect to gmail */
$hostname = '[YOUR HOSTNAME]';
$username = '[YOUR USERNNAME]';
$password = '[YOUR PASSWORD]';

require(dirname(__FILE__) . "/../../ImapDriver.php");
$imap = new ImapDriver($username, $password, $hostname);
$emails = $imap->getNewEmailsFromInbox();

// Checking all E-Mails for Bounces
require(dirname(__FILE__) . "/../../bounce_driver.class.php");
$bounceHandler = new BounceHandler();

foreach($emails as $email) {
    print_r($bounceHandler->get_the_facts($email));
}


echo "finished\n";
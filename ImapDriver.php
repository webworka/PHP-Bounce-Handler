<?php
/**
 * Created by PhpStorm.
 * User: oli
 * Date: 17.11.13
 * Time: 17:52
 */

class ImapDriver {

    /**
     * @var string
     */
    protected $username = null;

    /**
     * @var string
     */
    protected $password = null;

    /**
     * @var string
     */
    protected $hostname = null;


    /**
     * Construct
     *
     * @param $username
     * @param $password
     * @param $hostname
     */
    public function __construct($username, $password, $hostname) {
        $this->username = $username;
        $this->password = $password;
        $this->hostname = $hostname;
    }

    public function getNewEmailsFromInbox() {
        $inbox = imap_open($this->hostname, $this->username, $this->password) or die('Cannot connect to Imap Account: ' . imap_last_error());

        /* grab emails */
        $emails = imap_search($inbox,'NEW');

        $emailTexts = array();

        /* if emails are returned, cycle through each... */
        if($emails) {
            /* put the newest emails on top */
            rsort($emails);

            /* for every email... */
            foreach($emails as $email_number) {
                $emailTexts[] = imap_fetchbody($inbox,$email_number,2);
            }
        }

        return $emailTexts;
    }

}

/* connect to gmail */
$hostname = '{mail.senercon.de:995/imap/ssl/novalidate-cert}INBOX';
$username = 'rgfwbounces@senercon.de';
$password = 'rgfwbounces1.';

$imap = new ImapDriver($username, $password, $hostname);
print_r($imap->getNewEmailsFromInbox());


echo "fertig\n";
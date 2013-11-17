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

    /**
     * Fetches some/all mails from a specific Mailbox and returns them as a string array
     * Be aware that Mails are marked as read when fetching them
     *
     * @param string $search
     * @return array
     */
    public function getNewEmailsFromInbox($search = 'ALL') {
        $inbox = imap_open($this->hostname, $this->username, $this->password, OP_DEBUG) or die('Cannot connect to Imap Account: ' . imap_last_error());

        /* grab emails */
        $emails = imap_search($inbox, $search);

        $emailTexts = array();

        /* if emails are returned, cycle through each... */
        if($emails) {
            /* put the newest emails on top */
            rsort($emails);

            /* for every email... */
            foreach($emails as $email_number) {
                $headers = imap_fetchheader($inbox, $email_number, FT_PREFETCHTEXT);
                $emailTexts[] = $headers . imap_fetchbody($inbox, $email_number, "1");
            }
        }

        return $emailTexts;
    }

}


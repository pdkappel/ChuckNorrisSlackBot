<?php

/*
 *  simple class to post random fake facts from Chuck Norris to Slack channels
 *  uses a predefined slack bot to handle publishing on Slack
 *  needs php curl
 *
 *  author: Henrik Algmark (GitHub @henkealg)
 *
 */


class norris {

    private $slackToken =   '';
    var $slackChannel   =   '#general'; // always prefix channels with #

    var $execLog        =   false; // log the results of slack posts to a local log. logfile must have write permissions
    var $factsStore     =   'facts.txt';
    var $slackEndpoint  =   'https://slack.com/api/chat.postMessage';

    var $userName       =   'Chuck Norris';
    var $userIconUrl    =   'https://s3-us-west-2.amazonaws.com/slack-files2/avatars/2015-06-03/5203069031_bc99a616508794628cf4_48.jpg';

    // =============================================

    public function postChuckFact()
    {
        // get a random chuck fact
        $facts = file( $this->factsStore );
        $theFact = rand(0, (count($facts)-1));

        // now post the amazing, important fact to the selected Slack #channel
        $pl = array('token'     =>  $this->slackToken,
                    'username'  =>  $this->userName,
                    'icon_url'  =>  $this->userIconUrl,
                    'channel'   =>  $this->slackChannel,
                    'text'      =>  $facts[$theFact] );

        $post = $this->curlPost($pl);

        // log the response from Slack if set
        if($this->execLog) $this->execLog($post);
    }

    private function curlPost($payload=array())
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->slackEndpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec ($ch);
        curl_close ($ch);

        return $response;
    }

    private function execLog($event, $filename='exec')
    {
        // open
        $logfile = @fopen($filename . '.log', "a+");
        // write log
        @fwrite($logfile, date("Y-m-d H:i:s") . ' | ' . $event . "\n");
        // close file
        @fclose($logfile);
    }

}
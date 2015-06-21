<?php

/**
 * Scheduler Class which executes daily and perfoms the initiated job
 *  
 * @author Faizan Ayubi
 */

class CRON extends Users {

    public function __construct($options = array()) {
        parent::__construct($options);
        $this->willRenderLayoutView = false;
        $this->willRenderActionView = false;
    }

    public function index() {
        $this->_secure();
        $this->leads();
        $this->log("Leads Sent");
    }

    /**
     * Follow Leads, Send Further Message for completing Campaign
     */
    protected function leads() {
        $date = strftime("%Y-%m-%d", strtotime('-4 days'));
        $now = strftime("%Y-%m-%d", strtotime('now'));
        
        $leads = Lead::all(array("validity = ?" => true));
        foreach ($leads as $lead) {
            $campaign = Campaign::first(array("id = ?" => $lead->campaign_id));
            $template = Template::first(array(""));
            switch ($lead->status) {
                case $value:
                    
                    break;

                default:
                    break;
            }
        }
        
        //using distinct so as to reduce db query for message and crm
        $leads = Lead::all(array("created = ?" => $date), array("DISTINCT crm_id"));
        foreach ($leads as $lead) {
            $crm = CRM::first(array("id = ?" => $lead->crm_id), array("second_message_id"));
            $message = Message::first(array("id = ?" => $crm->second_message_id));
            $lds = Lead::all(array("created = ?" => $date, "crm_id = ?" => $lead->crm_id));
            foreach ($lds as $ld) {
                $exist = User::first(array("email = ?" => $ld->email), array("id"));
                if (!$exist) {
                    $user = User::first(array("id = ?" => $ld->user_id), array("id","name","email","phone"));
                    $ld->status = "SECOND_MESSAGE_SENT";
                    $this->notify(array(
                        "template" => "leadGeneration",
                        "subject" => $message->subject,
                        "message" => $message,
                        "user" => $user,
                        "from" => $user->name,
                        "emails" => array($ld->email)
                    ));
                } else {
                    $ld->status = "REGISTERED";
                }
                
                $ld->updated = $now;
                $ld->save();
            }
        }
        
        $second_leads = Lead::all(array("updated = ?" => $date));
        foreach ($second_leads as $second_lead) {
            $exist = User::first(array("email = ?" => $second_lead->email), array("id"));
            if ($exist) {
                $second_lead->status = "REGISTERED";
            } else {
                $second_lead->status = "NOT_REGISTERED";
            }
            $second_lead->updated = $now;
            $second_lead->save();
        }
    }
    
    /**
     * @protected
     */
    public function _secure() {
        if ($_SERVER['REMOTE_ADDR'] != $_SERVER['SERVER_ADDR']) {
            die('access is not permitted');
        }
    }

}

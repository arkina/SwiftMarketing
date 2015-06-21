<?php

/**
 * Description of app
 *
 * @author Faizan Ayubi
 */
use Framework\RequestMethods as RequestMethods;

class App extends Home {

    /**
     * @before _secure, changeLayout
     */
    public function index() {
        $this->seo(array("title" => "Dashboard", "view" => $this->getLayoutView()));
        $view = $this->getActionView();
    }

    /**
     * @before _secure, changeLayout
     */
    public function campaignCreate() {
        $this->seo(array("title" => "Create Campaign", "view" => $this->getLayoutView()));
        $view = $this->getActionView();

        if (RequestMethods::post("action") == "createCampaign") {
            $campaign = new Campaign(array(
                "title" => RequestMethods::post("title"),
                "user_id" => $this->user->id
            ));
            $campaign->save();

            $body = RequestMethods::post("message");
            $subject = RequestMethods::post("subject");
            $day = RequestMethods::post("day");
            foreach ($body as $key => $value) {
                $msg = new Message(array(
                    "subject" => $subject[$key],
                    "body" => $value
                ));
                $msg->save();

                $template = new Template(array(
                    "campaign_id" => $campaign->id,
                    "message_id" => $msg->id,
                    "pipeline" => $key,
                    "day" => $day[$key]
                ));
                $template->save();
            }
            $view->set("success", TRUE);
        }
    }

    /**
     * @before _secure, changeLayout
     */
    public function campaignStart() {
        $this->seo(array("title" => "Start Campaign", "view" => $this->getLayoutView()));
        $view = $this->getActionView();

        if (RequestMethods::post("action") == "leadGeneration") {
            if (RequestMethods::post("emails")) {
                $emails = explode(",", RequestMethods::post("emails"));
            } else {
                $emails = array();
            }
            $campaign_id = RequestMethods::post("campaign_id");
            if (!empty($_FILES['file']['name'])) {
                $tmpName = $_FILES['file']['tmp_name'];
                $csvAsArray = array_map('str_getcsv', file($tmpName));
                foreach ($csvAsArray as $key => $value) {
                    $exist = Lead::first(array("email = ?" => $value[0], "campaign_id = ?" => $campaign_id), array("email"));
                    if (!$exist) {
                        array_push($emails, $value[0]);
                    } else {
                        array_push($exists, $value[0]);
                    }
                }
            }

            if (!empty($emails)) {
                $template = Template::first(array("campaign_id = ?" => $campaign_id, "pipeline = ?" => "0"), array("message_id"));
                $message = Message::first(array("id = ?" => $template->message_id));

                foreach ($emails as $email) {
                    $lead = new Lead(array(
                        "user_id" => $this->user->id,
                        "email" => $email,
                        "campaign_id" => $campaign_id,
                        "status" => "FIRST_MESSAGE_SENT",
                        "validity" => TRUE
                    ));
                    $lead->save();
                    
                    $this->mail(array(
                        "template" => "leadGeneration",
                        "message" => $message,
                        "user" => $this->user,
                        "emails" => $emails
                    ));
                }
                $view->set("success", TRUE);
            }

            if (!empty($exists)) {
                $view->set("success", implode("", $exists) . " Already Exists");
            }
        }

        $campaigns = Campaign::all();
        $view->set("campaigns", $campaigns);
    }

    /**
     * @before _secure, changeLayout
     */
    public function campaignStats() {
        $this->seo(array("title" => "Stats of Campaign", "view" => $this->getLayoutView()));
        $view = $this->getActionView();
    }

    /**
     * @before _secure, changeLayout
     */
    public function pipeline() {
        $this->seo(array("title" => "Pipeline", "view" => $this->getLayoutView()));
        $view = $this->getActionView();
    }

    /**
     * @before _secure, changeLayout
     */
    public function analytics() {
        $this->seo(array("title" => "Analytics", "view" => $this->getLayoutView()));
        $view = $this->getActionView();
    }

    /**
     * @before _secure, changeLayout
     */
    public function teams() {
        $this->seo(array("title" => "Manage Team", "view" => $this->getLayoutView()));
        $view = $this->getActionView();
    }

    /**
     * @before _secure, changeLayout
     */
    public function members() {
        $this->seo(array("title" => "Team Members", "view" => $this->getLayoutView()));
        $view = $this->getActionView();
    }

    /**
     * @before _secure, changeLayout
     */
    public function search() {
        $this->seo(array("title" => "Search", "view" => $this->getLayoutView()));
        $view = $this->getActionView();
    }

    /**
     * Changes the Standard Layout
     */
    public function changeLayout() {
        $this->defaultLayout = "layouts/app";
        $this->setLayout();
    }

}

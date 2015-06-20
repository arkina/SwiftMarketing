<?php
/**
 * Description of app
 *
 * @author Faizan Ayubi
 */
use Framework\RequestMethods as RequestMethods;

class App extends Home{
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
            foreach ($body as $key => $value) {
                $msg = new Message(array(
                    "subject" => $subject[$key],
                    "body" => $value
                ));
                $msg->save();
                
                $template = new Template(array(
                    "campaign_id" => $campaign->id,
                    "message_id" => $msg->id,
                    "pipeline" => $key
                ));
                $template->save();
            }
            $view->set("success", TRUE);
        }
    }
    
    /**
     * @before _secure, changeLayout
     */
    public function campaignManage() {
        $this->seo(array("title" => "Manage Campaign", "view" => $this->getLayoutView()));
        $view = $this->getActionView();
    }
    
    /**
     * @before _secure, changeLayout
     */
    public function campaignStart($param) {
        $this->seo(array("title" => "start Campaign", "view" => $this->getLayoutView()));
        $view = $this->getActionView();
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
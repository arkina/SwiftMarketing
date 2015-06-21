<?php

/**
 * The Default Example Controller Class
 *
 * @author Faizan Ayubi
 */
use Shared\Controller as Controller;
use Framework\RequestMethods as RequestMethods;

class Home extends Controller {

    public function index() {
        $this->seo(array("title" => "SwiftMarketing", "view" => $this->getLayoutView()));
        $view = $this->getActionView();
    }
    
    public function login() {
        $this->seo(array("title" => "Login", "view" => $this->getLayoutView()));
        $view = $this->getActionView();
        
        if(RequestMethods::post("action") == "login"){
            $email = RequestMethods::post("email");
            $password = RequestMethods::post("password");
            $user = User::first(array("email = ?" => $email, "password = ?" => $password));
            if ($user) {
                $this->user = $user;
                self::redirect("/app");
            } else {
                $view->set("success", "Wrong username or password");
            }
        }
        
        if($this->user){
            self::redirect("/app");
        }
    }
    
    public function mail($options) {
        $template = $options["template"];
        $message = $options["message"];
        $user = $options["user"];
        $emails = $options["emails"];
        
        $this->log(implode(",", $emails));
    }
    
    public function track($property, $property_id) {
        header( 'Content-Type: image/png' );
        
        Stat::log($property, $property_id);
        $pixel = 'http://assets.swiftintern.com/images/others/track.png';
        
        //Get the filesize of the image for headers
        $filesize = filesize(APP_PATH . '/public/assets/images/others/track.png');
    
        //Now actually output the image requested, while disregarding if the database was affected
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private',false);
        header('Content-Disposition: attachment; filename="pixel.png"');
        header('Content-Transfer-Encoding: binary' );
        header('Content-Length: '.$filesize);
        readfile($pixel);
        
        exit;
    }
    
    public function log($message = "") {
        $logfile = APP_PATH . "/logs/" . date("Y-m-d") . ".txt";
        $new = file_exists($logfile) ? false : true;
        if ($handle = fopen($logfile, 'a')) {
            $timestamp = strftime("%Y-%m-%d %H:%M:%S", time() + 1800);
            $content = "[{$timestamp}]{$message}\n";
            fwrite($handle, $content);
            fclose($handle);
            if ($new) {
                chmod($logfile, 0755);
            }
        } else {
            echo "Could not open log file for writing";
        }
    }

}

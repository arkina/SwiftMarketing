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
        var_dump($this->user);
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
    }

}

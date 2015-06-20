<?php

/**
 * The Default Example Controller Class
 *
 * @author Faizan Ayubi
 */
use Shared\Controller as Controller;

class Home extends Controller {

    public function index() {
        $this->seo(array("title" => "SwiftMarketing", "view" => $this->getLayoutView()));
        $view = $this->getActionView();
    }

}

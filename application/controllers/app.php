<?php
/**
 * Description of app
 *
 * @author Faizan Ayubi
 */
class App extends Home{
    
    /**
     * @before _secure, changeLayout
     */
    public function index() {
        $this->seo(array("title" => "SwiftMarketing", "view" => $this->getLayoutView()));
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

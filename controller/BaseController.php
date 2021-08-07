<?php


/**
 * A base controller
 * Class BaseController
 * 
 */
abstract class BaseController
{

    /**
     *@var array Data to be shown in the template
     */
    protected $data = array();

    /**
     * @var string View name without extension
     */
    protected $view;


    /**
     * Renders the view
     */
    public function renderView(){
      
        if(!empty($this->view)){
            require_once(VIEW_PATH . ucwords(trim($this->view)) . '.php');
        }
    }

    /**
     * Redirectiom
     * @param string  $url redirect to specified URL
     */
    public function redirect($url){
        header("Location: ".SITE.$url);
        header("Connection: close");
        exit();
    }   
    
    
}
?>
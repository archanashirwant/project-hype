<?php

/**
 * Route controller will call appropriate controller based on the URL
 * Class RouteController
 * 
 */
class RouterController extends BaseController{

  
  /**
   * Displays default 404 page if any route is not found
   * 
   */
  private  function pageNotFound(){
    include(VIEW_PATH.'404.php');
    exit();
  }

  /**
   * Parses URL and returns params as array 
   * @param string $url URL to parse
   */
  private function parseUrl($url){
    $parsedURL = parse_url($url);
    $parsedURL['path'] = ltrim($parsedURL['path'],'/');
    $parsedURL['path'] = trim($parsedURL['path']);
    $explodedUrl = explode('/',$parsedURL['path']);
    return $explodedUrl;
  }




  /**
   * Processes URL and calls appropriate controller and its method
   * @param string  $url URL 
   */
  public function process($url){
      $parsedURL = $this->parseUrl($url);
   
      //first parameter is domain name  
      array_shift($parsedURL);

      if(empty($parsedURL[0]))
        $this->redirect('user/login');

      
      //second parameter is always controller name
      $controllerClass = ucwords(trim(array_shift($parsedURL))).'Controller';

      if(file_exists(CONTROLLER_PATH . $controllerClass . '.php')){
        $this->controller = new $controllerClass;

        //third parameter is method name
        $method = trim(array_shift($parsedURL));

        if (method_exists($this->controller, $method)){          
          $this->controller->$method();
          //set csrf token in seesion to be checked on every form submit.Only allow forms with valid CSRF token
          $_SESSION['csrf_token'] =  bin2hex(random_bytes(32));
       }
        else{
          $this->pageNotFound();
        }
        
      }  
      else{
        $this->pageNotFound();
      }  
      
      $this->view= 'layout';

  }  
}

?>
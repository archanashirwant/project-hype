<?php

/**
 * User controller responsible for user activities
 * Class UserController
 * 
 */
class UserController extends BaseController
{
    /**
     *@var boolean check if user is loggin or not
     */
	private $loggedIn = false;

     /**
     *@var object  user model object
     */
    private $userModel;
    

    public function __construct(){
        $this->userModel = new UserModel();  
    }

     /**
     * Gets list of regitered users
     */

    public function list(){
        if(!$this->isUserLoggedIn()) 
            $this->redirect('user/login');
        $this->data['user'] = $this->userModel->getAllUsers();
        $this->view = 'users';
    }

     /**
     * Logs user in
     * 
     */
    public function login(){
        
        //If user is logged in redirect to user list page
        if($this->isUserLoggedIn()){
            $this->redirect('user/list');
        }
        $this->view = 'login';

        //Upon valid form data and token login user
        if($_SERVER['REQUEST_METHOD'] == 'POST'){   
            if($_POST['token'] != $_SESSION['csrf_token']) {
                $this->data['error'][] = "Illegal form submission";
                return;
            }
            if($this->userModel->login($_POST['username'], $_POST['password'])){
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['username']= $_POST['username'];           
                $this->redirect('user/list');
            }else
                $this->data['error'][] = "Login failed.Try again."; 
        }
        
                
    }

     /**
     * Logs out user
     * Redirects user to login page
     */
    public function logout(){
        session_destroy();
        $this->redirect('user/login');
    }

     /**
     * Registers user
     * 
     */
    public function register(){   
        
        //If user is logged in redirect to user list page
        if($this->isUserLoggedIn()){
            $this->redirect('user/list');
        }

        $this->view = 'register'; 

        //Upon valid form data and token register user
        if($_SERVER['REQUEST_METHOD'] == 'POST'){  

            if($_POST['token'] != $_SESSION['csrf_token']) {
                $this->data['error'][] = "Illegal form submission";
                return;
            }
            if (empty($_POST['username'])) {
                $this->data['error'][] ='Please enter username';
            }elseif (empty($_POST['email'])) {
                $this->data['error'][] = 'Please enter email';
            }elseif (empty($_POST['password'])) {
                $this->data['error'][] = 'Please enter password';
            }elseif (empty($_POST['confirm_password'])) {
                $this->data['error'][] = 'Please enter confirm password';
            }elseif (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
                $this->data['error'][] = 'Username is not valid';
            }elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $this->data['error'][] = 'Email is not valid';
            }elseif (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/', $_POST['password']) == 0) {
                 $this->data['error'][] = 'Password must contain at least one number, one lowercase and one uppercase letter
                        must be  atleast six characters long';
            }elseif ($_POST['password'] !== $_POST['confirm_password'] ) {
                $this->data['error'][] = 'Password mismatch';
            //Do not allow users to register if user with username/email already registerd
            }elseif ($this->userModel->findUser($_POST['email'],$_POST['username'])){
                $this->data['error'][] = 'Username/Email already taken';                
            }

            if(empty($this->data['error'])) {
                if($this->userModel->register($_POST)){
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['username']= $_POST['username'];           
                    $this->redirect('user/list');
                }else{
                    die('Somethig went wrong.Contact Support'); 
                }
            }
        }
    }

    /**
     * Returns true if user is loggedin or false otherwise
     * 
     */
    public function isUserLoggedIn(){
        return isset($_SESSION['loggedin']) ? TRUE:FALSE;        
    }

}
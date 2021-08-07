<?php

class UserModel
{   

     /**
     *@var resource Database instance
     */
    private  $db;
    
    public function __construct()
    {	
        $this->db = Database::getInstance();
    }

    /**
     * Find if user with email or username exists
     * return true on success or false otherwise
     * @param string $email     email address
     * @param string $username  username
     */

    // 
    public function findUser($email,$username)
    {

        $this->db->query('SELECT * FROM users WHERE email= :email OR username= :username');
        $this->db->bind(':email', $email);
        $this->db->bind(':username', $username);
        $row = $this->db->fetch();

        if ($this->db->rowCount() > 0) {
            return true;
        }
        return false;
       
    }

    /**
     * Add user details to users table
     * return true on success or false otherwise
     * 
     */
    
    public function register($data)
    {
            
        $this->db->query('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        
        if ($this->db->execute()) {
            return true;        
        }
        return false;
    
    }

    /**
     * Check if username and password matches
     * return matched data on success or false otherwise
     * 
     */

    public function login($username,  $password)
    {
        $this->db->query('SELECT *FROM users WHERE username=:username');
        $this->db->bind(':username', $username);
        $row = $this->db->fetch();

        if (!$this->db->rowCount()) {
            return false;
        }
        
        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        }
        return false;
        
    }

    /**
     * Get list of all users
     * 
     */

    public function getAllUsers()
    {
        $this->db->query('SELECT * FROM users');        
        $rows = $this->db->fetchAll();
        return $rows;
    }
}
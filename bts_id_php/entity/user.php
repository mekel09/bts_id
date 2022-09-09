<?php

class User{
    
    private $name;
    private $username;
    private $password;
    
    public function getName(){
        return $this->name;
    }
    
    public function setName($name){
        $this->name = $name;
    }
    
    public function getUsername(){
        return $this->username;
    }
    
    public function setUsername($username){
        $this->username = $username;
    }
    
    public function getPassword(){
        return $this->password;
    }
    
    public function setPassword($password){
        $this->password = $password;
    }
}

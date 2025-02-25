<?php

class User{
    public $username;
    public $password;
    public $isAdmin;

    public function __construct($name, $pw)
    {
        $this->username = $name;
        $this->password = $pw;
        $this->isAdmin = false;
    }

}

?>
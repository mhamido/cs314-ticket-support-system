<?php
class ErrorPage
{
    private $errors;

    public function __construct()
    {
        $this->errors = array();
    }

    public function add($err)
    {
        $this->errors[] = $err;
    }
    
    public function empty()
    {
        return empty($this->errors);
    }

    public function redirect($url)
    {
        if (empty($this->errors)) {
            header("Location: $url");
            return;
        }

        $this->displayErrors();
    }

    public function displayErrors()
    {
        require('view/errorPage.php');
    }

}
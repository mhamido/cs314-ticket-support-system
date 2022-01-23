<?php

require_once "model/database.php";

// Php doesn't natively support `enum`s, this 
// is a close approximation of one.

final class ErrorMsg
{
    public const INVALID_PASSWORD = 1;
    public const INVALID_NAME = 2;
    public const USER_ALREADY_EXISTS = 3;
    public const INVALID_EMAIL = 4;
    public const USER_DOES_NOT_EXIST = 5;
    public const INVALID_SERVICES_SELECTED = 6;
}

class ErrorPage
{
    public $language;
    private $errors;

    public function __construct($language = 1)
    {
        $this->language = $language;
        $this->errors = array();
    }

    /** @deprecated add */

    public function add($err)
    {
        $this->errors[] = $err;
    }

    public function emit($err)
    {
        $this->errors[] = $err;
    }

    public function messages()
    {
        $messages = array();

        foreach ($this->errors as $err) {
            $msgid = DatabaseConnection::getInstance()->prepare(
                "SELECT error_message_id FROM joint_error_languages WHERE language_id=? AND error_message_type_id=?"
            );

            $msgid->bind_param('ii', $this->language, $err);
            $msgid->execute();
            $msgid = $msgid->get_result()->fetch_assoc()["error_message_id"];

            // var_dump($msgid);

            $msg = DatabaseConnection::getInstance()->prepare(
                "SELECT * FROM error_messages WHERE id=?"
            );

            $msg->bind_param('i', $msgid);

            $msg->execute();
            $msg = $msg->get_result()->fetch_assoc()["message"];

            $messages[] = $msg;
        }

        return $messages;
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

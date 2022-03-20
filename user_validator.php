<?php

// create a user validator class to handle validation
class UserValidator
{
    private $data;
    private $errors = [];
    private static $fields = ["username", "email"];

    // constructor which takes in POST data from form
    public function __construct($post_data) {
        $this->data = $post_data;
    }

    // check required "fields to check" are present in the data
    public function validateForm(){
        foreach(self::$fields as $field){
            if(!array_key_exists($field, $this->data)){
                trigger_error("'$field' is not present in data");
                return;
            }
        }  
        $this->validateUsername();
        $this->validateEmail();
        // return an error array once all checks are done
        return $this->errors;
    }

    // a method to valiate a username
    private function validateUsername(){

        $val = trim($this->data["username"]);

        if(empty($val)){
            $this->addError("username", "username cannot empty");
        } else {
            if(!preg_match("/^[a-zA-Z0-9]{6,12}$/", $val)){
                $this->addError("username", "username must be 6-12 chars & alphanumberic");
            }
        }
    }

    // a method to validate email 
    private function validateEmail(){

        $val = trim($this->data["email"]);

        if(empty($val)){
            $this->addError("email", "email cannot empty");
        } else {
            if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
                $this->addError("email", "must use valid emial");
            }
        }
    }
    // adds errors to array
    private function addError($key, $val){
        $this->errors[$key] = $val;
    }

    

}

?>
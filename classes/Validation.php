<?php

class Validation{
    
    private $db = null;
    private $passed = false;
    private $errors = array();

    public function __construct(){
        $this->db = DB::getInstance();
    }

    public function check($items = array()){

        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                
                $item = escape($item);
                $value = trim(Input::get($item));

                if ($rule === 'required' && empty($value)) {
                    $this->addError($item, "Field $item is required.");
                } elseif (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addError($item, "Field $item must have a minimum of $rule_value characters.");
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError($item, "Field $item must have a maximum of $rule_value characters.");
                            }
                            break;
                        case 'unique':
                            $check = $this->db->get('id', $rule_value, [$item, '=', $value])->getCount();
                            if ($check) {
                                $this->addError($item, "$item already exists.");
                            }
                            break;
                        case 'matches':
                            if ($value != Input::get('password')) {
                                $this->addError($item, "Field $item must match $rule_value.");
                            }
                            break;
                    }
                }                
            }
        }
        if (empty($this->errors)) {
            $this->passed = true;
        }
        return $this;
    }




    public function check($passwords_req = array($required = true, $min_lenght = 8, $max_lenght = 20, $req_upper = 1, $req_digit = 1 )){

        foreach ($passwords_req as $password => $rules) {
            foreach ($rules as $rule => $rule_value) {
                $regex = '/^';
                if($req_upper == 1) { $regex .= ' (?=.*[A-Z])'; }  
                if($req_digit == 1) { $regex .= ' (?=.*\d)'; }
                $regex .= ' .{' .$min_lenght . ',' . $max_lenght . '}$/';
        
                if(preg_match($regex, $password)) {
                    return true;
                } else {
                    return false;
                }
        
                $password = escape($password);
                $value = trim(Input::get($password));

                if ($rule === 'required' && empty($value)) {
                    $this->addError($password, "Field $password is required.");
                } elseif (!empty($password)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addError($password, "Field $password must have a minimum of $rule_value characters.");
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError($password, "Field $password must have a maximum of $rule_value characters.");
                            }
                            break;
                        case 'req_upper':
                            $regex = '/^';
                            if ($req_upper == 1) { $regex .= ' (?=.*[A-Z])'; }
                            break;
                        case 'req_number':
                             $regex = '/^';
                             if ($req_number == 1) { $regex .= ' (?=.*\d)'; }
                             if(preg_match($regex, $password)) {
                                return TRUE;
                            } else {
                                return FALSE;
                            }
                        }
                            break;
                    }
                }                
            }
        }
        
        }
        return $this;
    }

















    private function addError($item, $error){
        $this->errors[$item] = $error;
    }

    public function hasError($field){
        if (isset($this->errors[$field])) {
            return $this->errors[$field];
        }
        return false;
    }

    public function getErrors(){
        return $this->errors;
    }

    public function passed(){
        return $this->passed;
    }
    
}

?>
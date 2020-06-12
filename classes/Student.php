<?php

class Student extends Table {

    public $student_id = 0;
    public $student_secondary = '';
    public $dolzhnost_id = '';

    public function validate()
    {
        if (!empty($this->dolzhnost_id)) {
            return true;
        }
        return false;
    }
}
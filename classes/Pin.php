<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pin
 *
 * @author Жан
 */

class Pin extends Table
{
    public $pin_id = 0;
    public $teacher_id = '';
    public $course_id = '';
    public $datestart = '';
    public $dateend = '';
    public $price = '';
    public function validate()
    {
        if (!empty($this->teacher_id) && !empty($this->course_id) && !empty($this->datestart) && !empty($this->dateend) && !empty($this->price)) {
            return true;
        }
        return false;
    }
}
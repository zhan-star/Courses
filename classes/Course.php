<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Course
 *
 * @author Жан
 */

class Course extends Table
{
    public $course_id = 0;
    public $name = '';
    public $coursetype = '';
    public $days = '';
    public $counts = '';
    public function validate()
    {
        if (!empty($this->name) && !empty($this->active)) {
            return true;
        }
        return false;

    }
}
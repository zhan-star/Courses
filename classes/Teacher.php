<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Teacher
 *
 * @author Жан
 */
 class Teacher extends Table{
    //put your code here
    public $teacher_id=0;
    public $teacher_secondary='';
    public $birthday='';
    public $gender='';
    public $education='';
    public $category='';
    public function validate(){
        if (!empty($this->birthday)&&!empty($this->gender)&&!empty($this->education)&&!empty($this->category)) {
            return true;
            }
        return false;
    }
}

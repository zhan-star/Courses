<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Жан
 */
class User extends Table{
    //put your code here
        public $user_id = 0;
        public $lastname = '';
        public $firstname='';
        public $patronymic='';
        public function validate(){
        if (!empty($this->lastname) &&
        !empty($this->firstname) &&
        !empty($this->patronymic)) {
        return true;
        }
        return false;
    }
}

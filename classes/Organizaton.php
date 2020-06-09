<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Organization
 *
 * @author Жан
 */

class Organization extends Table
{
    public $organization_id = 0;
    public $name = '';
    public $address = '';
    public $phone = '';
    public $email = '';
    public function validate()
    {
        if (!empty($this->name) && !empty($this->active)) {
            return true;
        }
        return false;

    }
}
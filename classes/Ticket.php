<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ticket
 *
 * @author Жан
 */

class Ticket extends Table
{
    public $ticket_id = 0;
    public $pin_id = '';
    public $organization_id = '';
    public function validate()
    {
        if (!empty($this->pin_id) && !empty($this->organization_id)) {
            return true;
        }
        return false;
    }
}
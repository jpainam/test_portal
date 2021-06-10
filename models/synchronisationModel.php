<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of synchronisationModel
 *
 * @author Paul
 */
class synchronisationModel extends Model{
    protected $_table = "synchronisations";
    protected $_key = "IDSYNCHRONISATION";
    
    public function __construct() {
        parent::__construct();
    }
}

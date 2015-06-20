<?php

/**
 * The User Model
 *
 * @author Faizan Ayubi
 */
class Member extends Shared\Model {

    /**
     * @column
     * @readwrite
     * @type integer
     * 
     * @validate required
     * @label team id
     */
    protected $_team_id;
    
    /**
     * @column
     * @readwrite
     * @type integer
     * 
     * @validate required
     * @label user id
     */
    protected $_user_id;   
}
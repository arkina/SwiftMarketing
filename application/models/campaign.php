<?php

/**
 * The User Model
 *
 * @author Faizan Ayubi
 */
class Campaign extends Shared\Model {

    /**
     * @column
     * @readwrite
     * @type text
     * @length 255
     * 
     * @validate required
     * @label title
     */
    protected $_title;

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

<?php

/**
 * Description of crm
 *
 * @author Faizan Ayubi
 */
class Lead extends Shared\Model {

    /**
     * @column
     * @readwrite
     * @type integer
     */
    protected $_user_id;

    /**
     * @column
     * @readwrite
     * @type text
     * @length 256
     */
    protected $_email;

    /**
     * @column
     * @readwrite
     * @type integer
     */
    protected $_campaign_id;

    /**
     * @column
     * @readwrite
     * @type text
     * @length 32
     */
    protected $_status;

    /**
     * @column
     * @readwrite
     * @type boolean
     */
    protected $_validity;

}

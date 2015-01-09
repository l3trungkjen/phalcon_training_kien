<?php
use \Phalcon\Mvc\Model\Message as Message;
use \Phalcon\Mvc\Model\Query\Builder;

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $username;

    /**
     *
     * @var string
     */
    public $password;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id',
            'username' => 'username',
            'password' => 'password'
        );
    }

    public function afterSave()
    {
        if (isset($this->flag) && $this->flag) {
            $redis = new Redis();
            $redis->connect('127.0.0.1', 6379);
            $redis->lPush('users', $this->id);
        }
    }

    public function afterDelete()
    {
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis->lRem('users', $this->id);
    }
}

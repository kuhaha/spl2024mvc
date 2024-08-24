<?php
namespace spl2024\models;

class User extends Model
{
    protected $table = "tbl_user";
    
    function auth($uid, $upass)
    {
        return $this->getDetail("uid='{$uid}' AND upass='{$upass}'");
    }
}

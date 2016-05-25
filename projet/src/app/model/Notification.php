<?php
namespace app\model;
/**
 * @property mixed IdTrajet
 */
class Notification extends \Illuminate\Database\Eloquent\Model
{
    //Attributs
    protected $table = 'notification';
    public $timestamps = false;
    protected $primaryKey = 'idNotification';


}
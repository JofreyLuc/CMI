<?php
namespace app\model;
/**
 * @property mixed IdTrajet
 */
class Suivi extends \Illuminate\Database\Eloquent\Model
{
    //Attributs
    protected $table = 'suivi';
    public $timestamps = false;
    protected $primaryKey = 'idSuivi';


}
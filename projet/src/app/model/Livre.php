<?php
namespace app\model;
/**
 * @property mixed IdTrajet
 */
class Livre extends \Illuminate\Database\Eloquent\Model
{
    //Attributs
    protected $table = 'livre';
    protected $primaryKey = 'idLivre';
    public $timestamps = false;

}
<?php
namespace app\model;
/**
 * @property mixed IdTrajet
 */
class Livre extends \Illuminate\Database\Eloquent\Model
{
    //Attributs
    protected $table = 'livre';
    protected $key = 'idLivre';
    public $timestamps = false;

}
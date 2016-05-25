<?php
namespace app\model;
/**
 * @property mixed IdTrajet
 */
class Bibliotheque extends \Illuminate\Database\Eloquent\Model
{
    //Attributs
    protected $table = 'bibliotheque';
    public $timestamps = false;
    protected $key = 'idBibliotheque';

}
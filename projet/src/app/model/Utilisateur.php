<?php
namespace app\model;
/**
 * @property mixed IdTrajet
 */
class Utilisateur extends \Illuminate\Database\Eloquent\Model
{
    //Attributs
    protected $table = 'utilisateur';
    protected $primaryKey = 'idUtilisateur';
    public $timestamps = false;
}
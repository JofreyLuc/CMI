<?php
namespace app\model;
/**
 * @property mixed IdTrajet
 */
class Evaluation extends \Illuminate\Database\Eloquent\Model
{
    //Attributs
    protected $table = 'evaluation';
    public $timestamps = false;
    protected $primaryKey = 'idEvaluation';

}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPost extends Model {

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tipo_posts';

     /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    public function posts()
    {
        return $this->hasMany('App\Post');
    }

}

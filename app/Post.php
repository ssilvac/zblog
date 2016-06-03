<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipo()
    {
        return $this->belongsTo(TipoPost::class);
    }
}

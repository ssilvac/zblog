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

    public $fillable = [
        'title',
        'description',
        'tipo_id',
        'imagen'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipo()
    {
        return $this->belongsTo(TipoPost::class);
    }

    public function scopeType($query, $type)
    {
        if ($type != '') {
            $query->where('tipo_id', $type);
        }
    }
}

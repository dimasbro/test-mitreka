<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class MenuItem extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'menu_items';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'url',
        'parent_id'
    ];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

}

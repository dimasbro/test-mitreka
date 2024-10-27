<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class RolePermission extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $timestamps = false;

    protected $table = 'role_permissions';

    protected $primaryKey = 'role_id';

    protected $fillable = [
        'role_id',
        'menu_item_id'
    ];

    public function menu_items()
    {
        return $this->belongsTo(MenuItem::class, 'menu_item_id', 'id');
    }

}

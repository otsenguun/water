<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    public function scopeWithWhere($query, $where = []) {
        foreach ($where as $key => $value) {
            if (!is_null($value)) {
                $query = $query->where('orders.' . $key, $value);
            }
        }
        return $query;
    }
    
}

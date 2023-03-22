<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'duureg',
        'status',
        'payment',
    ];

    public function scopeWithWhere($query, $where = []) {
        foreach ($where as $key => $value) {
            if (!is_null($value)) {
                $query = $query->where('orders.' . $key, $value);
            }
        }
        return $query;
    }

    public static function user($id){
        // $count = Order::where("d_user",$id)->where("d_date",$date)->count();
        $user = User::select("name")->where("id",$id)->get(1);
        if( count($user) == 0){
            $blank = new \stdclass();
            $blank->name = "Хоосон";
            return $blank;
        }
        return $user[0];
    }

    public function duureg(){
        // $count = Order::where("d_user",$id)->where("d_date",$date)->count();
        $array = [
            1 => "Баянзүрх",
            2 => "Баянгол",
            3 => "Сонгино хайрхан",
            4 => "Чингэлтэй",
            5 => "Сүхбаатар",
            6 => "Налайх",
            7 => "Хан-уул"
        ];
        return $array[$this->duureg];
    }

    public function status(){
        // $count = Order::where("d_user",$id)->where("d_date",$date)->count();
        $array = [
            0 => "Хүлээгдэж байна",
            1 => "Хүргэгдсэн",
            2 => "Цуцлагдсан"
        ];
        return $array[$this->status];
    }
    public function payment(){
        // $count = Order::where("d_user",$id)->where("d_date",$date)->count();
        $array = [
            0 => "Төлөгдөөгүй",
            1 => "Бэлэн",
            2 => "Данс",
            3 => "Дараа төлөх",
            4 => "Урьдчилсан"
        ];
        return $array[$this->payment];
    }


}

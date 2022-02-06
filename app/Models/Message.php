<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = [
        'security_code',
        'first_name',
        'last_name',
        'vaccine_name',
        'vaccinated_date',
        'age',
        'submitted',
    ];

    public static function getSecurityCode(){
        $randomNumber = rand(100000, 999999);
        $count = Message::where('security_code', $randomNumber)->count();
        if($count == 0){
            return $randomNumber;
        }else{
            do {
                $newRandomNumber = rand(100000, 999999);
                $newCount = Message::where('security_code', $newRandomNumber)->count();
            } while ($newCount != 0);

            return $newRandomNumber;
        }
    }
}

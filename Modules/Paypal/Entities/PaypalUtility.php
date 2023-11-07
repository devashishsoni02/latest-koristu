<?php

namespace Modules\Paypal\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use DB;

class PaypalUtility extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Paypal\Database\factories\PaypalUtilityFactory::new();
    }

    public static function invoice_payment_settings($id)
    {
        $data = [];

        $user = User::where(['id' => $id])->first();

        if(!is_null($user)){
            $data = DB::table('admin_payment_settings');
            $data->where('created_by', '=', $user->id);
            $data = $data->get();
        }

        $res = [];

        foreach ($data as $key => $value) {
            $res[$value->name] = $value->value;
        }

        return $res;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TraderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'comp_reg_no',
        'comp_name',
        'comp_address',
        'trader_name',
        'comp_description',
        'name',
        'phone_code',
        'phone_number',
        'phone_office',
        'email',
        'designation',
        'vat_reg',
        'vat_no',
        'vat_comp_name',
        'vat_comp_address',
        'contingency',
        'bnk_account_type',
        'bnk_account_name',
        'bnk_sort_code',
        'bnk_account_number',
        'builder_amendment',
        'noti_new_quotes',
        'noti_quote_accepted',
        'noti_project_stopped',
        'noti_quote_rejected',
        'noti_project_cancelled',
    ];

    
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}

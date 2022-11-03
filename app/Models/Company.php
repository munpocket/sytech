<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


// 会社情報
class Company extends Model
{
    //
    public function getList() {
        $companies = DB::table('companies') -> get();

        return $companies;
    }
}

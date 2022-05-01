<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Seller extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    protected $hidden = ['created_at', 'updated_at'];

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function getAll()
    {

        $sellers = Seller::select('sellers.*', DB::raw('IFNULL(SUM(sales.comission),0) As comission'))
         ->leftJoin('sales', 'sales.seller_id', '=', 'sellers.id')
         ->groupBy('sellers.id')
         ->get();

        return $sellers;
    }
}

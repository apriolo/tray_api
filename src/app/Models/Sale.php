<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['value', 'seller_id', 'comission'];

    protected $hidden = ['updated_at'];

    public function getComissionAttribute()
    {
        return number_format((float)$this->attributes['comission'], 2, '.', '');
    }

    public function getValueAttribute()
    {
        return number_format((float)$this->attributes['value'], 2, '.', '');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function getSalesBySeller($id)
    {

        $sales = Sale::select(
            'sales.id', 
            'sales.created_at as date', 
            'sales.value',
            'sales.comission',
            'sales.seller_id',
            'sellers.name',
            'sellers.email',
            )
         ->leftJoin('sellers', 'sales.seller_id', '=', 'sellers.id')
         ->where('sales.seller_id', $id)
         ->get();

        return $sales;
    }

    public function getSalesByDate($date)
    {
        $sales = Sale::select(
            'sales.id', 
            'sales.created_at as date', 
            'sales.value',
            'sales.comission',
            'sellers.name',
            'sellers.email',
            )
         ->join('sellers', 'sales.seller_id', '=', 'sellers.id')
         ->whereDate('sales.created_at', $date)
         ->get();

        return $sales;
    }
    
}

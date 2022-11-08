<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\Subtotal;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope(new Subtotal);
    }

    public function scopeBetweenDate($query, $startDate, $endDate)
    {
        if (is_null($startDate) && is_null($endDate)) {
            return $query;
        }
        if (!is_null($startDate) && is_null($endDate)) {
            return $query->where('created_at', '>=', $startDate);
        }

        if (is_null($startDate) && !is_null($endDate)) {
            $plusOneDayEndDate = Carbon::parse($endDate)->addDay(1);
            return $query->where('created_at', '<=', $plusOneDayEndDate);
        }

        if (!is_null($startDate) && !is_null($endDate)) {
            $plusOneDayEndDate = Carbon::parse($endDate)->addDay(1);
            return $query->where('created_at', ">=", $startDate)
                ->where('created_at', '<=', $plusOneDayEndDate);
        }
    }
}

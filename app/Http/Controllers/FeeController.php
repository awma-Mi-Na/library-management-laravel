<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function findLateFee(Borrowing $borrowing)
    {
        $now = now();
        $late_days = $borrowing->due_date->diffInDays($now, false);
        $late_fees = 0;
        if ($late_days > 0) {
            if ($late_days <= 10) {
                $late_fees += 2 * $late_days;
            } elseif ($late_days <= 20) {
                $late_days -= 10;
                $late_fees += 5 * $late_days + 20;
            } else {
                $late_days -= 20;
                $late_fees += 10 * $late_days + 70;
            }
        }
        return $late_fees;
    }
}

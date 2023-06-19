<?php

namespace App\Exports;

use App\Models\Rate;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class RatesExport implements FromView
{


    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $rates = Rate::with('assessment')->where(['user_id' => $this->id])->orderBy('date', 'desc')->get();
        return view('dashboard.exports.rate-history', compact('rates'));

    }
}

<?php

namespace App\Http\Livewire\Reports;

use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\UserSession;
use Livewire\Component;

class FinancialSessions extends Component
{
    public $to, $from, $user_id;

    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('date', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('date', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('date', '<=', $this->to);
        }
    }

    public function render()
    {
        $user_sessions = UserSession::where(function ($q) {
            $this->between($q);
            if ($this->user_id) {
                $q->where('user_id', $this->user_id);
            }
        })->latest()->paginate(10);

        $users = User::all();
        $payment_methods = PaymentMethod::where('is_cash', 0)->get();

        return view('livewire.reports.financial-sessions', compact('user_sessions', 'users', 'payment_methods'));
    }
}

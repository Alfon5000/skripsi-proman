<?php

namespace App\Livewire\Dashboard;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class GreetingUser extends Component
{
    public function render()
    {
        $hour = date('G');

        if ($hour < 12) {
            $time = 'Morning';
        } elseif ($hour < 17) {
            $time = 'Afternoon';
        } elseif ($hour < 22) {
            $time = 'Evening';
        } else {
            $time = 'Night';
        }

        $userName = explode(" ", Auth::user()->name)[0];

        $dateTime = Carbon::now()->format('l, F d, Y, H:i:s');

        return view('livewire.dashboard.greeting-user', compact(['time', 'userName', 'dateTime']));
    }
}

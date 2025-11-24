<?php



namespace App\Http\Controllers\Admin;


use Carbon\Carbon;

use App\Models\User;
use App\Models\Player;
use App\Models\Setting;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

    public function admin() { //calendar

        $players = Player::where("role", "player")->get();
        $reservations   = Reservation::all();
        $calendar = [];
        
        $oldestDate = Reservation::orderBy('date_slot', 'asc')->value('date_slot');

        
        $oldestCarbon = Carbon::parse($oldestDate);
        $year = $this->get_date($oldestCarbon);

        return view('admin.dashboard', compact('year','players'));

    }


}

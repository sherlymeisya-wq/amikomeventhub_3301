namespace App\Http\Controllers;

class EventController extends Controller
{
    public function show()
    {
        return view('katalog');
    }

    public function detail()
    {
        return view('event-detail');
    }

    public function checkout()
    {
        return view('checkout');
    }
}
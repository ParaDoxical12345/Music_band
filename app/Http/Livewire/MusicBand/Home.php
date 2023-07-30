<?php

namespace App\Http\Livewire\MusicBand;

use Livewire\Component;
use App\Models\Booking;
use App\Models\Musicband;
use App\Models\User;
use App\Models\Feedback;

use Illuminate\Support\Facades\Auth;


class Home extends Component
{
    public $bookings;
    public $bands;
    public $book;
    public $rating;
    public $feedback;
    public $users;


    public function viewBar($id)
    {
        $this->book = Booking::find($id);

    }

    public function completeBooking($id)
    {
        $user = Auth::user();
        $booking = Booking::findOrFail($id);
        $booking->status = 'Completed';
        $booking->save();

        $validatedData = $this->validate([
            'rating' => 'required|integer|between:1,5',
            'feedback' => 'required|string|max:255',
        ]);

        $userfeedback = new Feedback();
        $userfeedback->rating = $validatedData['rating'];
        $userfeedback->feedback = $validatedData['feedback'];
        $userfeedback->booking_id = $id;

        $user->feedbacks()->save($userfeedback);

        // Update the $bookings variable
        $this->bookings = Booking::whereIn('status', ['Pending', 'Completed'])->get();
        return redirect('/home');
    }


    public function cancelBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'Canceled';
        $booking->save();

        // Update the $bookings variable
        $this->bookings = Booking::whereIn('status', ['Pending', 'Completed'])->get();
        return redirect('/home');
    }

    public function getTransactionCount()
    {
        return Booking::where('status', 'Completed')->count();
    }

    public function mount()
    {
        $this->users = User::with('bookings')->get();
        $this->bookings = Booking::whereIn('status', ['Pending', 'Completed', 'Canceled'])->get();
    }

    public function render()
    {

        $active_bookings = Booking::whereIn('status', ['Pending', 'Completed'])->get();
        $total_bookings = Booking::whereIn('status', ['Pending', 'Completed', 'Canceled'])->get();

        $bands = Musicband::withCount(['bookings' => function ($query) {
            $query->whereIn('status', ['Pending', 'Completed', 'Canceled']);
        }])->get();
        $transaction_count = $this->getTransactionCount();

        $users = User::with('bookings')->get();

        return view('livewire.music-band.home', compact('active_bookings', 'total_bookings', 'bands', 'transaction_count', 'users'));
    }

    public function home(){
        return view('components.home');
    }
}

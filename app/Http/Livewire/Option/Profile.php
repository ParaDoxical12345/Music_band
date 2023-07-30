<?php

namespace App\Http\Livewire\Option;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;
use Livewire\WithFileUploads;

class Profile extends Component
{

    use WithFileUploads;

    public $image, $prof_name, $location, $descriptions, $user_edit_id;

    public function mount()
    {
        $user = auth()->user();
        $this->prof_name = $user->prof_name;
        $this->location = $user->location;
        $this->descriptions = $user->descriptions;

    }
    public function render()
    {


        // $user = auth()->user();
        // $this->prof_name = $user->prof_name;
        return view('livewire.option.profile');
    }

    public function profile(){
        return view('components.profile');
    }


    public function deleteUser()
    {
        $user = auth()->user();

        $user->delete();

        session()->flash('message', 'User deleted successfully.');

        return redirect('/');
    }


    public function editProfile()
    {
        $user = auth()->user();

        $this->validate([
            'prof_name' => 'required',
            'image' => 'nullable|image|max:1024',
        ]);

        $user->prof_name = $this->prof_name;
        $user->location = $this->location;
        $user->descriptions = $this->descriptions;

        if ($this->image) {
            $imageName = Carbon::now()->timestamp . '.' . $this->image->extension();
            $this->image->storeAs('image_uploads', $imageName);
            $user->image = $imageName;
        }

        $user->save();

        session()->flash('message', 'Profile updated successfully.');

        return redirect('/profile');
    }
}

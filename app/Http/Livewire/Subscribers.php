<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subscriber;

class Subscribers extends Component
{
    public $search = '';
    
    protected $queryString = [
        'search' => ['except' => ''] // remove from query string when $search is equal a ''
    ];
    
    public function render()
    {
        $subscribers = Subscriber::where('email', 'like', "%{$this->search}%")->get();

        return view('livewire.subscribers')->with([
            'subscribers' => $subscribers,
        ]);
    }

    public function delete(Subscriber $subscriber)
    {
        $subscriber->delete();
    }

}

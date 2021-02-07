<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subscriber;
use Livewire\WithPagination;

class Subscribers extends Component
{
    use WithPagination;

    public $search = '';
    public $itemsPerPage = 25;
    public $page = 1;
    public $orderBy = 'email';
    public $orderDirection = 'ASC';

    protected $perPageValues = [25, 50, 75, 100];

    protected $queryString = [
        'search' => ['except' => ''], // except, remove from query string when $search is equal a ''
        'itemsPerPage' => ['except' => 5],
        'page' => ['except' => 1],
    ];

    public function render()
    {
        // $subscribers = Subscriber::where('email', 'like', "%{$this->search}%")->get();
        $subscribers = Subscriber::where('email', 'like', "%{$this->search}%")
            ->orderBy($this->orderBy, $this->orderDirection)
            ->paginate($this->itemsPerPage)
            ->withPath('/dashboard/subscribers')
            ->withQueryString()
        ;
 //dd($subscribers);
        return view('livewire.subscribers')->with([
            'subscribers' => $subscribers,
            'perPageValues' => $this->perPageValues
        ]);
    }

    public function delete(Subscriber $subscriber)
    {
        $subscriber->delete();
    }

}

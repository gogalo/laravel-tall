<?php

namespace App\Http\Livewire;

use App\Models\Subscriber;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LandingPage extends Component
{
    
    public $email;
    protected $rules = [
        'email' => 'required|email:filter|unique:subscribers,email'
    ];


    public function subscribe()
    {

        /**
         * Validar
         *  
         * De no validar, laravel lanza una excepcion y automaticamente se devuelve la el resultado de la
         * metodo render
         */
        $this->validate(); 

        DB::transaction(function() {

            $subscriber = Subscriber::create([
                'email' => $this->email
            ]);
    
            $notification = new VerifyEmail;
    
            $subscriber->notify($notification);

        }, $deadlockRetries = 55);
        
        // Restablecer al valor establecido por defecto.
        $this->reset('email'); 
    }


    public function render()
    {
        return view('livewire.landing-page');
    }

}

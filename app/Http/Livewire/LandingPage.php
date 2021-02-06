<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\VerifyEmail;

class LandingPage extends Component
{
    
    public $email;
    public $showSubscribe = false;
    public $showSuccess = false;
    
    protected $rules = [
        'email' => 'required|email:filter|unique:subscribers,email'
    ];

    public function mount(Request $request) 
    {
        if($request->has('verified') && $request->verified == 1) {
            $this->showSuccess = true;
        }
    }
    
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

            $notification::createUrlUsing(function($notifiable) {
                return URL::temporarySignedRoute(
                    'subscribers.verify',
                    now()->addMinutes(30),
                    [
                        'subscriber' => $notifiable->getKey(),
                    ]
                );
            });
            
            $subscriber->notify($notification);

        }, $deadlockRetries = 5);
        
        // Restablecer al valor establecido por defecto.
        $this->reset('email');

        // ocultar formulario y mostrar el success
        $this->showSubscribe = false;
        $this->showSuccess = true;
    }


    public function render()
    {
        return view('livewire.landing-page');
    }

}

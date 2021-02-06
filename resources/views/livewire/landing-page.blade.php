
<div
    {{-- 
        mediante @entangle enlazamos las propiedades del componente de liveware y las propiedades de alpine, 
        ahora los valores se pueden establecer/modificar tambien desde el componente y no solo en la vista. 
    --}}
    x-data="{ 
        showSubscribe: @entangle('showSubscribe'),
        showSuccess: @entangle('showSuccess'),
    }" 
    class="flex flex-col bg-indigo-900 h-screen"
>

    <nav class="pt-5 flex justify-between container mx-auto text-indigo-200">

        <a href="/" class="text-4xl font-bold">
        
            <x-application-logo class="w-16 h-16 fill-current"></x-application-logo>
        
        </a>

        <div class="flex justify-end">

            @auth
                
                <a href="{{ route('dashboard') }}" class="">Dashboard</a>
            
            @else

                <a href="{{ route('login') }}" class="">Login</a>

            @endauth

        </div>

    </nav>

    <div class="flex container mx-auto items-center h-full">

        <div class="flex w-1/3 flex-col items-start">
        
            <h1 class="font-bold text-white text-5xl leading-tight mb-4">
            
                Simple generic landing page to subscribe
            
            </h1>

            <p class="text-indigo-200 text-xl mb-10">
            
                We are just checking the <a href="https://tallstack.dev/" target="_blank"><span class="font-bold underline">TALL</span></a> stack. Would yo mind subscribing?
            
            </p>

            <x-button x-on:click="showSubscribe = true" class="py-3 px-8 bg-red-500 hover:bg-red-600">

                Subscribe

            </x-button>
        
        </div>

    </div>

    <x-modal trigger="showSubscribe" class="bg-pink-500">
        
        <p class="text-white font-extrabold text-5xl text-center w-full">
            
            Let's do it!
        
        </p>

        <form class="flex flex-col items-center p-24" wire:submit.prevent="subscribe">

            <x-input wire:model="email" class="px-5 py-3 w-80 border border-blue-400" type="email" name="email" placeholder="Email address"></x-input>
            
            <span class="text-gray-100 text-xs mt-2 italic w-80">
            
                {{
                    $errors->has('email')
                    ? $errors->first('email')
                    : "We will send you a confirmation email."
                }}
                
            </span>
            
            <x-button class="px-5 py-3 mt-5 w-80 bg-blue-500 justify-center">

                Get In

            </x-button>

        </form>

    </x-modal>

    <x-modal trigger="showSuccess" class="bg-green-500">
        
        <p class="text-white font-extrabold text-9xl text-center w-full animate-pulse">
            
            &check;
        
        </p>

        <p class="text-white font-extrabold text-5xl text-center mt-4">

            Great!

        </p>

        @if (request()->has('verified') && request()->verified == 1)
            <p class="text-white text-3xl text-center">
                Thanks for confirming.
            </p>
        @else    
            <p class="text-white text-3xl text-center">
                See you in your inbox.
            </p>
        @endif
        
    </x-modal>

</div>

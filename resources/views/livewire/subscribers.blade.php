<div class="p-6 bg-white border-b border-gray-200">
    
    <x-input 
        type="text" 
        class=" rounded-lg border float-right border-gray-300 mb-4 w-1/3 pl-8" 
        placeholder="{{ __('Search') }}"
        wire:model="search"
    />

    @if ($subscribers->isEmpty())
        
        <div class="flex w-full bg-red-100 p-5 rounded-lg">
            
            <p class="text-red-400">
                
                {{ __('No subscribers found!') }}
            
            </p>
        
        </div>

    @else
        
        <table class="w-full">
        
            <thead class="border-b-2 border-gray-300 text-indigo-600">
                
                <tr>
                
                    <th class="px-6 py-3 text-left">{{ __('Email') }}</th>
                
                    <th class="px-6 py-3 text-left">{{ __('Verified') }}</th>
                    
                    <th class="px-6 py-3 text-left"></th>
                
                </tr>

            </thead>
            
            <tbody>

                @foreach ($subscribers as $subscriber)

                    <tr class="text-sm text-indigo-900 border-b border-gray-400 ">
                        
                        <td class="px-6 py-4">

                            {{ $subscriber->email }}

                        </td>
                        
                        <td class="px-6 py-4">

                            {{ optional($subscriber->email_verified_at)->diffForHumans() ?? __('Never') }}

                        </td>

                        <td>

                            <x-button 
                                class="border border-red-500 text-red-500 bg-red-50 hover:bg-red-100"
                                wire:click="delete({{ $subscriber->id }})"
                            >

                                {{ __('Delete') }}

                            </x-button>

                        </td>
                    
                    </tr>

                @endforeach

            </tbody>
            
            
        </table>


    @endif
    
</div>

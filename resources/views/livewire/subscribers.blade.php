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

                    <th class="px-4 py-1 text-left">{{ __('Email') }}</th>

                    <th class="px-4 py-1 text-left">{{ __('Verified') }}</th>

                    <th class="px-4 py-1 text-left"></th>

                </tr>

            </thead>

            <tbody>

                @foreach ($subscribers->items() as $subscriber)

                    <tr class="text-xs text-indigo-900 border-b border-gray-400 ">

                        <td class="px-4 py-1">

                            {{ $subscriber->email }}

                        </td>

                        <td class="px-4 py-1">

                            {{ optional($subscriber->email_verified_at)->diffForHumans() ?? __('Never') }}

                        </td>

                        <td class="px-4 py-1">

                            <button
                                class="py-1 px-2 border rounded border-red-500 text-red-500 bg-red-50 hover:bg-red-100"
                                wire:click="delete({{ $subscriber->id }})"
                            >

                                <span class="text-xs uppercase">{{ __('Delete') }}</span>

                            </button>

                        </td>

                    </tr>

                @endforeach

            </tbody>


        </table>

        <div class="flex flex-row w-full mt-5">

            <div class="flex flex-col w-full">
                {{ $subscribers->links() }}
            </div>

            <select
                class="flex flex-col rounded-lg border border-gray-300 ml-4"
                wire:model="itemsPerPage"
            >
                @foreach($perPageValues as $value)
                    <option value="{{$value}}">{{$value}}</option>
                @endforeach
            </select>

        </div>

    @endif

</div>

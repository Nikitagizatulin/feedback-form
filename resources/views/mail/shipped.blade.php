@component('mail::panel')
    User application № {{ $numberOfBid }}
@endcomponent
@component('mail::message')
- User id: {{ $userId }}<br/>
- Theme: {{ $themeBid }}<br/>
- Message: {{ $messageBid }}<br/>
@component('mail::button', ['url' => url('fbAll'),'color'=>'blue'])
All application
@endcomponent
Thanks,{{ config('app.name') }}
@endcomponent

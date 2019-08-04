@component('mail::message')

# Your payment method has been updated

Hey {{ ucfirst($user->name) }}, 

Please find a summary of the changes you've made below:

@component('mail::panel')
##Updated Payment Details
@component('mail::table')
|                         |                                            |
| ---------------------   | ------------------------------------------ |
| Payment info:            | <span style="color: black">.... .... .... {{ $user->card_last_four }}</span>|
| Email Address:          | <span class="link_text">{{ $user->email }}</span> |       
@endcomponent
@endcomponent

If this action was NOT carried by you, then urgently contact us on <span class="underline">support@hengft.com</span>.

Thanks

HengFT Team<br>

<a href="hengft.com" class="link_text">www.hengft.com</a>
@endcomponent
@component('mail::message')

# Your HengFT subscription has been resumed <br/>

Hi {{ $user->name }}, 

Please find your subscription details below: 

@component('mail::panel')
##Your New HengFT Membership
@component('mail::table')
|                         |                                            |
| ---------------------   | ------------------------------------------ |
| Subscription:           | <span style="color: black">£{{ $currentPlan[0]['amount'] / 100 }}  {{ lcfirst($currentPlan[0]['nickname']) }} </span>          |
| Email Address:          | <span class="link_text">{{ $user->email }}</span>                        |
| Payment info:           | <span style="color: black">.... .... .... {{ $user->card_last_four }}</span>                         |
|                         |                                            |
|                         |                                            |
|                         |                                            |
| <span class="text_green">Next Payment date:</span>|<span style="color: black">{{ $nextChargeDate }}</span>|
@endcomponent
@endcomponent

If you have any questions or need support, please contact us at <span class="underline">support@hengft.com</span>.
<br>

Thanks

The HengFT Team

@endcomponent
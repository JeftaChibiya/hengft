@component('mail::message')

#You have switched your HengFT subscription form {{ $previousPlan[0]['nickname'] }} to {{ $currentPlan[0]['nickname'] }} plan. <br/><br/>

Hi {{ $user->name }}, 

Please find additional details about your new subscription below: 

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

##**What else?**
For your subscription invoices, and other membership details, visit your user Settings page.

Please review our <a href="http://heng.com/terms-of-user">terms of use</a> to understand more about subscription changes on HengFT.

Cheers

HengFT Team<br>

<a href="hengft.com" class="link_text">www.hengft.com</a>

@endcomponent
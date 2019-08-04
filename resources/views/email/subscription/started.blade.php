@component('mail::message')

# Thanks for joining HengFT <br/>

Hi {{ ucfirst($user->name) }}, 

You’re all set to start making the most of your bets

@component('mail::button', ['url' => 'https://hengft.com/tips', 'color' => 'brandcolor'])
BROWSE TIPS
@endcomponent


Please find your subscription details below: 
@component('mail::panel')

##HengFT Football Tips Membership
@component('mail::table')
|                         |                                            |
| ---------------------   | ------------------------------------------ |
| Current Subscription:                  | <span style="color: black">{{ $currentPlan[0]['trial_period_days'] }} day trial</span> (ends {{ $trialEnds }}) |
| Amount due:            | £0.00 Today <span style="color: black">(£{{ $currentPlan[0]['amount'] / 100 }}  {{ lcfirst($currentPlan[0]['nickname']) }} after trial) </span>                       |
| Email Address:          | <span class="link_text">{{ $user->email }}</span> |
| Payment method:            | <span style="color: black">.... .... .... {{ $card->last4 }}</span>              |
|                           |           |
|                           |           |
|                           |           |
| <span class="text_green">Next Payment Date:</span> |  <span style="color: black">{{ $trialEnds }} (at £{{ $currentPlan[0]['amount'] / 100 }}  {{ lcfirst($currentPlan[0]['nickname']) }})</span>
@endcomponent
@endcomponent

An invoice for your subscription, along with other membership details will be displayed in your user settings page. <br/>

Please review our <a href="http://heng.com/terms-of-user">Terms Of Use</a> for subscriptions with HengFT.

Thanks

HengFT Team<br>

<a href="hengft.com" class="link_text">www.hengft.com</a>

@endcomponent
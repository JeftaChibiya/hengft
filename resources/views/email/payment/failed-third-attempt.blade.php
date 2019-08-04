@component('mail::message')

# Our third and final attempt to collect a payment has failed

Hi {{ $user->name }}, 
 
Please update your payment method urgently to avoid cancellation of your HengFT subscription. 
Since this is the last time we're making this attempt, your HengFT subscription may be suspended and eventually cancelled if 
the problem remains in the next coming days.

@component('mail::button', ['url' => 'https://hengft.com/settings/payment-details/edit', 'color' => 'brandcolor'])
UPDATE PAYMENT METHOD NOW
@endcomponent

If you need any help, visit our <a href="http://heng.com/help-center">Help Center</a> or 
contact us at <b>support@hengft.com</b>

Your friends at HengFT

@endcomponent
@component('mail::message')

# We're still having some trouble with your current payment method.

Hi {{ $user->name }}, 
 
You may want to update your payment method to avoid cancellation of your HengFT subscription. 
We will try again on <b>{{ $date }}</b>.

@component('mail::button', ['url' => 'https://hengft.com/settings/payment-details/edit', 'color' => 'brandcolor'])
UPDATE PAYMENT METHOD NOW
@endcomponent

If you need any help, visit our <a href="http://heng.com/help-center">Help Center</a> or 
contact us at <b>support@hengft.com</b>

Your friends at HengFT

@endcomponent
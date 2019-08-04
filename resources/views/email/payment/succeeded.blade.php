@component('mail::message')

# Your {{ $currentPlan[0]['nickname'] }} payment has been successfully processed.

Hi {{ $user->name }}, 

We successfully charged your payment method {{ strtoupper($user->card_brand) }} ending in {{ $user->card_last_four }}.

Thank you for addressing the issue

Your Friends at HengFT

@endcomponent
@component('mail::message')

# We're sad to see you go...

Hi {{ $user->name }},

You have requested to have your HengFT subscription cancelled. 

##**What happens next?**
As you have <b>{{ $timeLeft }} days</b> left on your {{ $currentPlan[0]['nickname'] }} subscription, your account will not be deactivated and removed from our system <b>until</b> 
the end of this period, on <b>{{ $nextChargeDate }}</b>.

You will not need to do anything until the date above as the cancellation of your account 
will be carried out automatically.

Please enjoy yourself in the meantime.

We will do our best to continue improving your experience on 
<a href="http://heng.com/support">hengft.com</a>.
<br>

The HengFT Team

@endcomponent
@component('mail::message')

# Your HengFT Account will be cancelled in 3 days

Hi {{ $user->name }},

You requested to have your HengFT subscription cancelled on {{ $endByDate }} 

##**What happens next?**

Do nothing until the date above, and the deletion of your account 
will be carried out automatically. However, if you wish to continue your membership, then please use the <b>Cancel</b> page in 
user Settings.


To let us know how we can help, visit our <a href="http://heng.com/help-center">Help Center</a> or 
contact us at <b>support@hengft.com</b>

The HengFT Team

@endcomponent
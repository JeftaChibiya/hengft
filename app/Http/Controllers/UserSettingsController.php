<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

/**  7 User Actions. See User Settings  */
class UserSettingsController extends Controller
{

    
    /**
     *   Ensure User is Authentheticated first
     * 
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);

    } 


    /** Index */

    public function index()
    {   

        $user = Auth::user();

        return view('settings.index', compact('user'));

    }  

    /** 
     * 
     *  user-settings notifcations, displayed with vue.js
     * 
     */
    public function delNotification(Request $request, $id){

        Auth::user()->notifications()->where('id', '=', $id)->delete();

        $request->session()->flash('flash', 'Notification Removed');

    }     

    /** 
     *  Update Account
     * 
     * 
     */
    public function updateAccount(Request $request){

        $user = Auth::user();

        $this->validate($request, [
            'name' => ['string', 'max:255'],            
            'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['string', 'min:8', 'confirmed'],            
        ]);           
        
        // Fill user model
        $user->only(['name' => $request['name'], 'email' => $request['email']]);       

        
        if($request->filled('password')){

            $user->password = Hash::make($request['password']);
        }
    
        $user->save();    
        
        $request->session()->flash('flash', 'Your changes have been saved');

    }     
    


    /** 
     *  Update Subscription plan
     * 
     * 
     */
    public function switchSubscription(Request $request, $id){

        $user = User::find($id);
        
        // user
        $user = $user->subscription('main')->swap($request->get('plan'));        
    
        $user->save();                     

        $request->session()->flash('flash', 'Your changes have been saved');                 

    } 

    
    /** 
     *  Update Payment details i.e card 
     * 
     * 
     */
    public function updatePaymentDetails(Request $request){

        $user = Auth::user();

        if ($user->hasCardOnFile()) {

            $token = request('stripeToken');
        
            $user->updateCard($token); // also update customer on stripe

            $user->updateCardFromStripe();                         
    
            $request->session()->flash('flash', 'Payment Method updated');  
        }               

    }  
       


     
    /**
     *  Cancel Free Trial or paid subscription
     * 
     * 
     */
    public function cancelSubscription(Request $request){

        $user = $request->user();     
        
        if($request->get('cancellation_reason')){
            CancellationReason::create([
                'cancellation_reason' => $request->get('cancellation_reason')
            ]); // save cancellation reason   
        }       

        // cancel instantly
        if($request->get('when') == 'now'){          

            $user->subscription('main')->cancelNow(); // cancel instantly                                                        

        }
        // cancel at the end of grace period using scheduler 
        else if($request->get('when') == 'later'){
           
            $user->subscription('main')->cancel();  // cancel later                        
                          
            $request->session()->flash('flash', 'Your request has been submitted');             

        }                          

    }  
    
    


    /** 
     *  Resume Subscription Immediately
     *  
     * 
     */
    public function resumeSubscription(Request $request){

        // if now
        $user = $request->user();

        // resume account on Stripe's end
        $user->subscription('main')->resume(); 
        
        // send email confirmation
        // Mail::to($request->user())->send(new ResumeSubscription($user));         
        
        // return flash         
        $request->session()->flash('flash', 'Resuming subscription...'); 

    }      
   
}
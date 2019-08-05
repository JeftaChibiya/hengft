<?php

namespace App\Http\Controllers\Auth;

/** Essential custom classes  */
use App\User;
use Carbon\Carbon;
use Stripe\Error\Card; // Stripe Card object
use App\LocalStripePlan;


/** Laravel classes  */
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    
    
    /**
     *  Inform users to confirm their email address
     *
     * @var string
     */
    protected $redirectTo = '/email/verify';

    
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    
    
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }


    /**
     *  Modified, includes Stripe / Laravel Cashierr functionality
     *  01/07/2019
     *  JC
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();                

        try {      

            event(new Registered($user = $this->create($request->all())));

            // stripe payment token from the request / card object
            $token = request('stripeToken');        
    
            // find corresponding subscription plan in Db
            $selectPlan = LocalStripePlan::find(request('plan')); 

            
            // create stripe user, start trial, no payment taken
            $user->newSubscription('main', $selectPlan->plan_id)
                    ->trialUntil(Carbon::now()->addDays($selectPlan->trial_period_days))               
                    ->create($token,['name' =>  $user->name, 'email' => $user->email
            ]);                         


            // login user
            $this->guard()->login($user);                       

            return $this->registered($request, $user) ?: redirect($this->redirectPath());       

        } 
        /** Errors related to selected plan or credentials */
        catch (Exception $e) {
            
            return back()->with($e->getMessage());

        }  
        /** Errors related to Stripe card */        
        catch (Card $e) {
            
            return back()->with($e->getJsonBody());         

        }                                 
    }    


    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        
        
        
    }

}
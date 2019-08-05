<?php

namespace App\Http\Controllers;

use App\Tip;
use App\Faq;
use Carbon\Carbon;
use App\InplayTip;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


// 30.07.2019
// JC
class PublicController extends Controller
{

    /**
     *  Main / landing page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $faqs = Faq::all();

        return view('site.index', compact('faqs'));

    }

    
    /** 
     *  return view only: pre-match tips 
     * 
     */    
    public function preMatchTips()
    {   

        return view('site.tips');

    }

    
    /** 
     *  return view only: inplay 
     * 
     */
    public function inplayTips()
    {   
        
        return view('site.inplay');

    } 
    

    /** 
     *  return view only: specials
     * 
     */    
    public function specials()
    {
        
        return view('site.specials');

    } 
    
    
    /** 
     *  Recently Cancelled Subscription
     *  Acknowoledgement
     * 
     */    
    public function postSubscriptionDeletion()
    {
        
        return view('site.what-now');

    }     


    /**   API    */


    //
    public function tipsAPI()
    {   

        $todaysTips = Tip::whereDate('created_at', Carbon::today())->get();

        return ['todaysTips' => $todaysTips];

    }


    // 
    public function inplayAPI()
    {   
        $inplaytips = Inplaytip::whereDate('created_at', Carbon::today())->get();

        return ['inplaytips' => $inplaytips];

    } 

}
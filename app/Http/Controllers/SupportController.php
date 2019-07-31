<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


// 30.07.2019
// JC
class SupportController extends Controller
{
    

    /** 
     *  Help Center
     * 
     */
    public function help()
    {
        
        return view('help');

    } 

    /** 
     *  Contact us
     * 
     */
    public function contact()
    {
        
        return view('contact');

    } 
    
        
    /**-------- Troubleshooting ------------ */

    //
    public function whatIsHengft()
    {
        
        return view('troubleshoot.about_hengft');

    }

    
    //
    public function aboutFreetrial()
    {
        
        return view('troubleshoot.free_trial');

    } 


    public function preMatchTipsNotVisible()
    {
        
        return view('troubleshoot.tips_unavailable');

    } 
    
    
    public function inplayTipsNotVisible()
    {
        
        return view('troubleshoot.inplaytips_unavailable');

    } 
    
    

    public function notReceivingHengFTEmails()
    {
        
        return view('troubleshoot.email_reception');

    } 

    

    public function accountRestricted()
    {
        
        return view('troubleshoot.account_restricted');

    } 


    
    public function accountCancelled()
    {
        
        return view('troubleshoot.account_cancelled');

    }     
}
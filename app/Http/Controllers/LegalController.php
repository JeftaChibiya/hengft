<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


// 30.07.2019
// JC
class LegalController extends Controller
{


    /** 
     *  Terms of Use
     * 
     */
    public function terms()
    {
        
        return view('legal.terms');

    }
    

    /** 
     *  Privacy polciy
     * 
     */    
    public function privacy()
    {
        
        return view('legal.privacy');

    }     
    
}

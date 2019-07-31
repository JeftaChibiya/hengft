<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;

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

}
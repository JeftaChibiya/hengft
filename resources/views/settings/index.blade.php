@extends('layouts.app')

@section('content')

<keep-alive>
<user-settings inline-template>
<div>

<div style="background: linear-gradient(180deg, rgb(23, 57, 147), rgb(45, 85, 151))">
      @include('partials.navbar_white')
    <div class="container mx-auto px-8 pb-8 sm:px-24 mt-8">
      <div class="pt-2 sm:pt-10 pb-1 mb-2 flex flex-row items-center">
          <div class="mr-6">
            <p class="font-bold text-gray-600 uppercase text-5xl"> {{ $user->name }} </p>
          </div>    
          <div>
            <p class="text-center text-lg font-light font-light text-gray-300"> 
                Since {{ $user->created_at->diffForHumans() }}
            </p>              
          </div>  
      </div>

        <!-- before & after trial period -->            
        <button v-if="today < trialEndDate.date || today > trialEndDate.date" 
                class="h-8 cursor-default focus:outline-none flex items-center sm:p-2 px-3 text-xs rounded-full"
                :class="[today < trialEndDate.date ? 'bg-orange-300 text-gray-700' : 'bg-blue-600 text-gray-100']">
            <svg class="mr-2 fill-current" :class="[today < trialEndDate.date ? 'text-gray-700' : 'text-gray-100']" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" class="mr-2"><path d="M6 23v-11c-4.036 0-6 2.715-6 5.5 0 2.807 1.995 5.5 6 5.5zm18-5.5c0-2.785-1.964-5.5-6-5.5v11c4.005 0 6-2.693 6-5.5zm-12-13.522c-3.879-.008-6.861 2.349-7.743 6.195-.751.145-1.479.385-2.161.716.629-5.501 4.319-9.889 9.904-9.889 5.589 0 9.29 4.389 9.916 9.896-.684-.334-1.415-.575-2.169-.721-.881-3.85-3.867-6.205-7.747-6.197zm-1.151 16.712l.786-4.788.803 3.446c.079.353.569.393.703.053l.727-1.858.678 1.582c.113.262.468.303.637.072l.618-.84h1.199v-.737h-1.391c-.117 0-.229.056-.298.151l-.342.469-.779-1.813c-.13-.303-.562-.296-.683.011l-.616 1.576-.95-4.208c-.09-.398-.659-.375-.724.022l-.788 4.86-.805-2.993c-.09-.357-.595-.377-.709-.023l-.598 1.948h-1.317v.737h1.607c.133 0 .278-.108.315-.235l.298-1.008.906 3.607c.099.389.659.363.723-.031z"/></svg>                
            <!-- trial ending date is later than today -->              
            <!-- trial period has ended & now on to paid -->  
            <span class="uppercase font-bold" v-text="displayCurrentPlan"></span>            
        </button>        
                  
    </div>                        
</div>


<!-- display on mobile - tablets -->
<div class="bg-gray-300">
      <div class="container mx-auto px-8 sm:px-24 py-4 sm:py-8 mb-4">
        <div class="flex flex-col">
          <div class="flex flex-wrap items-stretch w-full font-bold">                
              <router-link active-class="text-blue-400 border-blue-400" tag="div" class="mr-2 mb-2 p-2 slow-transition border border-gray-500 rounded-full text-xs text-gray-600 font-medium" to="/account/details/update" exact>
                <a>ACCOUNT</a>
              </router-link>
              <router-link active-class="text-blue-400 border-blue-400" tag="div" class="mr-2 mb-2 p-2 slow-transition border border-gray-500 rounded-full text-xs text-gray-600 font-medium" to="/billing/plan/update">
                <a>BILLING</a>
              </router-link>            
              
              <router-link active-class="text-blue-400 border-blue-400" tag="div" class="relative mr-2 mb-2 p-2 slow-transition border border-gray-500 rounded-full text-xs text-gray-600 font-medium" to="/subscription/notifications">
                <a>NOTIFICATIONS</a>
                <transition name="fade"> 
                </transition>                        
              </router-link>
              
              <router-link active-class="text-blue-400 border-blue-400" tag="div" class="mr-2 mb-2 p-2 slow-transition border border-gray-500 rounded-full text-xs text-gray-600 font-medium" to="/subscription/invoices">
                <a>INVOICES</a>
              </router-link>                    
              <router-link active-class="text-blue-400 border-blue-400" tag="div" class="mr-2 mb-2 p-2 slow-transition border border-gray-500 rounded-full text-xs text-gray-600 font-medium" to="/subscription/payment-method/update">
                <a>PAYMENTS DETAILS</a>
              </router-link>                                       
              <router-link active-class="text-blue-400 border-blue-400" tag="div" class="mr-2 mb-2 p-2 slow-transition border border-gray-500 rounded-full text-xs text-gray-600 font-medium" to="/subscription/cancel">
                <a>CANCEL</a>
              </router-link>                                      
          </div>
          </div>
        </div>
      </div>

      <!-- display content -->
      <div class="container mx-auto px-8 sm:px-24 py-4 mb-10">              
          <div class="w-full">
            <router-view :key="$route.fullPath"></router-view>          
          </div>
      </div> 
</div> 
</user-settings>
</keep-alive>
@endsection

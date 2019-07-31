@extends('layouts.docs')

@section('content')

<div class="container mx-auto px-16 pt-8">
    <div class="flex justify-between items-center">
        <div>
            <p class="text-4xl font-bold text-gray-700">Hengft.com</p>
        </div>
        <div class="flex flex-col">
            <div class="mr-3 text-2xl text-gray-500"><b>Invoice</b></div>

            <!-- invoice number -->
            <div class="flex flex-row mb-2">
                <div class="text-gray-700 mr-2">Invoice Number:</div>
                <div contenteditable>{{ $invoice->number }}</div>
            </div>
            <!-- date of issue -->
            <div class="flex flex-row">
                <div class="text-gray-700 mr-2">Date of issue:</div>
                <div contenteditable>{{ date('M d, Y', $invoice->created) }}</div>
            </div>
        </div>
    </div>

    <!-- from and to -->
    <div class="flex flex-row w-1/4 mt-8 mb-8">
        <div class="flex flex-col mr-10">
            <p class="text-xl font-bold">To:</p>
            <p class="text-lg font-bold text-gray-700" contenteditable>{{ $invoice->customer_name }}</p>
            <p class="text-lg font-light" contenteditable>{{ $invoice->customer_email }}</p>                
        </div>
        <div class="flex flex-col">
            <p class="text-xl font-bold">From:</p>
            <p class="text-lg font-bold text-gray-700" contenteditable>{{ $invoice->account_name }}</p>
            <p class="text-lg font-light" contenteditable>{{ $invoice->account_country }}</p>         
        </div> 
    </div> 
    
    <!-- service , quantity and amount charged -->
    <table style="border-collapse: collapse; width: 100%; " class="mb-8 table-auto text-left">            
        <tr class="text-gray-200 py-6" style="background-color: rgb(52, 80, 130)">
            <th class="text-lg" colspan="1">Qty</th>
            <th class="text-lg">Description</th>
            <th class="text-lg" colspan="3">Charge</th>                           
        </tr>
        <tr contenteditable>
            <td>{{ $invoice->lines->data[0]['quantity'] }}</td>
            <td>{{ $invoice->lines->data[0]['description'] }}</td>
            <td>£{{ $invoice->amount_paid }}.00</td>                                   
        </tr>
    </table>    

    <!-- total -->
    <div class="flex flex-row w-full items-center mb-6">
        <div class="font-bold text-xl mr-2">Total:</div>
        <div>£{{ $invoice->amount_paid }}.00</div>
    </div>

    <!-- notes  -->
    <div class="bg-gray-200 p-3 mb-10" contenteditable>
        <p class="font-bold text-lg">Notes</p>
        <p class="font-light text-xl">Thank You!</p>        
    </div>

    <p class="text-gray-600">If you have any questions, contact HengFT at <span class="underline text-blue-600">hengft2019@gmail.com</span></p>
</div>

@endsection
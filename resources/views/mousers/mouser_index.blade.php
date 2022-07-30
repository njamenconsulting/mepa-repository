<!-- resources/views/index.blade.php -->
 
@extends('layouts.app')


    @section('title', 'Mouser')
    
    
    @section('content')


        <div class="bg-light m-2 p-2">
            <h2 class="p-2 text-muted"> Mouser API</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Mouser</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                </ol>
            </nav>

            <div class="container-md">
                <h2>Summary about Mouser API service</h2>
                <p>The Search API service allows us to utilise Mouser's product data, availability, and pricing in our applications.</p>
                <h3>Features</h3>
                <ul>
                    <li>Search by Keyword Method</li>
                    <li>Search by Part Number Method</li>
                    <hr>
                    <li>Up to 50 results returned per call</li>
                    <li>Up to 30 calls per minute</li>
                    <li>Up to 1,000 calls per day</li>
                </ul>
                <h3>SearchApi</h3>
           </div>
    
  
        </div>

    @endsection

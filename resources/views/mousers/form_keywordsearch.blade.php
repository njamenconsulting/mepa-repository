<!-- resources/views/index.blade.php -->
 
@extends('layouts.app')


    @section('title', 'Mouser')
    
    
    @section('content')


        <div class="bg-light m-2 p-2">
        <h2 class="p-2 text-muted"> Keyword search</h2>
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Mouser</a></li>
                <li class="breadcrumb-item"><a href="#">keywordSearch</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
            </nav>

            <form action="{{ url('mouser/keywordSearch')}} " method ="POST">
            @csrf
            
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-4">
                        <label for="keyword" class="form-label text-muted fw-bold"> Keyword </label>
                        <select name="keyword" class="form-select form-select-sm">
                            <option value ="" selected>Choose...</option>
                            <option value ="Circuit Protection">Circuit Protection</option>
                            <option  value ="Electromechanical">Electromechanical</option>
                            <option value ="Embedded Solutions">Embedded Solutions</option>
                            <option  value ="Enclosures">Enclosures</option>
                            <option value ="Connectors">Connectors</option>
                            <option value ="Engineering Tools">Engineering Tools</option>
                            <option value ="Industrial Automation">Industrial Automation</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="records" class="form-label  text-muted fw-bold">Records:</label>
                        <input type="number" min="10" value="50" class="form-control  form-control-sm" name="records">
                    </div>
                    <div class="col-md-3">
                        <label for="startingRecord" class="form-label  text-muted fw-bold">Starting record</label>
                        <input type="number" min="1" value="1" class="form-control  form-control-sm" name="startingRecord">
                    </div>

                </div>
                <div class="row mt-1">

                    <div class="col-md-4">
                        <label for="searchOptions" class="form-label  text-muted fw-bold">Search option</label>
                        <select name="searchOptions" class="form-select form-select-sm">
                            <option value ="RohsAndInStock" selected>RohsAndInStock </option>
                            <option value ="None"> None </option>
                            <option value ="Rohs"> Rohs </option>
                            <option value ="InStock"> InStock </option>
                            <option value ="RohsAndInStock"> RohsAndInStock </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <fieldset class="row mb-2">
                            <legend class="col-form-label col-sm-4 pt-0  text-muted fw-bold">Version</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="version"  value="v1">
                                    <label class="form-check-label" for="version">
                                    Version V1
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="version"  value="v2" checked>
                                    <label class="form-check-label" for="version">
                                    Version V2
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-3">
                        <div class="row m-2">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </div>
                </div>

            </form>

        </div>
        @isset($parts)
        <div class="bg-warning m-2 p-2">
            <p class="lead"> Search Result: </p>
            <a class="btn btn-md btn-primary" href="#" role="button"> Download csv file &raquo;</a>
            <div style="overflow-x:auto">
            <table class="table  table-sm table-responsive caption-top table-bordered border-primary table-hover">
                <caption>Extracted fields for MEPA</caption>
                <thead  class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Availability</th>
                
                        <th scope="col">Description</th>
                        <th scope="col">Product image</th>
                        <th scope="col">Category</th>
                        <th scope="col">Manufacturer name</th>
                        <th scope="col">Manufacturer code</th>
                        <th scope="col">Price Breaks</th>
                        <th scope="col">Supplier code</th>
                   
                    </tr>
                </thead>
                <tbody>
                    
                    @for ($i = 0; $i < count($parts); $i++)
                    <tr>
                        <th scope="row">{{$i}}</th>
                        <td><input type="text" value="{{$parts[$i]['Availability']}}"></td>
                      
                        <td><textarea>{{$parts[$i]['Description']}}</textarea></td>
                        <td>
                            <div class="text-center">
                            <img src="{{$parts[$i]['productImage']}}" class="rounded" alt="...">
                            </div>
                            <textarea style="height:auto">{{$parts[$i]['productImage']}}</textarea>
                  
                        </td>
                        <td><textarea>{{$parts[$i]['Category']}}</textarea></td>
                        <td><textarea>{{$parts[$i]['manufacturerName']}}</textarea></td>
                        <td><textarea>{{$parts[$i]['manufacturerCode']}}</textarea></td>

                        <td>
                            @for ($j = 0; $j < count($parts[$i]['PriceBreaks']); $j++)
                            <input type="text" value="{{ $parts[$i]['PriceBreaks'][$j]['Quantity'] }}/{{ $parts[$i]['PriceBreaks'][$j]['Price']}}">

                                                   <hr> 
                            @endfor                         
                        </td>

                        <td><textarea>{{$parts[$i]['supplierCode']}}</textarea></td>
                
                    </tr>
                    @endfor
                    
                    
                </tbody>
            </table>  
            </div>    
        </div>
        @endisset
    @endsection

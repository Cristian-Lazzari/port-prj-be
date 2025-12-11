@extends('layouts.base')

@section('contents')
    

<div class="page_nav">
@php $type = [ 1 => 'Posto disabili', 2 => 'Emergienze'] @endphp

@if (session('message'))
    @php
        $message = session('message');
    @endphp
    <div class="alert-cont">
        <div class="alert alert-dismissible fade show notify_success" role="alert">
            {{$message}}
            <button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif


    <h1 class="my-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-plus-circle-fill mx-3" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
            </svg>
        Crea nuovo Slot
    </h1>
    <form action="{{ route('admin.slots.store') }}"  enctype="multipart/form-data"  method="POST">
        @csrf
        <section class="modal-body">
            <div class="top">
                <h2 id="cancelModalLabel">Aggiungi un imbarcazione</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="split">    
                <div>
                    <label class="label_c" for="name">
                        Nome
                    </label>
                    <p>
                        <input value="{{ old('name') }}" type="text" name="name" id="name" placeholder="Inserisci il nome">
                    </p>
                    @error('name') <p class="error">{{ $message }}</p> @enderror
                </div>  
                <div>
                    <label class="label_c w-100" for="price">
                        Tariffa 
                    </label>
                    <p>
                        <input class="w-100" value="{{ old('price') }}" type="text" name="price" id="price" placeholder="Inserisci il prezzo ">
                    </p>
                    @error('price') <p class="error">{{ $message }}</p> @enderror
                </div>            
                    
            </div>
            <div class="split">          
                <div>
                    <label class="label_c" for="loa">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-vertical" viewBox="0 0 16 16"><path d="M8.354 14.854a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 13.293V2.707L6.354 3.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 2.707v10.586l1.146-1.147a.5.5 0 0 1 .708.708z"/></svg> Loa:
                    </label>
                    <p>
                        <input value="{{ old('loa') }}" type="number" name="loa" id="loa" placeholder="Inserisci la LOA">
                    </p>
                    @error('loa') <p class="error">{{ $message }}</p> @enderror
                </div>        
                <div>
                    <label class="label_c" for="draft">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5M8 6a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 12.293V6.5A.5.5 0 0 1 8 6"/></svg> Draft:
                    </label>
                    <p>
                        <input value="{{ old('draft') }}" type="number" name="draft" id="draft" placeholder="Inserisci il pescaggio">
                    </p>
                    @error('draft') <p class="error">{{ $message }}</p> @enderror
                </div>        
            </div>
            <div class="split">          
                <div>
                    <label class="label_c" for="beam">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows" viewBox="0 0 16 16"><path d="M1.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L2.707 7.5h10.586l-1.147-1.146a.5.5 0 0 1 .708-.708l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L13.293 8.5H2.707l1.147 1.146a.5.5 0 0 1-.708.708z"/></svg> Beam:
                    </label>
                    <p>
                        <input value="{{ old('beam') }}" type="number" name="beam" id="beam" placeholder="Inserisci la larghezza">
                    </p>
                    @error('beam') <p class="error">{{ $message }}</p> @enderror
                </div>        
                <div>
                    <label class="label_c" for="type">
                        Tipologia
                    </label>
                    <p>
                        <select id="type" name="type" >                        
                            <option >Seleziona un opzione</option>
                            @foreach ($type as $k => $t)
                                <option value="{{ $k }}" >{{ $t }}</option>
                            @endforeach
                        </select>
                    </p>
                </div>        
            </div>

        </section>
        <div class="action_page">
            <button class="my_btn_3"  type="submit">Conferma</button>
            <button class="my_btn_2" name="add_new" value="1" type="submit">Conferma e creane un altro</button>
        </div>
    </form>
</div>



@endsection
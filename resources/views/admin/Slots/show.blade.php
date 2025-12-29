@extends('layouts.base')

@section('contents')
    
<div class="page_nav">

@php $type = [ 1 => 'Barca a motore', 2 => 'Barca a vela', 3 => 'Gommone'] @endphp
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

    <div class="view_box pt-5">
        <div class="central">
            <h1>Dettagli del cliente</h1>
        </div>
        <div class="box_container">
            <div class="box contact ">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
                        <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671"/>
                        <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791"/>
                    </svg>
                    <a href="mailto:{{$client->mail}}">{{$client->mail}}</a>

                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                    </svg>
                    <a href="tel:{{$client->phone}}">{{$client->phone}}</a>
                </div>
                
            </div>
            <div class="box personal">
                <p>
                    <strong>Nome</strong> <span>{{$client->name}}</span>
                </p>
                <p>
                    <strong>Cognome</strong> <span>{{$client->surname}}</span>
                </p>
            </div>
            <div class="box doc">
                <div>
                    <strong>Documenti</strong> 
                    @if ($client->certificate)
                        <a href="{{Storage::url($client->certificate)}}" target="_blank" rel="noopener noreferrer">Visualizza certificato</a>
                    @else
                        <span>Nessun documento caricato</span>
                    @endif
                </div>
            
                <div>
                    <strong>Note</strong> 
                    <p>
                        @if ($client->note)
                            {{$client->note}}
                        @else
                            Nessuna nota
                        @endif
                    </p>
                </div>
            </div>
        </div>
        @if(count($client->reservations))  
            <h2 class="mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ticket-perforated-fill" viewBox="0 0 16 16"><path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zm4-1v1h1v-1zm1 3v-1H4v1zm7 0v-1h-1v1zm-1-2h1v-1h-1zm-6 3H4v1h1zm7 1v-1h-1v1zm-7 1H4v1h1zm7 1v-1h-1v1zm-8 1v1h1v-1zm7 1h1v-1h-1z"/></svg>
                Prenotazioni fatte da <strong>{{$client->name}} {{$client->surnname}}</strong> </h2>
        @else
            <h2><strong>{{$client->name}} {{$client->surnname}}</strong> non ha prenotato nessuno slot</h2>
        @endif
        <div class="info_box_day">
            @foreach ($client->reservations as $r)
            @php
                $formatter = new IntlDateFormatter(
                    'it_IT',
                    IntlDateFormatter::NONE,
                    IntlDateFormatter::NONE,
                    null,
                    null,
                    'EEE dd MMM '
                );
            @endphp
            <div class="wrap_item">
                <div class="top">
                    <div class="name"></div>
                    <div class="boat">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M304 99.9L304 448L80 448C71.2 448 64 455.2 64 464C64 525.9 114.1 576 176 576L464 576C525.9 576 576 525.9 576 464C576 455.2 568.8 448 560 448L352 448L352 400L513.7 400C526.6 400 534.2 385.6 526.9 375L333.2 90.9C324.3 77.9 304 84.2 304 99.9zM256 384L256 199.8C256 183.7 235 177.7 226.4 191.3L111.3 375.5C104.6 386.2 112.3 400 124.9 400L240 400C248.8 400 256 392.8 256 384z"/></svg>
                        {{$r->boat->name}}</div>
                </div>
                <div class="item">
                    @if ($r->slot)
                        <div class="slot">{{$r->slot->name}}</div>
                    @else
                        <div class="slot">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4m.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/></svg>
                        </div>
                    @endif
                    <div class="date">
                        <p>Da <strong>{{$formatter->format($r->start_date)}}</strong></p>
                        <p>A <strong>{{$formatter->format($r->end_date)}}</strong></p>
                    </div>
                    <div class="status">confermata</div>
                    
                </div>
            </div>
            @endforeach
        </div>

        @if(count($client->boats))  
            <h2 class="mt-5">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M304 99.9L304 448L80 448C71.2 448 64 455.2 64 464C64 525.9 114.1 576 176 576L464 576C525.9 576 576 525.9 576 464C576 455.2 568.8 448 560 448L352 448L352 400L513.7 400C526.6 400 534.2 385.6 526.9 375L333.2 90.9C324.3 77.9 304 84.2 304 99.9zM256 384L256 199.8C256 183.7 235 177.7 226.4 191.3L111.3 375.5C104.6 386.2 112.3 400 124.9 400L240 400C248.8 400 256 392.8 256 384z"/></svg>
                Imbarcazioni di <strong>{{$client->name}} {{$client->surnname}}</strong> </h2>
        @else
            <h2><strong>{{$client->name}} {{$client->surnname}}</strong> non ha ancora registrato imbarcazioni</h2>
        @endif
        {{-- barche elenco --}}
        <div class="info_box_day">
            @foreach ($client->boats as $b)
            @php
                $formatter = new IntlDateFormatter(
                    'it_IT',
                    IntlDateFormatter::NONE,
                    IntlDateFormatter::NONE,
                    null,
                    null,
                    'EEE dd MMM'
                );
            @endphp
            <div class="wrap_item">
                <div class="top">
                    <div class="client">ID: {{$b->serial_code}}</div>
                    <div class="boat">{{$b->model}}</div>
                    <button class="my_btn_6 btn_delete" type="button" data-bs-toggle="modal" data-bs-target="#delete{{$b->id}}" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16"><path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/></svg>
                    </button>
                    <button class="my_btn_6" type="button" data-bs-toggle="modal" data-bs-target="#show{{$b->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/></svg>
                    </button>
                </div>
                <div class="item">
                    <div class="slot">{{$b->name}}</div>
                    <div class="date">
                        <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-vertical" viewBox="0 0 16 16"><path d="M8.354 14.854a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 13.293V2.707L6.354 3.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 2.707v10.586l1.146-1.147a.5.5 0 0 1 .708.708z"/></svg> Loa:  <strong>{{$b->loa}} cm</strong></p>
                        <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows" viewBox="0 0 16 16"><path d="M1.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L2.707 7.5h10.586l-1.147-1.146a.5.5 0 0 1 .708-.708l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L13.293 8.5H2.707l1.147 1.146a.5.5 0 0 1-.708.708z"/></svg> Beam: <strong>{{$b->beam}} cm</strong></p>
                        <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5M8 6a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 12.293V6.5A.5.5 0 0 1 8 6"/></svg> Draft: <strong>{{$b->draft}} cm</strong></p>
                    </div>
    
                    <div class="status">{{$type[$b->type]}}</div>
                    
                </div>
                
                <!-- delelete edit boat -->
                <div class="modal fade" id="delete{{$b->id}}" tabindex="-1" aria-labelledby="delete{{$b->id}}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered"  action="{{ route('admin.boats.store') }}"  enctype="multipart/form-data"  method="POST">
                        <div class="modal-content mymodal_make_res creation">
                            <form action="{{ route('admin.boats.destroy', $b) }}"  enctype="multipart/form-data"  method="POST">
                                @method('DELETE')
                                @csrf
                                <section class="modal-body">
                                    <div class="top">
                                        <h2></h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <h2 id="cancelModalLabel">Confermi l'eliminazione di "{{$b->name}}" ?</h2>
                                    <p>Una volta eliminata non sara più possibile recuperare i dati che riguardano l'imbarcazione comprese le prenotazione ad essa legate</p>
                                    <div class="actions">
                                        <button class="my_btn_2 btn_delete mb-3"  type="submit">Elimina</button>
                                    </div>
                                </section>
                            </form>
                        </div>
                    </div>
                </div>
              
                <!-- Modal edit boat -->
                <div class="modal fade" id="show{{$b->id}}" tabindex="-1" aria-labelledby="show{{$b->id}}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered"  action="{{ route('admin.boats.store') }}"  enctype="multipart/form-data"  method="POST">
                        <div class="modal-content mymodal_make_res creation">
                            <form action="{{ route('admin.boats.update', $b) }}"  enctype="multipart/form-data"  method="POST">
                                @method('PUT')
                                @csrf
                                <section class="modal-body">
                                    <div class="top">
                                        <h2 id="cancelModalLabel">Modifica "{{$b->name}}"</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="split">    
                                        <div>
                                            <label class="label_c" for="name">
                                                Nome
                                            </label>
                                            <p>
                                                <input value="{{ old('name', $b->name) }}" type="text" name="name" id="name" placeholder="Inserisci il nome">
                                            </p>
                                            @error('name') <p class="error">{{ $message }}</p> @enderror
                                        </div>  
                                        <div>
                                            <label class="label_c" for="model">
                                                Modello
                                            </label>
                                            <p>
                                                <input value="{{ old('model', $b->model) }}" type="text" name="model" id="model" placeholder="Inserisci il telefono">
                                            </p>
                                            @error('model') <p class="error">{{ $message }}</p> @enderror
                                        </div>      
                                        
                                    </div>
                                    <div class="split">          
                                        <div>
                                            <label class="label_c" for="loa">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-vertical" viewBox="0 0 16 16"><path d="M8.354 14.854a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 13.293V2.707L6.354 3.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 2.707v10.586l1.146-1.147a.5.5 0 0 1 .708.708z"/></svg> Loa:
                                            </label>
                                            <p>
                                                <input value="{{ old('loa', $b->loa) }}" type="number" name="loa" id="loa" placeholder="Inserisci la LOA">
                                            </p>
                                            @error('loa') <p class="error">{{ $message }}</p> @enderror
                                        </div>        
                                        <div>
                                            <label class="label_c" for="draft">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5M8 6a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 12.293V6.5A.5.5 0 0 1 8 6"/></svg> Draft:
                                            </label>
                                            <p>
                                                <input value="{{ old('draft', $b->draft) }}" type="number" name="draft" id="draft" placeholder="Inserisci il pescaggio">
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
                                                <input value="{{ old('beam', $b->beam) }}" type="number" name="beam" id="beam" placeholder="Inserisci la larghezza">
                                            </p>
                                            @error('beam') <p class="error">{{ $message }}</p> @enderror
                                        </div>        
                                        <div>
                                            <label class="label_c" for="type">
                                                Tipologia
                                            </label>
                                            <p>
                                                <select id="type" name="type" >                        
                                                    @foreach ($type as $k => $t)
                                                        <option value="{{ $k }}" @if ($b->type == $k) selected  @endif>{{ $t }}</option>
                                                    @endforeach
                                                </select>
                                                
                                            </p>
                                            @error('type') <p class="error">{{ $message }}</p> @enderror
                                        </div>        
                                    </div>
                                    <div class="p">                
                                        <div>
                                            <label class="label_c w-100" for="serial_code">
                                                N. immatricolazione 
                                            </label>
                                            <p>
                                                <input class="w-100" value="{{ old('serial_code', $b->serial_code) }}" type="text" name="serial_code" id="serial_code" placeholder="Inserisci il n. immatricolazione ">
                                            </p>
                                            @error('serial_code') <p class="error">{{ $message }}</p> @enderror
                                        </div>         
                                    </div>
                                    <div class="actions">
                                        <button class="my_btn_3 mb-3"  type="submit">Conferma</button>
                                    </div>
                                </section>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <button class="my_btn_5" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Aggiungi imbarcazione
        </button>

        <div class="more_info my-3" >
            <p>
                <strong>Creato il</strong> {{$client->created_at->format('d/m/Y')}},
                <strong>Aggiornato il</strong> {{$client->updated_at->format('d/m/Y')}}
            </p>
        </div>

        <div class="action_page">
            <a class="my_btn_7" href="{{ route('admin.clients.edit', $client) }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                </svg>
                Modifica
            </a>
            <button class="my_btn_2 btn_delete" type="button" data-bs-toggle="modal" data-bs-target="#exampleModaldelete">
                Elimina
            </button>

                
        </div>
        
        <!-- Modal add boat -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered"  action="{{ route('admin.boats.store') }}"  enctype="multipart/form-data"  method="POST">
                <div class="modal-content mymodal_make_res creation">
                    <form action="{{ route('admin.boats.store') }}"  enctype="multipart/form-data"  method="POST">
                        @method('POST')
                        @csrf
                        <input type="hidden" name="client_id" value="{{$client->id}}">
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
                                    <label class="label_c" for="model">
                                        Modello
                                    </label>
                                    <p>
                                        <input value="{{ old('model') }}" type="text" name="model" id="model" placeholder="Inserisci il telefono">
                                    </p>
                                    @error('model') <p class="error">{{ $message }}</p> @enderror
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
                                            @foreach ($type as $k => $t)
                                                <option value="{{ $k }}" >{{ $t }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </p>
                                    @error('type') <p class="error">{{ $message }}</p> @enderror
                                </div>        
                            </div>
                            <div class="p">                
                                <div>
                                    <label class="label_c w-100" for="serial_code">
                                        N. immatricolazione 
                                    </label>
                                    <p>
                                        <input class="w-100" value="{{ old('serial_code') }}" type="text" name="serial_code" id="serial_code" placeholder="Inserisci il n. immatricolazione ">
                                    </p>
                                    @error('serial_code') <p class="error">{{ $message }}</p> @enderror
                                </div>         
                            </div>
                            <div class="actions">
                                <button class="my_btn_3 mb-3"  type="submit">Conferma</button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModaldelete" tabindex="-1" aria-labelledby="exampleModaldeleteLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn_close mb-3" data-bs-dismiss="modal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-90deg-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.146 4.854a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H12.5A2.5 2.5 0 0 1 15 6.5v8a.5.5 0 0 1-1 0v-8A1.5 1.5 0 0 0 12.5 5H2.707l3.147 3.146a.5.5 0 1 1-.708.708z"/>
                            </svg>
                        </button>
                        <h3>Sei sicuro di voler eliminare il Cliente "{{$client->name}}" ?</h3>
                        <form class="w-100" action="{{ route('admin.clients.destroy', ['client'=>$client]) }}" method="post" >
                            @method('delete')
                            @csrf
                            <button class="my_btn_1 btn_delete m-auto" type="submit">Elimina</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>
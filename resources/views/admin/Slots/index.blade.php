@extends('layouts.base')

@section('contents')
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
<div class="page_nav">

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

    <h1 class="pt-5">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-people-fill mx-3" viewBox="0 0 16 16">
        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
        </svg>
        Disposizione portuale
    </h1>
        

    <div class="floating">
        <div class="int">
            <a class="my_btn_3 gap-2" href="{{route('admin.slots.create')}}"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                </svg> NUOVO SLOT
            </a>
        </div>
    </div>
    <div class="filters">
        <div class="bar">
            <input type="checkbox" class="check" id="f">
            <div class="box">
                <input name="date" type="date" value="{{$time_filter}}" class="search">
            </div>

            <label for="f">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-funnel-fill" viewBox="0 0 16 16">
                    <path
                        d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-funnel" viewBox="0 0 16 16">
                    <path
                        d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z" />
                </svg>
            </label>
        </div>
    </div>
    <div class="map_toolbar">
        <button type="button" id="zoom-in">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M352 128C352 110.3 337.7 96 320 96C302.3 96 288 110.3 288 128L288 288L128 288C110.3 288 96 302.3 96 320C96 337.7 110.3 352 128 352L288 352L288 512C288 529.7 302.3 544 320 544C337.7 544 352 529.7 352 512L352 352L512 352C529.7 352 544 337.7 544 320C544 302.3 529.7 288 512 288L352 288L352 128z"/></svg>
        </button>
        <button type="button" id="zoom-out">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M96 320C96 302.3 110.3 288 128 288L512 288C529.7 288 544 302.3 544 320C544 337.7 529.7 352 512 352L128 352C110.3 352 96 337.7 96 320z"/></svg>
        </button>
    </div>
        @php

            $now = now();
        @endphp
    <div id="map-wrapper">

        <div id="map-viewport">
            <div id="map">
                <img id="map-bg" src="https://db.losbarqueros-castro.it/public/mappa-porto.jpg" alt="Mappa porto">
                {{-- barche --}}
                @foreach($slots as $s)
                    @php
                        $isOccupied = $s->reservations->contains(function ($reservation) use ($now) {
                            return $now->between(
                                $reservation->start_date->startOfDay(),
                                $reservation->end_date->startOfDay()
                            );
                        });
                    @endphp
                    <div 
                       
                        class="boat {{ $isOccupied ? 'on' : '' }}"
                        data-slot-id="{{ $s->id }}"
                        data-reservations='@json(
                            $s->reservations->map(fn($r) => [
                                "start" => $r->start_date,
                                "end"   => $r->end_date
                            ])
                        )'
                        data-x="{{ $s->pos_x }}"
                        data-y="{{ $s->pos_y }}"
                        data-w="{{ $s->beam / 7 }}"
                        data-h="{{ $s->loa / 7 }}"
                        data-rotation="{{ $s->rotation }}"
                    >
                        @if ($isOccupied )
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M304 99.9L304 448L80 448C71.2 448 64 455.2 64 464C64 525.9 114.1 576 176 576L464 576C525.9 576 576 525.9 576 464C576 455.2 568.8 448 560 448L352 448L352 400L513.7 400C526.6 400 534.2 385.6 526.9 375L333.2 90.9C324.3 77.9 304 84.2 304 99.9zM256 384L256 199.8C256 183.7 235 177.7 226.4 191.3L111.3 375.5C104.6 386.2 112.3 400 124.9 400L240 400C248.8 400 256 392.8 256 384z"/></svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M320 128C302.3 128 288 142.3 288 160C288 177.7 302.3 192 320 192C337.7 192 352 177.7 352 160C352 142.3 337.7 128 320 128zM224 160C224 107 267 64 320 64C373 64 416 107 416 160C416 201.8 389.3 237.4 352 250.5L352 508.4C414.9 494.1 462.2 438.7 463.9 371.9L447.8 386C437.8 394.7 422.7 393.7 413.9 383.7C405.1 373.7 406.2 358.6 416.2 349.8L480.2 293.8C489.2 285.9 502.8 285.9 511.8 293.8L575.8 349.8C585.8 358.5 586.8 373.7 578.1 383.7C569.4 393.7 554.2 394.7 544.2 386L528 371.9C525.9 485 433.6 576 320 576C206.4 576 114.1 485 112 371.9L95.8 386.1C85.8 394.8 70.7 393.8 61.9 383.8C53.1 373.8 54.2 358.7 64.2 349.9L128.2 293.9C137.2 286 150.8 286 159.8 293.9L223.8 349.9C233.8 358.6 234.8 373.8 226.1 383.8C217.4 393.8 202.2 394.8 192.2 386.1L176.1 372C177.9 438.8 225.2 494.2 288 508.5L288 250.6C250.7 237.4 224 201.9 224 160.1z"/></svg>
                        @endif
                        
                        <span>{{ $s->name }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="info_box_day">
        <div class="box">
            @foreach ($slots as $r)
                <div 
                    id="slot-{{ $r->id }}"
                    class="item"
                    data-slotid="{{ $r->id }}"
                    data-reservations='@json(
                        $r->reservations->map(fn($i) => [
                            "boat"  => $i->boat->name,
                            "start" => $i->start_date,
                            "end"   => $i->end_date
                        ])
                    )'
                >
                    <div class="slot">
                        {{$r->name}}
                        @if ($r->type == 1)
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-wheelchair" viewBox="0 0 16 16"><path d="M12 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3m-.663 2.146a1.5 1.5 0 0 0-.47-2.115l-2.5-1.508a1.5 1.5 0 0 0-1.676.086l-2.329 1.75a.866.866 0 0 0 1.051 1.375L7.361 3.37l.922.71-2.038 2.445A4.73 4.73 0 0 0 2.628 7.67l1.064 1.065a3.25 3.25 0 0 1 4.574 4.574l1.064 1.063a4.73 4.73 0 0 0 1.09-3.998l1.043-.292-.187 2.991a.872.872 0 1 0 1.741.098l.206-4.121A1 1 0 0 0 12.224 8h-2.79zM3.023 9.48a3.25 3.25 0 0 0 4.496 4.496l1.077 1.077a4.75 4.75 0 0 1-6.65-6.65z"/></svg>
                        @elseif($r->type == 2)
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M96 96C60.7 96 32 124.7 32 160L32 448C32 483.3 60.7 512 96 512L99.3 512C109.7 548.9 143.7 576 184 576C224.3 576 258.2 548.9 268.7 512L371.3 512C381.7 548.9 415.7 576 456 576C496.3 576 530.2 548.9 540.7 512L544 512C579.3 512 608 483.3 608 448L608 301.3C608 284.3 601.3 268 589.3 256L544 210.7C532 198.7 515.7 192 498.7 192L448 192L448 160C448 124.7 419.3 96 384 96L96 96zM544 301.3L544 352L448 352L448 256L498.7 256L544 301.3zM184 448C206.1 448 224 465.9 224 488C224 510.1 206.1 528 184 528C161.9 528 144 510.1 144 488C144 465.9 161.9 448 184 448zM416 488C416 465.9 433.9 448 456 448C478.1 448 496 465.9 496 488C496 510.1 478.1 528 456 528C433.9 528 416 510.1 416 488zM208 200C208 191.2 215.2 184 224 184L256 184C264.8 184 272 191.2 272 200L272 240L312 240C320.8 240 328 247.2 328 256L328 288C328 296.8 320.8 304 312 304L272 304L272 344C272 352.8 264.8 360 256 360L224 360C215.2 360 208 352.8 208 344L208 304L168 304C159.2 304 152 296.8 152 288L152 256C152 247.2 159.2 240 168 240L208 240L208 200z"/></svg>
                        @endif
                    </div>
                    <div class="slot-status ">
                        @php
                            $check = false;
                        @endphp
                        @foreach ($r->reservations as $i)
                            @if ($i->start_date->startOfDay() <= $now && $i->end_date->startOfDay() >= $now)
                                <div class="count">
                                    <span>
                                        {{count($r->reservations)}}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                                    </svg>
                                </div>
                                <button class=" btn_delete status" type="button" data-bs-toggle="modal" data-bs-target="#rs{{$r->id}}" >
                                    {{$i->boat->name}}
                                </button>
                                @php $check = true; @endphp
                            @endif
                        @endforeach
                        @if (!$check)
                            @if (count($r->reservations) !== 0)
                                <div class="count">
                                    <span>
                                        {{count($r->reservations)}}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                                    </svg>
                                </div>
                                <button class="status" type="button" data-bs-toggle="modal" data-bs-target="#rs{{$r->id}}" >
                                    Disponibile 
                                </button>
                            @else
                                <button class="status op" type="button">
                                    Disponibile
                                </button>    
                            @endif
                        @endif
                    </div>
                    
                    <div class="actions">
                        <a href="{{route('admin.slots.edit', $r)}}" class="edit">
                            {{-- icona matita --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                        </a>
                    </div>                
                </div>
                <div class="modal fade" id="rs{{$r->id}}" tabindex="-1" aria-labelledby="rs{{$r->id}}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered"  action="{{ route('admin.boats.store') }}"  enctype="multipart/form-data"  method="POST">
                        <div class="modal-content mymodal_make_res creation">
                            <section class="modal-body">
                                <div class="top">
                                    <h2>Prenotazioni</h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="info_box_day">
                                    @foreach ($r->reservations as $i)
                                    <div class="item">
                                        <div class="date">
                                            <p><strong>{{$i->client->name}}</strong></p>
                                            <p>{{$i->boat->name}}</p>
                                        </div>
                                        <div class="date">

                                            <p>Da <strong>{{$formatter->format($i->start_date)}}</strong></p>
                                            <p>A &nbsp; <strong>{{$formatter->format($i->end_date)}}</strong></p>
                                        </div>
                                        @if ($i->start_date <= $now && $i->end_date >= $now)
                                            <div class="status">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16"><path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/></svg>
                                                Attuale
                                            </div>
                                        @elseif( $i->end_date < $now )
                                            <div class="status op">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-bottom" viewBox="0 0 16 16"><path d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5m2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702s.18.149.5.149.5-.15.5-.15v-.7c0-.701.478-1.236 1.011-1.492A3.5 3.5 0 0 0 11.5 3V2z"/></svg>
                                                Passata
                                            </div> 
                                        @else
                                            <div class="status ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-top" viewBox="0 0 16 16">  <path d="M2 14.5a.5.5 0 0 0 .5.5h11a.5.5 0 1 0 0-1h-1v-1a4.5 4.5 0 0 0-2.557-4.06c-.29-.139-.443-.377-.443-.59v-.7c0-.213.154-.451.443-.59A4.5 4.5 0 0 0 12.5 3V2h1a.5.5 0 0 0 0-1h-11a.5.5 0 0 0 0 1h1v1a4.5 4.5 0 0 0 2.557 4.06c.29.139.443.377.443.59v.7c0 .213-.154.451-.443.59A4.5 4.5 0 0 0 3.5 13v1h-1a.5.5 0 0 0-.5.5m2.5-.5v-1a3.5 3.5 0 0 1 1.989-3.158c.533-.256 1.011-.79 1.011-1.491v-.702s.18.101.5.101.5-.1.5-.1v.7c0 .701.478 1.236 1.011 1.492A3.5 3.5 0 0 1 11.5 13v1z"/></svg>
                                                Futura
                                            </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>

                               
                            </section>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
    </div>

</div>


<script>
/* ======================
   CONFIGURAZIONE
====================== */
const SCALE = 10; // 1 metro = 10px

let map = document.getElementById('map');


let zoom = 0.3;
const ZOOM_STEP = 0.02;
const MIN_ZOOM = 0.22;
const MAX_ZOOM = 2.1;

// dimensioni REALI della mappa (uguali all’immagine)
const BASE_MAP_WIDTH  = 3811;
const BASE_MAP_HEIGHT = 2212;


/* =========================
   CACHE BARCHE
========================= */
const boats = [...document.querySelectorAll('.boat')].map(el => ({
    el,
    x: parseFloat(el.dataset.x),
    y: parseFloat(el.dataset.y),
    w: parseFloat(el.dataset.w),
    h: parseFloat(el.dataset.h),
    r: parseFloat(el.dataset.rotation)
}));



/* =========================
   RENDER ENGINE
========================= */
let needsRender = true;

function render() {
    if (!needsRender) return;

    // ridimensiona mappa + sfondo
    map.style.width  = (BASE_MAP_WIDTH * zoom) + 'px';
    map.style.height = (BASE_MAP_HEIGHT * zoom) + 'px';

    for (const b of boats) {
        b.el.style.left   = (b.x * zoom) + 'px';
        b.el.style.top    = (b.y * zoom) + 'px';
        b.el.style.width  = (b.w * zoom) + 'px';
        b.el.style.height = (b.h * zoom) + 'px';
        b.el.style.transform = `rotate(${b.r}deg)`;
    }

    needsRender = false;
}

function requestRender() {
    if (!needsRender) {
        needsRender = true;
        requestAnimationFrame(render);
    }
}

render();

/* =========================
   ZOOM
========================= */
document.getElementById('zoom-in').onclick = () => {
    zoom = Math.min(MAX_ZOOM, zoom + ZOOM_STEP);
    console.log(zoom)
    requestRender();
};

document.getElementById('zoom-out').onclick = () => {
    zoom = Math.max(MIN_ZOOM, zoom - ZOOM_STEP);
    requestRender();
};

document.addEventListener('DOMContentLoaded', () => {

    const dateInput = document.querySelector('input[name="date"]');
    if (!dateInput) return;

    const boats = document.querySelectorAll('.boat');
    const slots = document.querySelectorAll('.item');
    /* ======================
    HOVER SINCRONIZZATO
    ====================== */

    function highlight(slotId) {
        document
            .querySelectorAll(
                `.boat[data-slot-id="${slotId}"], .item[data-slotid="${slotId}"]`
            )
            .forEach(el => el.classList.add('hover-sync'));
    }

    function removeHighlight(slotId) {
        document
            .querySelectorAll(
                `.boat[data-slot-id="${slotId}"], .item[data-slotid="${slotId}"]`
            )
            .forEach(el => el.classList.remove('hover-sync'));
    }

    /* hover sulle barche */
    boats.forEach(boat => {
        const slotId = boat.dataset.slotId;

        boat.addEventListener('mouseenter', () => highlight(slotId));
        boat.addEventListener('mouseleave', () => removeHighlight(slotId));
    });

    /* hover sugli slot */
    slots.forEach(slot => {
        const slotId = slot.dataset.slotid;

        slot.addEventListener('mouseenter', () => highlight(slotId));
        slot.addEventListener('mouseleave', () => removeHighlight(slotId));
    });
    // /* rimuovo selezione precedente barche */
    // document
    //     .querySelectorAll('.boat.selected-boat')
    //     .forEach(el => el.classList.remove('selected-boat'));

    // /* seleziono la barca cliccata */
    // boat.classList.add('selected-boat');

    boats.forEach(boat => {
        boat.addEventListener('click', e => {
            e.preventDefault();

            const slotId = boat.dataset.slotId;
            const target = document.getElementById(`slot-${slotId}`);

            if (!target) return;

            /* rimuovo selezione precedente */
            document
                .querySelectorAll('.item.selected-slot')
                .forEach(el => el.classList.remove('selected-slot'));

            /* aggiungo selezione allo slot corrente */
            target.classList.add('selected-slot');

            /* scroll allo slot */
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        });
    });



    function isOccupied(reservations, selectedDate) {
        return reservations.some(r => {
            const start = new Date(r.start).setHours(0, 0, 0, 0);
            const end   = new Date(r.end).setHours(0, 0, 0, 0);
            return selectedDate >= start && selectedDate <= end;
        });
    }

    function updateUI(selectedDate) {

        /* ===== MAPPA ===== */
        boats.forEach(boat => {
            const reservations = JSON.parse(boat.dataset.reservations || '[]');

            if (isOccupied(reservations, selectedDate)) {
                boat.classList.add('on');
            } else {
                boat.classList.remove('on');
            }
        });

        /* ===== LISTA SLOT ===== */
        slots.forEach(slot => {
            const reservations = JSON.parse(slot.dataset.reservations || '[]');
            const statusBox = slot.querySelector('.slot-status');

            if (!statusBox) return;

            const active = reservations.find(r => {
                const start = new Date(r.start).setHours(0, 0, 0, 0);
                const end   = new Date(r.end).setHours(0, 0, 0, 0);

                return selectedDate >= start && selectedDate <= end;
            });

            if (active) {
                statusBox.innerHTML = `
                    <div class="count">
                        <span>
                            ${reservations.length}
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                            <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                        </svg>
                    </div>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#rs${slot.dataset.slotid}" class="btn_delete status">
                        ${active.boat}
                    </button>
                `;
            } else if (reservations.length > 0) {
                statusBox.innerHTML = `
                    <div class="count">
                        <span>
                            ${reservations.length}
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                            <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                        </svg>
                    </div>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#rs${slot.dataset.slotid}" class="status">
                        Disponibile
                    </button>
                `;
            } else {
                statusBox.innerHTML = `
                    <button class="status op">Disponibile</button>
                `;
            }
        });
    }

    /* EVENTO */
    dateInput.addEventListener('change', () => {
        const selectedDate = new Date(dateInput.value);
        if (isNaN(selectedDate)) return;

        updateUI(selectedDate);
    });

});
</script>

@endsection


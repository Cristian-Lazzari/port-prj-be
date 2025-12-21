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
                </svg> NUOVO SlOT
            </a>
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
    <div id="map-wrapper">
        <div id="map-wrapper">
            <div id="map-viewport">
                <div id="map">

                    {{-- barche --}}
                    @foreach($slots as $s)
                        <div class="boat"
                            style="
                                left: {{ $s->pos_x }}px;
                                top: {{ $s->pos_y }}px;
                                width: {{ $s->beam / 5}}px;
                                height: {{ $s->loa / 5}}px;
                                transform: rotate({{ $s->rotation }}deg);
                            ">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M304 99.9L304 448L80 448C71.2 448 64 455.2 64 464C64 525.9 114.1 576 176 576L464 576C525.9 576 576 525.9 576 464C576 455.2 568.8 448 560 448L352 448L352 400L513.7 400C526.6 400 534.2 385.6 526.9 375L333.2 90.9C324.3 77.9 304 84.2 304 99.9zM256 384L256 199.8C256 183.7 235 177.7 226.4 191.3L111.3 375.5C104.6 386.2 112.3 400 124.9 400L240 400C248.8 400 256 392.8 256 384z"/></svg>
                            <span>{{ $s->name }}</span>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        
    </div>
    <div class="info_box_day">
        <div class="box">
            @foreach ($slots as $r)
                <div class="item">
           
                    
                    <div class="slot">
                        {{$r->name}}
                        @if ($r->type == 1)
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-wheelchair" viewBox="0 0 16 16"><path d="M12 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3m-.663 2.146a1.5 1.5 0 0 0-.47-2.115l-2.5-1.508a1.5 1.5 0 0 0-1.676.086l-2.329 1.75a.866.866 0 0 0 1.051 1.375L7.361 3.37l.922.71-2.038 2.445A4.73 4.73 0 0 0 2.628 7.67l1.064 1.065a3.25 3.25 0 0 1 4.574 4.574l1.064 1.063a4.73 4.73 0 0 0 1.09-3.998l1.043-.292-.187 2.991a.872.872 0 1 0 1.741.098l.206-4.121A1 1 0 0 0 12.224 8h-2.79zM3.023 9.48a3.25 3.25 0 0 0 4.496 4.496l1.077 1.077a4.75 4.75 0 0 1-6.65-6.65z"/></svg>
                        @endif
                    </div>
                    @php
                        $check = false;
                    @endphp
                    @foreach ($r->reservations as $i)
                        @if ($i->start_date <= now() && $i->end_date >= now())
                            <button class=" btn_delete status" type="button" data-bs-toggle="modal" data-bs-target="#rs{{$r->id}}" >
                                {{$i->boat->name}}
                            </button>
                            @php $check = true; @endphp
                        @endif
                    @endforeach
                    @if (!$check)

                        <button class="status" type="button" data-bs-toggle="modal" data-bs-target="#rs{{$r->id}}" >
                            Disponibile
                        </button>

                    @endif
                    <div class="actions">
                        <a href="{{route('admin.slots.edit', $r)}}" class="edit">
                            {{-- icona matita --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                        </a>
                    </div>

                    <div class="modal fade" id="rs{{$r->id}}" tabindex="-1" aria-labelledby="rs{{$r->id}}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered"  action="{{ route('admin.boats.store') }}"  enctype="multipart/form-data"  method="POST">
                            <div class="modal-content mymodal_make_res creation">
                                <section class="modal-body">
                                    <div class="header_modal">
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
                                            @if ($i->start_date <= now() && $i->end_date >= now())
                                                <div class="status">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16"><path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/></svg>
                                                    Attuale
                                                </div>
                                            @elseif( $i->end_date < now() )
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

let scale = 1;
let rotation = 0;
let isDragging = false;
let offsetX, offsetY;

/* ======================
   ZOOM MAPPA (SCALA TUTTO)
====================== */
const viewport = document.getElementById('map-viewport');

function applyZoom() {
    viewport.style.transform = `scale(${scale})`;
}

document.getElementById('zoom-in').onclick = () => {
    scale += 0.1;
    applyZoom();
};

document.getElementById('zoom-out').onclick = () => {
    scale = Math.max(0.5, scale - 0.1);
    applyZoom();
};
</script>
@endsection


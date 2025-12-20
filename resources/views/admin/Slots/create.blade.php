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
                        € Tariffa 
                    </label>
                    <p>
                        <input class="w-100" value="{{ old('price') }}" type="text" name="price" id="price" placeholder="Inserisci il prezzo ">
                    </p>
                    @error('price') <p class="error">{{ $message }}</p> @enderror
                </div>            
                    
            </div>
            <div class="split">          
                <div>
                    <label class="label_c" for="boat-width">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-vertical" viewBox="0 0 16 16"><path d="M8.354 14.854a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 13.293V2.707L6.354 3.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 2.707v10.586l1.146-1.147a.5.5 0 0 1 .708.708z"/></svg> Loa:
                    </label>
                    <p>
                        <input value="{{ old('loa') }}" type="number" name="loa" id="boat-width" step="0.1" placeholder="Inserisci la LOA">
                    </p>
                    @error('loa') <p class="error">{{ $message }}</p> @enderror
                </div>        
                <div>
                    <label class="label_c" for="boat-width">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13a.5.5 0 0 1-.5-.5M8 6a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 .708-.708L7.5 12.293V6.5A.5.5 0 0 1 8 6"/></svg> Draft:
                    </label>
                    <p>
                        <input value="{{ old('draft') }}" type="number" name="draft"  placeholder="Inserisci il pescaggio">
                    </p>
                    @error('draft') <p class="error">{{ $message }}</p> @enderror
                </div>        
            </div>
            <div class="split">          
                <div>
                    <label class="label_c" for="boat-length">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows" viewBox="0 0 16 16"><path d="M1.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L2.707 7.5h10.586l-1.147-1.146a.5.5 0 0 1 .708-.708l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L13.293 8.5H2.707l1.147 1.146a.5.5 0 0 1-.708.708z"/></svg> Beam:
                    </label>
                    <p>
                        <input value="{{ old('beam') }}" type="number" name="beam" id="boat-length" placeholder="Inserisci la larghezza">
                    </p>
                    @error('beam') <p class="error">{{ $message }}</p> @enderror
                </div>        
                <div>
                    <label class="label_c" for="type">
                        Tipologia
                    </label>
                    <p>
                        <select id="type" name="type" >                        
                            <option value="0">Comune</option>
                            @foreach ($type as $k => $t)
                                <option value="{{ $k }}" >{{ $t }}</option>
                            @endforeach
                        </select>
                    </p>
                </div>        
            </div>

        </section>


        <div class="map_toolbar">
            <button type="button" id="zoom-in">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M352 128C352 110.3 337.7 96 320 96C302.3 96 288 110.3 288 128L288 288L128 288C110.3 288 96 302.3 96 320C96 337.7 110.3 352 128 352L288 352L288 512C288 529.7 302.3 544 320 544C337.7 544 352 529.7 352 512L352 352L512 352C529.7 352 544 337.7 544 320C544 302.3 529.7 288 512 288L352 288L352 128z"/></svg>
            </button>
            <button type="button" id="zoom-out">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M96 320C96 302.3 110.3 288 128 288L512 288C529.7 288 544 302.3 544 320C544 337.7 529.7 352 512 352L128 352C110.3 352 96 337.7 96 320z"/></svg>
            </button>
            <button type="button" id="rotate-left">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M320 128C263.2 128 212.1 152.7 176.9 192L224 192C241.7 192 256 206.3 256 224C256 241.7 241.7 256 224 256L96 256C78.3 256 64 241.7 64 224L64 96C64 78.3 78.3 64 96 64C113.7 64 128 78.3 128 96L128 150.7C174.9 97.6 243.5 64 320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576C233 576 156.1 532.6 109.9 466.3C99.8 451.8 103.3 431.9 117.8 421.7C132.3 411.5 152.2 415.1 162.4 429.6C197.2 479.4 254.8 511.9 320 511.9C426 511.9 512 425.9 512 319.9C512 213.9 426 128 320 128z"/></svg>            
            </button>
            <button type="button" id="rotate-right">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M552 256L408 256C398.3 256 389.5 250.2 385.8 241.2C382.1 232.2 384.1 221.9 391 215L437.7 168.3C362.4 109.7 253.4 115 184.2 184.2C109.2 259.2 109.2 380.7 184.2 455.7C259.2 530.7 380.7 530.7 455.7 455.7C463.9 447.5 471.2 438.8 477.6 429.6C487.7 415.1 507.7 411.6 522.2 421.7C536.7 431.8 540.2 451.8 530.1 466.3C521.6 478.5 511.9 490.1 501 501C401 601 238.9 601 139 501C39.1 401 39 239 139 139C233.3 44.7 382.7 39.4 483.3 122.8L535 71C541.9 64.1 552.2 62.1 561.2 65.8C570.2 69.5 576 78.3 576 88L576 232C576 245.3 565.3 256 552 256z"/></svg>
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
                                    width: {{ $s->beam / 5 }}px;
                                    height: {{ $s->loa / 5 }}px;
                                    transform: rotate({{ $s->rotation }}deg);
                                ">
                                <span>{{ $s->name }}</span>
                            </div>
                        @endforeach
                        <div id="new-boat" class="boat "></div>

                    </div>
                </div>
            </div>

            
        </div>

        <input type="hidden" name="pos_x" id="pos_x">
        <input type="hidden" name="pos_y" id="pos_y">
        <input type="hidden" name="rotation" id="rotation">
        <input type="hidden" name="length" id="length-hidden">
        <input type="hidden" name="width" id="width-hidden">


        <div class="action_page">
            <button class="my_btn_3"  type="submit">Conferma</button>
            <button class="my_btn_2" name="add_new" value="1" type="submit">Conferma e creane un altro</button>
        </div>
    </form>
</div>

<script>
/* ======================
   CONFIGURAZIONE
====================== */
const SCALE = 0.2; // 1 metro = 10px

let map = document.getElementById('map');
let boat = document.getElementById('new-boat');

let scale = 1;
let rotation = 0;
let isDragging = false;
let offsetX, offsetY;

/* ======================
   DIMENSIONI REALI
====================== */
const lengthInput = document.getElementById('boat-length');
const widthInput = document.getElementById('boat-width');

function updateBoatSize() {
    const length = parseFloat(lengthInput.value);
    const width = parseFloat(widthInput.value);

    if (!length || !width) return;

    boat.style.width = (length * SCALE) + 'px';
    boat.style.height = (width * SCALE) + 'px';

    document.getElementById('length-hidden').value = length;
    document.getElementById('width-hidden').value = width;
}

lengthInput.addEventListener('input', updateBoatSize);
widthInput.addEventListener('input', updateBoatSize);

/* ======================
   DRAG & DROP
====================== */
boat.addEventListener('mousedown', e => {
    isDragging = true;

    const rect = boat.getBoundingClientRect();
    offsetX = e.clientX - rect.left;
    offsetY = e.clientY - rect.top;

    boat.style.cursor = 'grabbing';
});

document.addEventListener('mousemove', e => {
    if (!isDragging) return;

    const mapRect = map.getBoundingClientRect();

    let x = (e.clientX - mapRect.left - offsetX) / scale;
    let y = (e.clientY - mapRect.top - offsetY) / scale;

    boat.style.left = x + 'px';
    boat.style.top = y + 'px';

    document.getElementById('pos_x').value = x;
    document.getElementById('pos_y').value = y;
});

document.addEventListener('mouseup', () => {
    isDragging = false;
    boat.style.cursor = 'grab';
});

/* ======================
   ROTAZIONE CENTRALE
====================== */
function applyRotation() {
    boat.style.transform = `rotate(${rotation}deg)`;
    document.getElementById('rotation').value = rotation;
}

document.getElementById('rotate-left').onclick = () => {
    rotation -= 5;
    applyRotation();
};

document.getElementById('rotate-right').onclick = () => {
    rotation += 5;
    applyRotation();
};

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
@extends('layouts.base')

@section('contents')
    

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


    <h1 class="my-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-plus-circle-fill mx-3" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
            </svg>
        Modifica Prenotazione</h1>
    <form class="creation mt-5"  action="{{ route('admin.reservations.update', $reservation) }}"  enctype="multipart/form-data"  method="POST">
        @method('PUT')
        @csrf
        <section class="base">
      
            <div class="p new_players info_box_day">
                <label class="label_c">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M304 99.9L304 448L80 448C71.2 448 64 455.2 64 464C64 525.9 114.1 576 176 576L464 576C525.9 576 576 525.9 576 464C576 455.2 568.8 448 560 448L352 448L352 400L513.7 400C526.6 400 534.2 385.6 526.9 375L333.2 90.9C324.3 77.9 304 84.2 304 99.9zM256 384L256 199.8C256 183.7 235 177.7 226.4 191.3L111.3 375.5C104.6 386.2 112.3 400 124.9 400L240 400C248.8 400 256 392.8 256 384z"/></svg>

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16"><path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/><path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/></svg>
                    Cliente
                </label>
                <input type="hidden" name="boat_client" value="[{{$reservation->boat->id . ','.$reservation->boat->client->id }}]">
                <div class="cont">
                    <input type="checkbox"
                        name="boat_client"
                        data-type="boat"
                        data-boat-id="{{ $reservation->boat->id }}"
                        data-reservations='@json($reservation->boat->reservations)'
                        data-loa="{{ $reservation->boat->loa }}"
                        data-beam="{{ $reservation->boat->beam }}"
                        data-draft="{{ $reservation->boat->draft }}"
                        id="boat_{{ $reservation->boat->id }}"
                        value="[{{$reservation->boat->id . ','.$reservation->boat->client->id }}]" 
                        checked
                        disabled
                    >
                    <label for="boat_{{ $reservation->boat->id }}" class="item">
                        <div class="left">
                            <div class="time_slot">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M304 99.9L304 448L80 448C71.2 448 64 455.2 64 464C64 525.9 114.1 576 176 576L464 576C525.9 576 576 525.9 576 464C576 455.2 568.8 448 560 448L352 448L352 400L513.7 400C526.6 400 534.2 385.6 526.9 375L333.2 90.9C324.3 77.9 304 84.2 304 99.9zM256 384L256 199.8C256 183.7 235 177.7 226.4 191.3L111.3 375.5C104.6 386.2 112.3 400 124.9 400L240 400C248.8 400 256 392.8 256 384z"/></svg>
                                {{$reservation->boat->name}}
                            </div>
                            <div class="date">{{$reservation->boat->client->name}} {{$reservation->boat->client->surname}}</div>
                        </div>
                        <div class="actions">
                            
                            <a href="{{route('admin.clients.show', $reservation->boat->client->id)}}" class="show">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                </svg>
                            </a>
                        </div>
                    </label>

                </div>
            </div>
            <div class="p new_players info_box_day">
                <label class="label_c">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M320 128C302.3 128 288 142.3 288 160C288 177.7 302.3 192 320 192C337.7 192 352 177.7 352 160C352 142.3 337.7 128 320 128zM224 160C224 107 267 64 320 64C373 64 416 107 416 160C416 201.8 389.3 237.4 352 250.5L352 508.4C414.9 494.1 462.2 438.7 463.9 371.9L447.8 386C437.8 394.7 422.7 393.7 413.9 383.7C405.1 373.7 406.2 358.6 416.2 349.8L480.2 293.8C489.2 285.9 502.8 285.9 511.8 293.8L575.8 349.8C585.8 358.5 586.8 373.7 578.1 383.7C569.4 393.7 554.2 394.7 544.2 386L528 371.9C525.9 485 433.6 576 320 576C206.4 576 114.1 485 112 371.9L95.8 386.1C85.8 394.8 70.7 393.8 61.9 383.8C53.1 373.8 54.2 358.7 64.2 349.9L128.2 293.9C137.2 286 150.8 286 159.8 293.9L223.8 349.9C233.8 358.6 234.8 373.8 226.1 383.8C217.4 393.8 202.2 394.8 192.2 386.1L176.1 372C177.9 438.8 225.2 494.2 288 508.5L288 250.6C250.7 237.4 224 201.9 224 160.1z"/></svg>
                    Slot
                </label>
                <div class="cont">
                    @foreach ($slots as $p)
                        <input type="checkbox" 
                            name="slot_id"
                            data-type="slot"
                            data-slot-id="{{ $p->id }}"
                            data-reservations='@json($p->reservations)'
                            data-loa="{{ $p->loa }}"
                            data-beam="{{ $p->beam }}"
                            data-draft="{{ $p->draft }}"
                            id="slot_{{ $p->id }}"
                            value="{{$p->id}}" 
                            @if ($p->id == $reservation->slot_id)
                                checked
                            @endif
                        >
                        <label for="slot_{{ $p->id }}" class="item">
                            <div class="left">
                                <div class="time_slot">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M320 128C302.3 128 288 142.3 288 160C288 177.7 302.3 192 320 192C337.7 192 352 177.7 352 160C352 142.3 337.7 128 320 128zM224 160C224 107 267 64 320 64C373 64 416 107 416 160C416 201.8 389.3 237.4 352 250.5L352 508.4C414.9 494.1 462.2 438.7 463.9 371.9L447.8 386C437.8 394.7 422.7 393.7 413.9 383.7C405.1 373.7 406.2 358.6 416.2 349.8L480.2 293.8C489.2 285.9 502.8 285.9 511.8 293.8L575.8 349.8C585.8 358.5 586.8 373.7 578.1 383.7C569.4 393.7 554.2 394.7 544.2 386L528 371.9C525.9 485 433.6 576 320 576C206.4 576 114.1 485 112 371.9L95.8 386.1C85.8 394.8 70.7 393.8 61.9 383.8C53.1 373.8 54.2 358.7 64.2 349.9L128.2 293.9C137.2 286 150.8 286 159.8 293.9L223.8 349.9C233.8 358.6 234.8 373.8 226.1 383.8C217.4 393.8 202.2 394.8 192.2 386.1L176.1 372C177.9 438.8 225.2 494.2 288 508.5L288 250.6C250.7 237.4 224 201.9 224 160.1z"/></svg>
                                    {{$p->name}}
                                </div>
                                {{-- <div class="date">{{$p->client->name}} {{$p->client->surname}}</div> --}}
                            </div>
                            <div class="actions">
                                
                                <a href="{{route('admin.slots.show', $p->id)}}" class="show">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                    </svg>
                                </a>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <div id="availability-info" class="mt-3"></div>

            <div class="split">    
                <div>
                    <label class="label_c" for="start_date">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z"/><path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/></svg>
                        Arrivo
                    </label>
                    <p>
                        <input value="{{ old('start_date', \Carbon\Carbon::parse($reservation->start_date)->format('Y-m-d')) }}" type="date" name="start_date" id="start_date">
                    </p>
                    @error('start_date') <p class="error">{{ $message }}</p> @enderror
                </div>        
                <div>
                    <label class="label_c" for="end_date">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z"/><path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708z"/></svg>
                        Partenza
                    </label>
                    <p>
                        <input value="{{ old('end_date', \Carbon\Carbon::parse($reservation->end_date)->format('Y-m-d')) }}" type="date" name="end_date" id="end_date">
                    </p>
                    @error('end_date') <p class="error">{{ $message }}</p> @enderror
                </div>        
                       
            </div>
            <div id="date-validation-error" class="mt-3"></div>

            <div class="p desc">
                <label class="label_c" for="status">
                    Status 
                </label>

                @php
                    $status = [
                        0 =>'Annullata', 
                        1 =>'Ricevuta', 
                        2 =>'Acconto', 
                        3 =>'Pagata',
                    ]
                @endphp
                <select id="status" name="status" >                        
                    @foreach ($status as $k => $t)
                        <option @if ($reservation->status == $k) selected @endif value="{{ $k }}" >{{ $t }}</option>
                    @endforeach
                </select>
                    

                @error('status') <p class="error">{{ $message }}</p> @enderror
            </div>      

           
            <p class="desc"> 
                <label class="label_c" for="note">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-body-text" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 0 .5m0 2A.5.5 0 0 1 .5 2h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m9 0a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-9 2A.5.5 0 0 1 .5 4h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m5 0a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m7 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-12 2A.5.5 0 0 1 .5 6h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8 0a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-8 2A.5.5 0 0 1 .5 8h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m7 0a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-7 2a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
                    </svg>
                    Note 
    
                </label>
                <textarea name="message" id="message" cols="30" rows="10" >{{ old('message', $reservation->message) }}</textarea>
                @error('message') <p class="error">{{ $message }}</p> @enderror
            </p>
    
        </section>
        <p>* Campi facoltativi</p>

        
        
        <div class="action_page">
    
            <button class="my_btn_3"  type="submit">Conferma</button>
            <button class="my_btn_2" name="add_new" value="1" type="submit">Conferma e creane un'altra</button>
        </div>
    </form>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {

    const infoBox = document.getElementById('availability-info');
    const startInput = document.getElementById('start_date');
    const endInput   = document.getElementById('end_date');
    const errorBox   = document.getElementById('date-validation-error');
    const submitBtns = document.querySelectorAll('button[type="submit"]');

    let boatReservations = [];
    let slotReservations = [];

    let selectedBoat = null;
    let selectedSlot = null;

    // esclusività checkbox
    function exclusive(selector, onSelect) {
        document.querySelectorAll(selector).forEach(el => {
            el.addEventListener('change', () => {
                document.querySelectorAll(selector).forEach(x => x !== el && (x.checked = false));
                onSelect(el.checked ? JSON.parse(el.dataset.reservations) : []);
                if (el.checked) {
                    if (el.dataset.type === 'boat') selectedBoat = el;
                    if (el.dataset.type === 'slot') selectedSlot = el;
                } else {
                    if (el.dataset.type === 'boat') selectedBoat = null;
                    if (el.dataset.type === 'slot') selectedSlot = null;
                }
                render();
                validateSizes(); // ✅ controlla dimensioni
                validateDates(); // ricontrolla date
            });
        });
    }

    exclusive('input[data-type="boat"]', res => boatReservations = res);
    exclusive('input[data-type="slot"]', res => slotReservations = res);

    function render() {
        infoBox.innerHTML = '';
        let html = '';

        boatReservations.forEach(r => {
            html += `
                <div class="alert alert-warning">
                    <h5>⚠️ <strong>Imbarcazione già assegnata</strong></h5> 
                    Da ${formatDateIT(r.start_date)} a ${formatDateIT(r.end_date)}
                </div>
            `;
        });

        slotReservations.forEach(r => {
            html += `
                <div class="alert alert-danger">
                    <h5>⛔ <strong>Slot già assegnato</strong></h5> 
                    Da ${formatDateIT(r.start_date)} a ${formatDateIT(r.end_date)}
                </div>
            `;
        });

        if (!boatReservations.length && !slotReservations.length) {
            html = `
                <div class="alert alert-success">
                    ✅ Nessuna prenotazione presente
                </div>
            `;
        }

        infoBox.innerHTML = html;
    }

    function formatDateIT(dateString) {
        const date = new Date(dateString);
        return new Intl.DateTimeFormat('it-IT', {
            weekday: 'short',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        }).format(date);
    }

    function disableSubmit(disabled) {
        submitBtns.forEach(btn => btn.disabled = disabled);
        startInput.disabled = disabled;
        endInput.disabled = disabled;
    }

    function showError(message) {
        errorBox.innerHTML = `
            <div class="alert alert-danger">
                ⛔ ${message}
            </div>
        `;
        disableSubmit(true);
    }

    function clearError() {
        errorBox.innerHTML = '';
        disableSubmit(false);
    }

    function validateDates() {
        if (!startInput.value || !endInput.value) return;

        const today     = normalizeDate(new Date());
        const startDate = normalizeDate(startInput.value);
        const endDate   = normalizeDate(endInput.value);

        if (startDate < today || endDate < today) {
            showError('Non puoi selezionare date precedenti a oggi.');
            return;
        }

        if (startDate > endDate) {
            showError('La data di arrivo non può essere successiva alla data di partenza.');
            return;
        }

        const conflicts = [...boatReservations, ...slotReservations].some(r => {
            const rStart = normalizeDate(r.start_date);
            const rEnd   = normalizeDate(r.end_date);
            return datesOverlap(startDate, endDate, rStart, rEnd);
        });

        if (conflicts) {
            showError('Le date selezionate si sovrappongono a una prenotazione esistente.');
            return;
        }
    }

    function validateSizes() {
        clearError();
        if (!selectedBoat || !selectedSlot) return;

        const boatLoa   = parseFloat(selectedBoat.dataset.loa);
        const boatBeam  = parseFloat(selectedBoat.dataset.beam);
        const boatDraft = parseFloat(selectedBoat.dataset.draft);

        const slotLoa   = parseFloat(selectedSlot.dataset.loa);
        const slotBeam  = parseFloat(selectedSlot.dataset.beam);
        const slotDraft = parseFloat(selectedSlot.dataset.draft);
        console.log(slotLoa, slotBeam, slotDraft)
        console.log(boatLoa, boatBeam, boatDraft)
        
        if (slotLoa < boatLoa || slotBeam < boatBeam || slotDraft < boatDraft) {
            console.log(boatLoa, boatBeam, boatDraft)
            showError(' Le dimensioni dello slot superano quelle della barca selezionata.');
        }
    }

    function normalizeDate(date) {
        const d = new Date(date);
        d.setHours(0, 0, 0, 0);
        return d;
    }

    function datesOverlap(startA, endA, startB, endB) {
        return startA <= endB && endA >= startB;
    }

    startInput.addEventListener('change', validateDates);
    endInput.addEventListener('change', validateDates);
});

</script>






@endsection
@extends('layouts.base')

@section('contents')
@php
    $role = ['admin' => 'Amministratore', 'trainer' => 'Istruttore'];
    $status_res = ['annullata', 'ricevuta', 'acconto', 'pagata']
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



    <h1>
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-card-checklist mx-3" viewBox="0 0 16 16">
            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
            <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
        </svg>
        Prenotazioni
    </h1>    
    
    
    <div class="floating mb-5">
        <div class="int">
            <a class="my_btn_3 gap-2" href="{{route('admin.reservations.create')}}"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                </svg> NUOVA PRENOTAZIONE
            </a>
        </div>
    </div>

    {{-- <div class="filters">
        <div class="bar">
            <input type="checkbox" class="check" id="f">
            <div class="box">
                <button id="typeToggle" class="type">Tutte</button>
                <button id="sortToggle" class="order" title="Ordina per data">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-sort-down-alt" viewBox="0 0 16 16">
                        <path
                            d="M3.5 3.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 12.293zm4 .5a.5.5 0 0 1 0-1h1a.5.5 0 0 1 0 1zm0 3a.5.5 0 0 1 0-1h3a.5.5 0 0 1 0 1zm0 3a.5.5 0 0 1 0-1h5a.5.5 0 0 1 0 1zM7 12.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5" />
                    </svg>
                </button>
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
    </div> --}}

    <div class="info_box_day" id="reservations-list">
        <div class="box">
        @foreach ($reservations as $r)
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
                    <div class="client">{{substr($r->client->name, 0, 1)}}. {{$r->client->surname}}</div> 
                    <div class="boat">{{$r->boat->name}}</div>
                </div>
                <div class="item">
                    @if ($r->slot)
                        <div class="slot">{{$r->slot->name}}</div>
                    @else
                        <div class="slot">
                            
                            <button class="my_btn_1" type="button" data-bs-toggle="modal" data-bs-target="#confirm{{$r->id}}" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16"><path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/></svg>
                            </button>
                            <button class="delete_btn my_btn_2" type="button" data-bs-toggle="modal" data-bs-target="#delete{{$r->id}}" >
                               <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"><path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/></svg>
                            </button>
                        </div>
                    @endif
                    <div class="date">
                        <p>Da <strong>{{$formatter->format($r->start_date)}}</strong></p>
                        <p>A &nbsp; <strong>{{$formatter->format($r->end_date)}}</strong></p>
                    </div>
                    <div class="actions">
                        <div class="status">{{$status_res[$r->status]}}</div>
                        <a href="{{route('admin.reservations.edit', $r)}}" class="edit">
                            {{-- icona matita --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <!-- delelete  -->
            <div class="modal fade" id="delete{{$r->id}}" aria-labelledby="delete{{$r->id}}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered"  action="{{ route('admin.boats.store') }}"  enctype="multipart/form-data"  method="POST">
                    <div class="modal-content mymodal_make_res creation">
                        <form action="{{ route('admin.reservations.update_status', $r) }}"  enctype="multipart/form-data"  method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $r->id }}">
                            <input type="hidden" name="status" value="0">
                            <section class="modal-body">
                                <div class="top">
                                    <h2></h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <h2 >Confermi l'annullamento della prenotazione di {{$r->client->name}} {{$r->client->surname}} ?</h2>
                                <p>Il cliente ricevera una mail con la notifca del seguente annullamento</p>
                                <div class="actions">
                                    <button class="my_btn_2 btn_delete mb-3"  type="submit">Annulla</button>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
            <!-- cponfrim -->
            <div class="modal fade" id="confirm{{$r->id}}" aria-labelledby="confirm{{$r->id}}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered"  action="{{ route('admin.boats.store') }}"  enctype="multipart/form-data"  method="POST">
                    <div class="modal-content mymodal_make_res creation">
                        <form action="{{ route('admin.reservations.update_status') }}"  enctype="multipart/form-data"  method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $r->id }}">
                            <input type="hidden" name="status" value="1">
                            <section class="modal-body">
                                <div class="top">
                                    <h2></h2>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <h2 >Conferma la prenotazione di {{$r->client->name}} {{$r->client->surname}} e assegna lo slot</h2>
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
                                                @if ($p->id == $r->slot_id)
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
                                            <input value="{{ old('start_date', \Carbon\Carbon::parse($r->start_date)->format('Y-m-d')) }}" type="date" name="start_date" id="start_date">
                                        </p>
                                        @error('start_date') <p class="error">{{ $message }}</p> @enderror
                                    </div>        
                                    <div>
                                        <label class="label_c" for="end_date">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z"/><path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708z"/></svg>
                                            Partenza
                                        </label>
                                        <p>
                                            <input value="{{ old('end_date', \Carbon\Carbon::parse($r->end_date)->format('Y-m-d')) }}" type="date" name="end_date" id="end_date">
                                        </p>
                                        @error('end_date') <p class="error">{{ $message }}</p> @enderror
                                    </div>        
                                        
                                </div>
                                <div id="date-validation-error" class="mt-3"></div>

                                <div class="actions">
                                    <button class="my_btn_2 btn_delete mb-3"  type="submit">Conferma</button>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
            
        @endforeach
        </div>
    </div>
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


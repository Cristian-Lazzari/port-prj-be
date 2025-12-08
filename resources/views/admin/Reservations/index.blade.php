@extends('layouts.base')

@section('contents')
@php
    $role = ['admin' => 'Amministratore', 'trainer' => 'Istruttore'];
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
        PREONOTAZIONI
    </h1>        
    <div class="filters">
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
    </div>

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
                    <div class="client">{{substr($r->client->name, 0, 1)}}. {{$r->client->surname}}</div> <div class="boat">{{$r->boat->name}}</div>
                </div>
                <div class="item">
                    <div class="slot">{{$r->slot->name}}</div>
                    <div class="date">
                        <p>Da <strong>{{$formatter->format($r->start_date)}}</strong></p>
                        <p>A <strong>{{$formatter->format($r->end_date)}}</strong></p>
                    </div>
                    <div class="status">confermata</div>
                    
                </div>
            </div>
            
        @endforeach
        </div>
    </div>
</div>

<script>
// document.addEventListener('DOMContentLoaded', function () {
//     const typeToggle = document.getElementById('typeToggle');
//     const sortToggle = document.getElementById('sortToggle');
//     const reservationsList = document.getElementById('reservations-list');
//     const sortIcon = sortToggle.querySelector('svg');

//     let sortOrder = 'desc';
//     let statusFilter = 'all';

//     function filterAndSort() {
//         const items = Array.from(reservationsList.querySelectorAll('.res_item'));

//         items.forEach(item => {
//             const isCancelled = item.classList.contains('off');
//             const matchesStatus =
//                 statusFilter === 'all' ||
//                 (statusFilter === 'confirmed' && !isCancelled) ||
//                 (statusFilter === 'cancelled' && isCancelled);

//             item.style.display = matchesStatus ? '' : 'none';
//         });

//         // Ordinamento
//         const visibleItems = items.filter(i => i.style.display !== 'none');
//         visibleItems.sort((a, b) => {
//             const aDate = new Date(a.dataset.created);
//             const bDate = new Date(b.dataset.created);
//             return sortOrder === 'asc' ? aDate - bDate : bDate - aDate;
//         });

//         visibleItems.forEach(i => reservationsList.appendChild(i));
//     }

//     // Toggle tipo (Tutte / Confermate / Annullate)
//     typeToggle.addEventListener('click', () => {
//         if (statusFilter === 'all') {
//             statusFilter = 'confirmed';
//             typeToggle.textContent = 'Confermate';
//             typeToggle.classList.remove('cancelled');
//             typeToggle.classList.add('confirmed');
//         } else if (statusFilter === 'confirmed') {
//             statusFilter = 'cancelled';
//             typeToggle.textContent = 'Annullate';
//             typeToggle.classList.remove('confirmed');
//             typeToggle.classList.add('cancelled');
//         } else {
//             statusFilter = 'all';
//             typeToggle.textContent = 'Tutte';
//             typeToggle.classList.remove('confirmed', 'cancelled');
//         }
//         filterAndSort();
//     });

//     // Toggle ordinamento + rotazione icona
//     sortToggle.addEventListener('click', () => {
//         sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
//         sortToggle.classList.toggle('active', sortOrder === 'asc');
//         filterAndSort();

//         // Rotazione icona
//         sortIcon.style.transform = sortOrder === 'asc' ? 'rotate(180deg)' : 'rotate(0deg)';
//     });

//     filterAndSort();
// });
</script>




@endsection


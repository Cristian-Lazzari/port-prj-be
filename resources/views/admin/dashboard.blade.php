@extends('layouts.base')

@section('contents')
@php
    $role = ['admin' => 'Amministratore', 'trainer' => 'Istruttore'];
    $i = 0; 
    $currentDay = date("d");
    $currentMonth = date("m");
    $currentYear = date("Y");
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
    @if (session('error'))
    @php
        $error = session('error');
    @endphp
    <div class="alert-cont">
        <div class="alert alert-dismissible fade show notify_success error" role="alert">
            {{$error}}
            <button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
    <h1> <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-calendar2-week mx-3" viewBox="0 0 16 16">
            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/>
            <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5zM11 7.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/>
        </svg> CALENDARIO
    </h1>

    <div id="carouselExampleIndicators" class="carousel slide my_carousel" >
        <div class="carousel-indicators">
            @foreach ($year as $m)
                <button  type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$i}}"
                @if ($currentMonth == $m['month'] && $currentYear == $m['year'])
                    class="active" aria-current="true" 
                @endif
                aria-label="{{ 'Slide ' . $i }}"></button>
                @php $i ++ @endphp
            @endforeach
        </div>
        <div class="top_line">
            <button class="prev_btn" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                </svg>
            </button>
            <button class="post_btn" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                </svg>
            </button>
        </div>
        <div id="calendar" class="carousel-inner">
            @php $i = 0; @endphp
            @foreach ($year as $m)
                <div class="carousel-item @if ($currentMonth == $m['month'] && $currentYear == $m['year']) active @endif">
                    <h2 class="my">{{['', 'gennaio', 'febbraio', 'marzo', 'aprile', 'maggio', 'giugno', 'luglio', 'agosto', 'settembre', 'ottobre', 'novembre', 'dicembre'][$m['month']]}} - {{$m['year']}}</h2>
                    <div class="calendar">
                        <div class="c-name">
                            @php
                            $day_name = ['lunedì', 'martedì', 'mercoledì', 'giovedì', 'venerdì', 'sabato', 'domenica'];
                            @endphp
                            @foreach ($day_name as $item)
                                <h4>{{$item}}</h4>
                            @endforeach
                        </div>
                        <div class="calendar_page">
                            @foreach ($m['days'] as $d)
                                <button data-day='@json($d)'
                                class="day  
                                @if($currentMonth == $m['month'] && $currentYear == $m['year'] && $currentDay == $d['day']) current @endif " 
                                style="grid-column-start:{{$d['day_w'] }}">        
                                    <p class="p_day">{{$d['day']}}</p>
                                    @if (isset($d['arrivals']) && count($d['arrivals']))
                                        <span class="bookings top">{{count($d['arrivals'])}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-down" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z"/><path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/></svg>
                                        </span>
                                    @endif
                                    @if (isset($d['departures']) && count($d['departures']))
                                        <span class="bookings b1">{{count($d['departures'])}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z"/><path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 1.707V10.5a.5.5 0 0 1-1 0V1.707L5.354 3.854a.5.5 0 1 1-.708-.708z"/></svg>
                                        </span>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
                @php $i ++ @endphp
            @endforeach
        </div>
    </div>

    <div id="day-info" class="info_box_day">
        {{-- <div class="box">
            <div class="wrap_item">
                <div class="top">
                    <div class="client"> </div> <div class="boat"></div>
                </div>
                <div class="item">
                    <div class="slot"></div>
                    <div class="date">
                        <p>Da <strong>t</strong></p>
                        <p>A <strong>t</strong></p>
                    </div>
                    <div class="status">confermata</div>
                    
                </div>
            </div>
        </div> --}}
    </div>

    



</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const buttons = document.querySelectorAll('.day');
    const infoBox = document.getElementById('day-info');

    const formatShortWithWeekday = (date) => {
        return new Date(date).toLocaleDateString('it-IT', {
            weekday: 'short',   // lun, mar, mer, gio, ven, sab, dom
            day: '2-digit',
            month: 'short',     // gen, feb, mar, apr, mag, giu, ...

        });
    };
    buttons.forEach(btn => {

        btn.addEventListener('click', () => {
            const dayData = JSON.parse(btn.dataset.day);

            // Creiamo il contenuto dinamico
            let html = `
                <h3>${dayData.day} - ${dayData.month} - ${dayData.year}</h3>
                    `;

            // ARRIVI
            if (dayData.arrivals && dayData.arrivals.length > 0) {
                html += `<div class="box">
                <h4>${dayData.arrivals.length} Arriv${dayData.arrivals.length !== 1 ? 'i':'o'}</h4>`;
                dayData.arrivals.forEach(r => {
                    

                    html += `
                    <div class="wrap_item">
                        <div class="top">
                            <div class="client">${r.client.name} ${r.client.surname}</div> <div class="boat">${r.boat.name}</div>
                        </div>
                        <div class="item">
                            <div class="slot">${r.slot.name}</div>
                            <div class="date">
                                <p class="ex">Da <strong>${formatShortWithWeekday(r.start_date)}</strong></p>
                                <p>A <strong>${formatShortWithWeekday(r.end_date)}</strong></p>
                            </div>
                            <div class="status">confermata</div>
                        </div>
                    </div>`;
                });

                html += `</div>`;
            }

            // PARTENZE
            if (dayData.departures && dayData.departures.length > 0) {
                html += `<div class="box">
                <h4>${dayData.departures.length} Partenz${dayData.departures.length !== 1 ? 'e':'a'}</h4>`;
                dayData.departures.forEach(r => {
                    html += `
                    <div class="wrap_item">
                        <div class="top">
                            <div class="client">${r.client.name} ${r.client.surname}</div> <div class="boat">${r.boat.name}</div>
                        </div>
                        <div class="item">
                            <div class="slot">${r.slot.name}</div>
                            <div class="date">
                                <p>Da <strong>${formatShortWithWeekday(r.start_date)}</strong></p>
                                <p class="ex">A <strong>${formatShortWithWeekday(r.end_date)}</strong></p>
                            </div>
                            <div class="status">confermata</div>
                        </div>
                    </div>`;
                });
                html += `</div>`;
            }

            // Se non ci sono prenotazioni
            if ((!dayData.arrivals || !dayData.arrivals.length) &&
                (!dayData.departures || !dayData.departures.length)) {
                html += `<p class="null_p">Nessun arrivo o partenza per questo giorno.</p>`;
            }

            infoBox.innerHTML = html;
        });

    });

});
</script>



@endsection


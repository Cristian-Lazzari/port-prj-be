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

    <h1 class="pt-5">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-people-fill mx-3" viewBox="0 0 16 16">
        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
        </svg>
        Disposizione portuale
    </h1>

    <div class="floating">
        <div class="int">
            <a class="my_btn_3 gap-2" href="{{route('admin.clients.create')}}"> 
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                </svg> NUOVO SlOT
            </a>
        </div>
    </div>

    <div class="info_box_day">
        <div class="box">
            @foreach ($slots as $r)
                <div class="item">
           
                    
                    <div class="name">
                        <span class="firstname">{{$r->name}}</span>
                    </div>
                    @foreach ($r->reservations as $i)
                    <div class="status">
                            
                        Cliente:{{$i->client->name}} Barca:{{$i->boat->name}}
                    </div>
                        @endforeach
                    <div class="actions">
      
                        <a href="{{route('admin.clients.show', $r)}}" class="show">
                            {{-- icona dettagli --}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>



@endsection


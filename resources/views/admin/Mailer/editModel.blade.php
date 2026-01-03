
@extends('layouts.base')

@section('contents')



<a class="my_btn_5 ml-auto" href="{{route('admin.mailer.index')}}"> Indietro </a>
<h2 class="my-4">Modifica il modello "{{$model->name}}"</h2>


<form class="creation"  action="{{ route('admin.mailer.update_model') }}"  enctype="multipart/form-data"  method="POST">
    @csrf
    <input type="hidden" name="id" value="{{$model->id}}">

    <section class="base">

        <div class="split"> 
            <div>
                <label class="label_c" for="sender">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-type" viewBox="0 0 16 16">
                    <path d="m2.244 13.081.943-2.803H6.66l.944 2.803H8.86L5.54 3.75H4.322L1 13.081zm2.7-7.923L6.34 9.314H3.51l1.4-4.156zm9.146 7.027h.035v.896h1.128V8.125c0-1.51-1.114-2.345-2.646-2.345-1.736 0-2.59.916-2.666 2.174h1.108c.068-.718.595-1.19 1.517-1.19.971 0 1.518.52 1.518 1.464v.731H12.19c-1.647.007-2.522.8-2.522 2.058 0 1.319.957 2.18 2.345 2.18 1.06 0 1.716-.43 2.078-1.011zm-1.763.035c-.752 0-1.456-.397-1.456-1.244 0-.65.424-1.115 1.408-1.115h1.805v.834c0 .896-.752 1.525-1.757 1.525"/>
                </svg>
                Nome del modello *</label>   
                <input value="{{ old('name', $model->name) }}" type="text" name="name" id="name" class="w-100" placeholder="Insersci nome di questo template">
                    @error('name') <p class="error">{{ $message }}</p> @enderror

            </div>
                
            <div>
                <label class="label_c" for="sender">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-type" viewBox="0 0 16 16">
                    <path d="m2.244 13.081.943-2.803H6.66l.944 2.803H8.86L5.54 3.75H4.322L1 13.081zm2.7-7.923L6.34 9.314H3.51l1.4-4.156zm9.146 7.027h.035v.896h1.128V8.125c0-1.51-1.114-2.345-2.646-2.345-1.736 0-2.59.916-2.666 2.174h1.108c.068-.718.595-1.19 1.517-1.19.971 0 1.518.52 1.518 1.464v.731H12.19c-1.647.007-2.522.8-2.522 2.058 0 1.319.957 2.18 2.345 2.18 1.06 0 1.716-.43 2.078-1.011zm-1.763.035c-.752 0-1.456-.397-1.456-1.244 0-.65.424-1.115 1.408-1.115h1.805v.834c0 .896-.752 1.525-1.757 1.525"/>
                </svg>
                Mittente *</label>   
                <input value="{{ old('sender', $model->sender) }}" type="text" name="sender" id="sender" class="w-100" placeholder="es: Con affetto il proprietario Marco Rossi">
                    @error('sender') <p class="error">{{ $message }}</p> @enderror

            </div>
        </div>
        
        <p class="desc"> 
            <label class="label_c" for="object">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-type" viewBox="0 0 16 16">
                <path d="m2.244 13.081.943-2.803H6.66l.944 2.803H8.86L5.54 3.75H4.322L1 13.081zm2.7-7.923L6.34 9.314H3.51l1.4-4.156zm9.146 7.027h.035v.896h1.128V8.125c0-1.51-1.114-2.345-2.646-2.345-1.736 0-2.59.916-2.666 2.174h1.108c.068-.718.595-1.19 1.517-1.19.971 0 1.518.52 1.518 1.464v.731H12.19c-1.647.007-2.522.8-2.522 2.058 0 1.319.957 2.18 2.345 2.18 1.06 0 1.716-.43 2.078-1.011zm-1.763.035c-.752 0-1.456-.397-1.456-1.244 0-.65.424-1.115 1.408-1.115h1.805v.834c0 .896-.752 1.525-1.757 1.525"/>
            </svg>
            Oggetto mail *</label>   
            <input value="{{ old('object', $model->object) }}" type="text" name="object" id="object" class="w-100" placeholder=" inserisci l'oggetto della mail">
                @error('object') <p class="error">{{ $message }}</p> @enderror
        </p>
        <p class="desc"> 
            <label class="label_c" for="heading">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-type" viewBox="0 0 16 16">
                <path d="m2.244 13.081.943-2.803H6.66l.944 2.803H8.86L5.54 3.75H4.322L1 13.081zm2.7-7.923L6.34 9.314H3.51l1.4-4.156zm9.146 7.027h.035v.896h1.128V8.125c0-1.51-1.114-2.345-2.646-2.345-1.736 0-2.59.916-2.666 2.174h1.108c.068-.718.595-1.19 1.517-1.19.971 0 1.518.52 1.518 1.464v.731H12.19c-1.647.007-2.522.8-2.522 2.058 0 1.319.957 2.18 2.345 2.18 1.06 0 1.716-.43 2.078-1.011zm-1.763.035c-.752 0-1.456-.397-1.456-1.244 0-.65.424-1.115 1.408-1.115h1.805v.834c0 .896-.752 1.525-1.757 1.525"/>
            </svg>
            Heading *</label>   
            <input value="{{ old('heading', $model->heading) }}" type="text" name="heading" id="heading" class="w-100" placeholder=" inserisci il titolo">
                @error('heading') <p class="error">{{ $message }}</p> @enderror
        </p>
        <div>
            <label class="label_c" for="file-input">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-image" viewBox="0 0 16 16">
                    <path d="M6.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                    <path d="M14 14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zM4 1a1 1 0 0 0-1 1v10l2.224-2.224a.5.5 0 0 1 .61-.075L8 11l2.157-3.02a.5.5 0 0 1 .76-.063L13 10V4.5h-2A1.5 1.5 0 0 1 9.5 3V1z"/>
                </svg>
                Immagine principale</label>
            <p><input type="file" id="file-input" name="img_1" ></p>
            @error('img_1') <p class="error">{{ $message }}</p> @enderror
        </div>
        <p class="desc"> 
            <label class="label_c" for="body">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-body-text" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 0 .5m0 2A.5.5 0 0 1 .5 2h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m9 0a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-9 2A.5.5 0 0 1 .5 4h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m5 0a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m7 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-12 2A.5.5 0 0 1 .5 6h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8 0a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-8 2A.5.5 0 0 1 .5 8h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m7 0a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-7 2a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
            </svg> 
            Corpo *1</label>   
            <div class="variables">
                <p>Variabili inseribili nel corpo:</p>
                @foreach (json_decode($model->available_vars, 1) as $key => $value)
                    @php
                        $placeholder = '{{' . $value . '}}';
                    @endphp
                    <button class="copy-button" type="button" data-copy="{{ $placeholder }}">
                        <span>
                            <svg width="12"height="12"fill="#0E418F"xmlns="http://www.w3.org/2000/svg"shape-rendering="geometricPrecision"text-rendering="geometricPrecision"image-rendering="optimizeQuality"fill-rule="evenodd"clip-rule="evenodd"viewBox="0 0 467 512.22" > <path fill-rule="nonzero" d="M131.07 372.11c.37 1 .57 2.08.57 3.2 0 1.13-.2 2.21-.57 3.21v75.91c0 10.74 4.41 20.53 11.5 27.62s16.87 11.49 27.62 11.49h239.02c10.75 0 20.53-4.4 27.62-11.49s11.49-16.88 11.49-27.62V152.42c0-10.55-4.21-20.15-11.02-27.18l-.47-.43c-7.09-7.09-16.87-11.5-27.62-11.5H170.19c-10.75 0-20.53 4.41-27.62 11.5s-11.5 16.87-11.5 27.61v219.69zm-18.67 12.54H57.23c-15.82 0-30.1-6.58-40.45-17.11C6.41 356.97 0 342.4 0 326.52V57.79c0-15.86 6.5-30.3 16.97-40.78l.04-.04C27.51 6.49 41.94 0 57.79 0h243.63c15.87 0 30.3 6.51 40.77 16.98l.03.03c10.48 10.48 16.99 24.93 16.99 40.78v36.85h50c15.9 0 30.36 6.5 40.82 16.96l.54.58c10.15 10.44 16.43 24.66 16.43 40.24v302.01c0 15.9-6.5 30.36-16.96 40.82-10.47 10.47-24.93 16.97-40.83 16.97H170.19c-15.9 0-30.35-6.5-40.82-16.97-10.47-10.46-16.97-24.92-16.97-40.82v-69.78zM340.54 94.64V57.79c0-10.74-4.41-20.53-11.5-27.63-7.09-7.08-16.86-11.48-27.62-11.48H57.79c-10.78 0-20.56 4.38-27.62 11.45l-.04.04c-7.06 7.06-11.45 16.84-11.45 27.62v268.73c0 10.86 4.34 20.79 11.38 27.97 6.95 7.07 16.54 11.49 27.17 11.49h55.17V152.42c0-15.9 6.5-30.35 16.97-40.82 10.47-10.47 24.92-16.96 40.82-16.96h170.35z"></path> </svg>
                           {{ $placeholder }}</span
                        >
                        <span>Copiato!</span>
                    </button>
                    
                @endforeach
            </div>
            <textarea data-preview-id="preview_body" name="body" id="body" cols="30" rows="10" > {{ old('body', $model->body) }} </textarea>
            <div id="preview_body" class="preview-box"></div>

            @error('body') <p class="error">{{ $message }}</p> @enderror
           
        </p>
        
        <div>
            <label class="label_c" for="file-input1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-image" viewBox="0 0 16 16">
                    <path d="M6.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                    <path d="M14 14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zM4 1a1 1 0 0 0-1 1v10l2.224-2.224a.5.5 0 0 1 .61-.075L8 11l2.157-3.02a.5.5 0 0 1 .76-.063L13 10V4.5h-2A1.5 1.5 0 0 1 9.5 3V1z"/>
                </svg>
                Immagine secondaria</label>
            <p><input type="file" id="file-input1" name="img_2" ></p>
            @error('img_2') <p class="error">{{ $message }}</p> @enderror
        </div>
        
        <p class="desc"> 
            <label class="label_c" for="ending">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-body-text" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M0 .5A.5.5 0 0 1 .5 0h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 0 .5m0 2A.5.5 0 0 1 .5 2h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m9 0a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-9 2A.5.5 0 0 1 .5 4h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m5 0a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m7 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-12 2A.5.5 0 0 1 .5 6h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8 0a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-8 2A.5.5 0 0 1 .5 8h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m7 0a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-7 2a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1h-8a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
            </svg> 
            Conclusione *1</label>   
            <textarea name="ending" id="ending" cols="30" rows="7" > {{ old('ending', $model->ending) }} </textarea>
            @error('ending') <p class="error">{{ $message }}</p> @enderror
        </p>
        <p>*1 Per andare a capo inserire \n e creare più paragafi inserire /*/ tra un paragrafo e l'altro </p>
    </section>

    <button class="my_btn_2 mb-5  w-75 m-auto" type="submit">Modifica modello</button>

</form>


<style>
/* Stile evidenziazione */
.highlight-variable {
  background-color: #10b793 ;
  color: #090333 !important;
  font-weight: bold;
  border-radius: 4px;
  padding-inline: 3px !important;
}
.invalid-variable {
    background: rgba(255, 0, 0, 0.15);
    color: #cc0000;
    padding: 2px 4px;
    border-radius: 4px;
}

.paragraph-separator {
    margin: 16px 0;
}
.copy-button {
  background-color: #f2f7fa;
  width: 220px;
  height: 30px;
  border: none;
  border-radius: 10px;
  font-weight: 600;
  cursor: pointer;
  overflow: hidden;
  transition-duration: 700ms;
}

.copy-button span:first-child {
  color: #0e418f;
  position: absolute;
  transform: translate(-50%, -50%);
}

.copy-button span:last-child {
  position: absolute;
  color: #b5ccf3;
  opacity: 0;
  transform: translateY(100%) translateX(-50%);
  height: 14px;
  line-height: 13px;
}

.copy-button:focus {
  background-color: #0e418f;
  width: 120px;
  height: 40px;
  transition-delay: 100ms;
  transition-duration: 500ms;
}

.copy-button:focus span:first-child {
  color: #b5ccf3;
  transform: translateX(-50%) translateY(-150%);
  opacity: 0;
  transition-duration: 500ms;
}

.copy-button:focus span:last-child {
  transform: translateX(-50%) translateY(-50%);
  opacity: 1;
  transition-delay: 300ms;
  transition-duration: 500ms;
}

.copy-button:focus:end {
  background-color: #ffffff;
  width: 120px;
  height: 40px;
  transition-duration: 900ms;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Variabili disponibili dal server (JSON)

   // const keys = @json(json_decode($model->available_vars, true));

    const variables = @json(json_decode($model->available_vars, true));
    console.log(variables)
    // Funzione per evidenziare testo
    function highlightText(input) {
        let text = input.value;

        const previewId = input.dataset.previewId;
        if (!previewId) return;

        const preview = document.getElementById(previewId);
        if (!preview) return;

        const regex = /\{\{\s*([\w\-]+)\s*\}\}/g;

        // Highlight variabili
        let output = text.replace(regex, (match, varName) => {
            if (variables.includes(varName)) {
                return `<span class="highlight-variable">${match}</span>`;
            }
            return `<span class="invalid-variable">${match}</span>`;
        });

        // Gestione formattazione preview
        output = output
            .replace(/\/\*\/\s*/g, '<p class="paragraph-separator"></p>')
            .replace(/\\n/g, '<br>');

        preview.innerHTML = output;
    }


    // Applica a tutti input e textarea con data-preview-id
    document.querySelectorAll('input[data-preview-id], textarea[data-preview-id]').forEach(input => {
        input.addEventListener('input', () => highlightText(input));
        // evidenzia all'apertura
        highlightText(input);
    });

    document.querySelectorAll('.copy-button').forEach(el => {
        el.addEventListener('click', () => {
            navigator.clipboard.writeText(el.dataset.copy).catch(err => {
                console.error('Errore nel copiare il testo: ', err);
            });
        });
    });
});
</script>

@endsection


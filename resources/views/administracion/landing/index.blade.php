@extends('layouts.app')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6 pb-5">
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="tipoFormulario" id="tipoFormulario">
                <option value="0">Seleccione un Tipo Formulario:</option>
                @foreach ($formularios as $formulario)
                    <option value="{{ $formulario->FORM_Id }}">{{ $formulario->FORM_Nombre }}</option>    
                @endforeach
            </select>
        </div>
        <div id="contenedorFormulario" class="container-fluid"></div>
    </div>
</div>
@section('script-js')
<script type="text/javascript">
    var selectorTipoFormulario = document.getElementById('tipoFormulario');
    selectorTipoFormulario.addEventListener('change', (event) => {
        let tipoFormulario = event.target.value;

        var token = document.head.querySelector("[name='csrf-token'][content]").content;

        let url = "{{ route('landing.show', 'value') }}";
            url = url.replace('value', tipoFormulario);
        
        fetch(url, {
            method: "GET",
            headers: {
                "X-CSRF-Token": token,
            },
        })
        .then((res) => res.text())
        .then(response => {
            let rspta = JSON.parse(response);
            let contenedorFormulario = document.getElementById("contenedorFormulario");

            if(!rspta) { contenedorFormulario.innerHTML = ''; return false; }
            
            contenedorFormulario.innerHTML = 
                `<div class="row">
                    <div class="col-3 d-flex justify-content-center">
                        <h3>NOMBRE</h3>
                    </div>
                    <div class="col-7 d-flex justify-content-center">
                        <h3>ELEMENTO</h3>
                    </div>
                    <div class="col-2 d-flex justify-content-center">
                        <h3>ESTADO</h3>  
                    </div>
                </div>`
            rspta.forEach(function(data) {
                switch (data.ELEM_Tipo) {
                    case 'L': 
                        contenedorFormulario.innerHTML += 
                            `<div class="row">
                                <div class="col-3">
                                    <b>${data.ELEM_Nombre}</b>
                                </div>
                                <div class="col-7 d-flex justify-content-center">
                                    <h3>
                                        ${data.Valor}
                                    </h3>
                                </div>
                                <div class="col-2 d-flex justify-content-center">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" onchange="seleccionElemento(event,${data.ELEM_Id})" id="flexSwitchCheckChecked${data.ELEM_Id}" ${data.TipoActivacion == 0 ? '' : 'checked' }>
                                    </div>
                                </div>
                            </div>`;
                    break;
                    case 'I': 
                        contenedorFormulario.innerHTML += 
                            `<div class="row">
                                <div class="col-3">
                                    <b>${data.ELEM_Nombre}</b>
                                </div>
                                <div class="col-7">
                                    <img class="img-thumbnail rounded mx-auto d-block" width="50%" src="${data.Valor}">
                                </div>
                                <div class="col-2 d-flex justify-content-center">
                                    <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" onchange="seleccionElemento(event,${data.ELEM_Id})" id="flexSwitchCheckChecked${data.ELEM_Id}" ${data.TipoActivacion == 0 ? '' : 'checked' }>
                                    </div>
                                </div>
                            </div>`;
                    break;
                    case 'T': 
                        contenedorFormulario.innerHTML += 
                            `<div class="row pb-2">
                                <div class="col-3">
                                    <b>${data.ELEM_Nombre}</b>
                                </div>
                                <div class="col-7">
                                    <input class="form-control form-control-sm" readonly type="text" autocomplete="off" name="${data.ELEM_ValorCampo}" id="${data.ELEM_ValorCampo}" placeholder="${data.Valor}">
                                </div>
                                <div class="col-2 d-flex justify-content-center">
                                    <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" onchange="seleccionElemento(event,${data.ELEM_Id})" id="flexSwitchCheckChecked${data.ELEM_Id}" ${data.TipoActivacion == 0 ? '' : 'checked' }>
                                    </div>
                                </div>
                            </div>`;
                    break;
                    case 'S': 
                        contenedorFormulario.innerHTML += 
                            `<div class="row pb-2">
                                <div class="col-3">
                                    <b>${data.ELEM_Nombre}</b>
                                </div>
                                <div class="col-7">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" disabled name="${data.ELEM_ValorCampo}" id="${data.ELEM_ValorCampo}" >
                                        <option value="${data.ELEM_ValorAuxiliar}" hidden>${data.Valor}</option>
                                    </select>
                                </div>
                                <div class="col-2 d-flex justify-content-center">
                                    <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" onchange="seleccionElemento(event,${data.ELEM_Id})" id="flexSwitchCheckChecked${data.ELEM_Id}" ${data.TipoActivacion == 0 ? '' : 'checked' }>
                                    </div>
                                </div>
                            </div>`;
                    break;
                    case 'C': 
                        contenedorFormulario.innerHTML += 
                            `<div class="row pb-2">
                                <div class="col-3">
                                    <b>${data.ELEM_Nombre}</b>
                                </div>
                                <div class="col-7">
                                    <div class="form-check">
                                        <input class="form-check-input" id="${data.ELEM_ValorCampo}" type="checkbox" value="yes" name="${data.ELEM_ValorCampo}" checked disabled>
                                            <label class="form-check-label">
                                                 ${data.Valor}   
                                            </label>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 d-flex justify-content-center">
                                    <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" onchange="seleccionElemento(event,${data.ELEM_Id})" id="flexSwitchCheckChecked${data.ELEM_Id}" ${data.TipoActivacion == 0 ? '' : 'checked' }>
                                    </div>
                                </div>
                            </div>`;
                    break;
                    default: ''
                }
                
            })
        }).catch(error => alert(error))
    });

    function seleccionElemento(event,ELEM_Id) {
        const {checked} = event.target; 
        var token = document.head.querySelector("[name='csrf-token'][content]").content;
        let formData = new FormData();
            formData.append('FORM_Id', selectorTipoFormulario.value);
            formData.append('ELEM_Id', ELEM_Id);

        if(checked) {
            let url = "{{ route('landing.store') }}";
            fetch(url, {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-Token": token,
                },
            })
            .then((res) => res.text())
            .then(response => {
                let rspta = JSON.parse(response);
                
            }).catch(error => console.log(error))
        } else {
            let url = "{{ route('landing.destroy', 0) }}";
            fetch(url + '?'+ new URLSearchParams({
                    FORM_Id: selectorTipoFormulario.value,
                    ELEM_Id: ELEM_Id,
                }), {
                method: "DELETE",
                headers: {
                    "X-CSRF-Token": token,
                },
            })
            .then((res) => res.text())
            .then(response => {
                let rspta = JSON.parse(response);
                
            }).catch(error => console.log(error))
        }
    }
    

</script>
@stop
@endsection

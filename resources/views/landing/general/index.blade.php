@extends('layouts.landing')
@section('titulo', 'General')
@section('contenido')

@if (isset($portada))
    <div class="wrap-login100-img" id="oculto">
        <img src="{{ asset($portada->elemento->ELEM_ValorGeneral) }}">
    </div>
@endif

<div class="wrap-login100" id="formulario" style="border:1px solid #b8b5b5; box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.12); ">
    <form role="form" class="php-email-form login100-form validate-form">
        @foreach ($datos as $dato)
            @switch($dato->elemento->ELEM_Tipo)
                @case('L')
                    <span class="login100-form-title p-b-2 p-t-27">
                        {{ $dato->elemento->ELEM_ValorGeneral }}
                    </span>
                    @break

                @case('T')
                    <div class="wrap-input100 validate-input" style="border: none;	border-bottom: 2px solid #ff0000;">
                        <input class="input100" type="text" autocomplete="off" name="{{ $dato->elemento->ELEM_ValorCampo }}" id="{{ $dato->elemento->ELEM_ValorCampo }}" placeholder="{{ $dato->elemento->ELEM_ValorGeneral }}">
                        <span class="focus-input100" ><i class="{{ $dato->elemento->ELEM_Icono }}"></i></span>
                    </div><label id="lblError{{ $dato->elemento->ELEM_ValorCampo }}" class="invisible error"></label>
                    @break

                @case('S')
                    <div class="wrap-input100 validate-input" style="height: 72px;">	
                        <label for="{{ $dato->elemento->ELEM_ValorCampo }}" class="options">
                        <select class="select-css" name="{{ $dato->elemento->ELEM_ValorCampo }}" id="{{ $dato->elemento->ELEM_ValorCampo }}" onchange="traerDatosDistrito('{{ $dato->elemento->ELEM_ValorAuxiliar }}',this.value)">
                            <option value="" hidden>{{ $dato->elemento->ELEM_ValorGeneral }}</option>
                            @if($dato->elemento->ELEM_ValorAuxiliar === 'INGRESO')
                                <option value="dependiente">Dependiente</option>
                                <option value="independiente">Independiente</option>
                            @else
                                @foreach ($departamentos as $departamento)
                                <option value="{{ $departamento->DEPA_Valor }}">{{ $departamento->DEPA_Nombre }}</option>
                                @endforeach
                            @endif
                        </select>
                        </label>
                    </div>
                    <label id="lblError{{ $dato->elemento->ELEM_ValorCampo }}" class="invisible error"></label>
                    <div class="wrap-input100 validate-input" id="elemento_{{ $dato->elemento->ELEM_ValorAuxiliar }}" style="height: 72px;"></div>
                    <label id="lblErrordistrito_{{ $dato->elemento->ELEM_ValorAuxiliar }}" class="invisible error"></label>
                    @break

                @case('C')
                    <div>
                        <label class="contact100-form-checkbox" for="{{ $dato->elemento->ELEM_ValorCampo }}">
                        <input id="{{ $dato->elemento->ELEM_ValorCampo }}" type="checkbox" value="yes" name="{{ $dato->elemento->ELEM_ValorCampo }}">
                            @if($dato->elemento->ELEM_ValorAuxiliar === 'REF')
                                <a href="{{ asset('img/autorizacion.pdf') }}"  target="_blank">{{ $dato->elemento->ELEM_ValorGeneral }}</a>
                            @else
                                {{ $dato->elemento->ELEM_ValorGeneral }}
                            @endif
                        </label>
                    </div>
                    <label id="lblError{{ $dato->elemento->ELEM_ValorCampo }}" class="invisible error"></label></br>
                    @break

                @default
            @endswitch
        @endforeach

        <div class="container-login100-form-btn">
            <button class="login100-form-btn" id="btnContinuar" type="button">
                Continuar
            </button>
        </div>

        <label id="lblThanks" class="invisible gracias">
        </label>
    </form>
</div>

<div class="wrap-login100"  id="gracias" style="border:1px solid #b8b5b5; box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.12);display:none">
    <div class="wrap-login100-img2" style="background-image: url(img/gracias.svg);"></div>
</div>

@section('script-js')
<script type="text/javascript">
    document.getElementById("elemento_INGRESO").remove();
    document.getElementById("elemento_DEPARTAMENTO").style.display = 'none';
	function traerDatosDistrito(ELEM_ValorAuxiliar,valor)
    {
        let contenedorFormulario = document.getElementById("elemento_DEPARTAMENTO");
        if(ELEM_ValorAuxiliar === 'DEPARTAMENTO' && valor === 'lima' )
        {
            let token = document.head.querySelector("[name='csrf-token'][content]").content;
            let url = "{{ route('formularioLanding.show', 1) }}";
        
            fetch(url, {
                method: "GET",
                headers: {
                    "X-CSRF-Token": token,
                },
            })
            .then((res) => res.text())
            .then(response => {
                let rspta = JSON.parse(response);

                contenedorFormulario.innerHTML = ''; 
                let html = '';

                html += 
                `<label for="distrito" class="options">
                    <select class="select-css" name="distrito" id="distrito">
                    <option value="" hidden>Distrito</option>`;
                    
                    for(let i = 0; i<rspta.length;i++){
                        html += `<option value="${rspta[i].DIST_Valor}">${rspta[i].DIST_Nombre}</option>`; 
                    }

                html += `</select>`;
                html += `</label>`;
                contenedorFormulario.innerHTML = html;
                document.getElementById("elemento_DEPARTAMENTO").style.display = 'block';
            }).catch(error => alert(error))
        }
        else
        {
            document.getElementById("elemento_DEPARTAMENTO").style.display = 'none';
            contenedorFormulario.innerHTML = ''; 
        }
    }
    
    document.getElementById('btnContinuar').addEventListener('click', (event) => {
        var token = document.head.querySelector("[name='csrf-token'][content]").content;
        let tipoDepartamento = document.getElementById("departamento").value;
        let formData = new FormData();
            formData.append('dni', document.getElementById("dni").value);
            formData.append('correoElectronico', document.getElementById("correoElectronico").value);
            formData.append('numeroCelular', document.getElementById("numeroCelular").value);
            formData.append('tipoIngresos', document.getElementById("tipoIngresos").value);
            formData.append('departamento', document.getElementById("departamento").value);
            if(tipoDepartamento == 'lima'){
                formData.append('distrito', document.getElementById("distrito").value);
            }
            formData.append('acepto', document.getElementById("acepto").checked);
            formData.append('condiciones', document.getElementById("condiciones").checked);
      
            let url = "{{ route('formularioLanding.store') }}";
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

                document.getElementById("lblErrordistrito_INGRESO").remove();
                document.getElementById("lblErrordistrito_DEPARTAMENTO").style.display = 'none';
                
                if(rspta.status){
                    document.getElementById("gracias").style.display = "block";
                    document.getElementById("oculto").style.display = "none";
                    document.getElementById("formulario").style.display = "none";
                } else {
                    if(rspta.messages.dni != undefined){
                        lblErrordni.classList.remove('invisible');
                        lblErrordni.classList.add('visible'); 
                        lblErrordni.innerHTML = rspta.messages.dni[0];
                    } else {
                        lblErrordni.classList.remove('visible');
                        lblErrordni.classList.add('invisible'); 
                    }

                    if(rspta.messages.correoElectronico != undefined){
                        lblErrorcorreoElectronico.classList.remove('invisible');
                        lblErrorcorreoElectronico.classList.add('visible'); 
                        lblErrorcorreoElectronico.innerHTML = rspta.messages.correoElectronico[0];
                    } else {
                        lblErrorcorreoElectronico.classList.remove('visible');
                        lblErrorcorreoElectronico.classList.add('invisible'); 
                    }

                    if(rspta.messages.numeroCelular != undefined){
                        lblErrornumeroCelular.classList.remove('invisible');
                        lblErrornumeroCelular.classList.add('visible'); 
                        lblErrornumeroCelular.innerHTML = rspta.messages.numeroCelular[0];
                    } else {
                        lblErrornumeroCelular.classList.remove('visible');
                        lblErrornumeroCelular.classList.add('invisible'); 
                    }

                    if(rspta.messages.tipoIngresos != undefined){
                        lblErrortipoIngresos.classList.remove('invisible');
                        lblErrortipoIngresos.classList.add('visible'); 
                        lblErrortipoIngresos.innerHTML = rspta.messages.tipoIngresos[0];
                    } else {
                        lblErrortipoIngresos.classList.remove('visible');
                        lblErrortipoIngresos.classList.add('invisible'); 
                    }

                    if(rspta.messages.departamento != undefined){
                        lblErrordepartamento.classList.remove('invisible');
                        lblErrordepartamento.classList.add('visible'); 
                        lblErrordepartamento.innerHTML = rspta.messages.departamento[0];
                    } else {
                        lblErrordepartamento.classList.remove('visible');
                        lblErrordepartamento.classList.add('invisible'); 
                    }

                    if(rspta.messages.acepto != undefined){
                        lblErroracepto.classList.remove('invisible');
                        lblErroracepto.classList.add('visible'); 
                        lblErroracepto.innerHTML = rspta.messages.acepto[0];
                    } else {
                        lblErroracepto.classList.remove('visible');
                        lblErroracepto.classList.add('invisible'); 
                    }

                    if(rspta.messages.condiciones != undefined){
                        lblErrorcondiciones.classList.remove('invisible');
                        lblErrorcondiciones.classList.add('visible'); 
                        lblErrorcondiciones.innerHTML = rspta.messages.condiciones[0];
                    } else {
                        lblErrorcondiciones.classList.remove('visible');
                        lblErrorcondiciones.classList.add('invisible'); 
                    }

                    if(document.getElementById("departamento").value == 'lima'){
                        if(rspta.messages.distrito != undefined){
                            document.getElementById("lblErrordistrito_DEPARTAMENTO").style.display = 'block';
                            document.getElementById("lblErrordistrito_DEPARTAMENTO").classList.remove('invisible');
                            document.getElementById("lblErrordistrito_DEPARTAMENTO").classList.add('visible'); 
                            document.getElementById("lblErrordistrito_DEPARTAMENTO").innerHTML = rspta.messages.distrito[0];
                        } else {
                            document.getElementById("lblErrordistrito_DEPARTAMENTO").classList.remove('visible');
                            document.getElementById("lblErrordistrito_DEPARTAMENTO").classList.add('invisible'); 
                        }
                    }
                }
                
            }).catch(error => console.log(error))
    });

</script>
@stop
@endsection
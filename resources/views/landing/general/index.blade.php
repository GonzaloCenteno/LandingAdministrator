@extends('layouts.landing')
@section('titulo', 'General')
@section('contenido')

<div id=portada class="oculto">
@if (isset($portada))
    <div class="wrap-login100-img" >
        <img src="{{ asset($portada->elemento->ELEM_ValorGeneral) }}">
    </div>
@endif
</div>

<div id=portadaMovil class="oculto">
@if (isset($portadaMovil))
    <div class="wrap-login100-img">
        <img src="{{ asset($portadaMovil->elemento->ELEM_ValorGeneral) }}">
    </div>
@endif
</div>

<div class="wrap-login100 oculto" id="formulario" style="border:1px solid #b8b5b5; box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.12); ">
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
                        <span class="focus-input100" ><i class="fa-solid {{ $dato->elemento->icono[1] }}"></i></span>
                    </div><label id="lblError{{ $dato->elemento->ELEM_ValorCampo }}" class="invisible error"></label>
                    @break

                @case('S')
                    <div class="wrap-input100 validate-input" style="height: 72px;">	
                        <label for="{{ $dato->elemento->ELEM_ValorCampo }}" class="options">
                        <select class="select-css" name="{{ $dato->elemento->ELEM_ValorCampo }}" id="{{ $dato->elemento->ELEM_ValorCampo }}" @if($dato->elemento->ELEM_ValorAuxiliar === 'DEPARTAMENTO') onchange="traerDatosDistrito('{{ $dato->elemento->ELEM_ValorAuxiliar }}',this.value)" @endif>
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
                    <label id="lblError{{ $dato->elemento->ELEM_ValorCampo }}" class="invisible error pt-0 mt-0"></label>
                    <div class="wrap-input100 validate-input" id="elemento_{{ $dato->elemento->ELEM_ValorAuxiliar }}" style="height: 72px;"></div>
                    <label id="lblErrordistrito_{{ $dato->elemento->ELEM_ValorAuxiliar }}" class="invisible error pt-0 mt-0"></label>
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
    
    let portada = document.getElementById("portada");
    let portadaMovil = document.getElementById("portadaMovil");

    const esMovil = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
    if (esMovil) {
        portadaMovil.style.display = 'block';
        portada.style.display = 'none';
    }
    else
    {
        portada.style.display = 'block';
        portadaMovil.style.display = 'none';
    }

    if(document.getElementById("elemento_INGRESO") != null)
    {
        document.getElementById("elemento_INGRESO").remove();
    }
    if(document.getElementById("elemento_DEPARTAMENTO") != null)
    {
        document.getElementById("elemento_DEPARTAMENTO").style.display = 'none';
    }

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
        let Rdni = document.getElementById("dni");
        let RcorreoElectronico = document.getElementById("correoElectronico");
        let RnumeroCelular = document.getElementById("numeroCelular");
        let RnombrePersona = document.getElementById("nombrePersona");
        let RtextoAdicional = document.getElementById("textoAdicional");
        let RtipoIngresos = document.getElementById("tipoIngresos");
        let Rdepartamento = document.getElementById("departamento");
        let Racepto = document.getElementById("acepto");
        let Rcondiciones = document.getElementById("condiciones");
        
        let formData = new FormData();
            if(Rdni != null) {
                formData.append('dni', Rdni.value);
            }

            if(RcorreoElectronico != null) {
                formData.append('correoElectronico', RcorreoElectronico.value);
            }

            if(RnumeroCelular != null) {
                formData.append('numeroCelular', RnumeroCelular.value);
            }

            if(RnombrePersona != null) {
                formData.append('nombrePersona', RnombrePersona.value);
            }

            if(RtextoAdicional != null) {
                formData.append('textoAdicional', RtextoAdicional.value);
            }

            if(RtipoIngresos != null) {
                formData.append('tipoIngresos', RtipoIngresos.value);
            }
            
            if(Rdepartamento != null) {
                formData.append('departamento', Rdepartamento.value);

                if(Rdepartamento.value == 'lima'){
                    formData.append('distrito', document.getElementById("distrito").value);
                }
            }

            if(Racepto != null) {
                formData.append('acepto', Racepto.checked);
            }

            if(Rcondiciones != null) {
                formData.append('condiciones', Rcondiciones.checked);
            }
      
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

                if(document.getElementById("lblErrordistrito_INGRESO") != null)
                {
                    document.getElementById("lblErrordistrito_INGRESO").style.display = 'none';
                }

                if(document.getElementById("lblErrordistrito_DEPARTAMENTO") != null)
                {
                    document.getElementById("lblErrordistrito_DEPARTAMENTO").style.display = 'none';
                }
                
                if(rspta.status){
                    document.getElementById("gracias").style.display = "block";
                    document.getElementsByClassName("oculto")[0].style.display = "none";
                    document.getElementById("formulario").style.display = "none";
                } else {
                    if(rspta.messages.dni != undefined){
                        document.getElementById("lblErrordni").classList.remove('invisible');
                        document.getElementById("lblErrordni").classList.add('visible'); 
                        document.getElementById("lblErrordni").innerHTML = rspta.messages.dni[0];
                    } else {
                        if(Rdni != null) {
                            document.getElementById("lblErrordni").classList.remove('visible');
                            document.getElementById("lblErrordni").classList.add('invisible'); 
                        }
                    }

                    if(rspta.messages.correoElectronico != undefined){
                        document.getElementById("lblErrorcorreoElectronico").classList.remove('invisible');
                        document.getElementById("lblErrorcorreoElectronico").classList.add('visible'); 
                        document.getElementById("lblErrorcorreoElectronico").innerHTML = rspta.messages.correoElectronico[0];
                    } else {
                        if(RcorreoElectronico != null) {
                            document.getElementById("lblErrorcorreoElectronico").classList.remove('visible');
                            document.getElementById("lblErrorcorreoElectronico").classList.add('invisible'); 
                        }   
                    }

                    if(rspta.messages.numeroCelular != undefined){
                        document.getElementById("lblErrornumeroCelular").classList.remove('invisible');
                        document.getElementById("lblErrornumeroCelular").classList.add('visible'); 
                        document.getElementById("lblErrornumeroCelular").innerHTML = rspta.messages.numeroCelular[0];
                    } else {
                        if(RnumeroCelular != null) {
                            document.getElementById("lblErrornumeroCelular").classList.remove('visible');
                            document.getElementById("lblErrornumeroCelular").classList.add('invisible'); 
                        }
                    }

                    if(rspta.messages.tipoIngresos != undefined){
                        document.getElementById("lblErrortipoIngresos").classList.remove('invisible');
                        document.getElementById("lblErrortipoIngresos").classList.add('visible'); 
                        document.getElementById("lblErrortipoIngresos").innerHTML = rspta.messages.tipoIngresos[0];
                    } else {
                        if(RtipoIngresos != null) {
                            document.getElementById("lblErrortipoIngresos").classList.remove('visible');
                            document.getElementById("lblErrortipoIngresos").classList.add('invisible'); 
                        }
                    }

                    if(rspta.messages.departamento != undefined){
                        document.getElementById("lblErrordepartamento").classList.remove('invisible');
                        document.getElementById("lblErrordepartamento").classList.add('visible'); 
                        document.getElementById("lblErrordepartamento").innerHTML = rspta.messages.departamento[0];
                    } else {
                        if(Rdepartamento != null) {
                            document.getElementById("lblErrordepartamento").classList.remove('visible');
                            document.getElementById("lblErrordepartamento").classList.add('invisible'); 
                        }
                    }

                    if(rspta.messages.nombrePersona != undefined){
                        document.getElementById("lblErrornombrePersona").classList.remove('invisible');
                        document.getElementById("lblErrornombrePersona").classList.add('visible'); 
                        document.getElementById("lblErrornombrePersona").innerHTML = rspta.messages.nombrePersona[0];
                    } else {
                        if(RnombrePersona != null) {
                            document.getElementById("lblErrornombrePersona").classList.remove('visible');
                            document.getElementById("lblErrornombrePersona").classList.add('invisible'); 
                        }
                    }
                    
                    if(rspta.messages.textoAdicional != undefined){
                        document.getElementById("lblErrortextoAdicional").classList.remove('invisible');
                        document.getElementById("lblErrortextoAdicional").classList.add('visible'); 
                        document.getElementById("lblErrortextoAdicional").innerHTML = rspta.messages.textoAdicional[0];
                    } else {
                        if(RtextoAdicional != null) {
                            document.getElementById("lblErrortextoAdicional").classList.remove('visible');
                            document.getElementById("lblErrortextoAdicional").classList.add('invisible'); 
                        }
                    }

                    if(rspta.messages.acepto != undefined){
                        document.getElementById("lblErroracepto").classList.remove('invisible');
                        document.getElementById("lblErroracepto").classList.add('visible'); 
                        document.getElementById("lblErroracepto").innerHTML = rspta.messages.acepto[0];
                    } else {
                        if(Racepto != null) {
                            document.getElementById("lblErroracepto").classList.remove('visible');
                            document.getElementById("lblErroracepto").classList.add('invisible'); 
                        }
                    }

                    if(rspta.messages.condiciones != undefined){
                        document.getElementById("lblErrorcondiciones").classList.remove('invisible');
                        document.getElementById("lblErrorcondiciones").classList.add('visible'); 
                        document.getElementById("lblErrorcondiciones").innerHTML = rspta.messages.condiciones[0];
                    } else {
                        if(Rcondiciones != null) {
                            document.getElementById("lblErrorcondiciones").classList.remove('visible');
                            document.getElementById("lblErrorcondiciones").classList.add('invisible'); 
                        }   
                    }

                    if(document.getElementById("departamento").value == 'lima'){
                        if(rspta.messages.distrito != undefined){
                            document.getElementById("lblErrordistrito_DEPARTAMENTO").style.display = 'block';
                            document.getElementById("lblErrordistrito_DEPARTAMENTO").classList.remove('invisible');
                            document.getElementById("lblErrordistrito_DEPARTAMENTO").classList.add('visible'); 
                            document.getElementById("lblErrordistrito_DEPARTAMENTO").innerHTML = rspta.messages.distrito[0];
                        } else {
                            document.getElementById("lblErrordistrito_DEPARTAMENTO").style.display = 'none';
                            document.getElementById("lblErrordistrito_DEPARTAMENTO").classList.add('invisible'); 
                        }
                    }
                }
                
            }).catch(error => console.log(error))
    });

</script>
@stop
@endsection
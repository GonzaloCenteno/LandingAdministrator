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
                    </div><label id="lblErrorDni" class="invisible error"></label>
                    @break

                @case('S')
                    <div class="wrap-input100 validate-input" style="height: 72px;">	
                        <label for="{{ $dato->elemento->ELEM_ValorCampo }}" class="options">
                        <select class="select-css" name="{{ $dato->elemento->ELEM_ValorCampo }}" id="{{ $dato->elemento->ELEM_ValorCampo }}" onchange="traerDatosDistrito({{ $dato->elemento->ELEM_ValorAuxiliar }})">
                            <option value="{{ $dato->elemento->ELEM_ValorAuxiliar }}" hidden>{{ $dato->elemento->ELEM_ValorGeneral }}</option>
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
                    <label id="lblErrorIngresos" class="invisible error"></label>
                    @break

                @case('C')
                    <div>
                        <label class="contact100-form-checkbox" for="{{ $dato->elemento->ELEM_ValorCampo }}">
                        <input id="{{ $dato->elemento->ELEM_ValorCampo }}" type="checkbox" value="yes" name="{{ $dato->elemento->ELEM_ValorCampo }}">
                            @if($dato->elemento->ELEM_ValorAuxiliar === 'REF')
                                <a href="autorizacion.pdf"  target="_blank">{{ $dato->elemento->ELEM_ValorGeneral }}</a>
                            @else
                                {{ $dato->elemento->ELEM_ValorGeneral }}
                            @endif
                        </label>
                    </div>
                    <label id="lblErrorOtros" class="invisible error"></label></br>
                    @break

                @default
            @endswitch
        @endforeach

        <div class="container-login100-form-btn">
            <button class="login100-form-btn" id="continuar" type="button">
                Continuar
            </button>
        </div>

        <label id="lblThanks" class="invisible gracias">
        </label>
    </form>
</div>

<div class="wrap-login100"  id="gracias" style="border:1px solid #b8b5b5; box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.12); ">
    <div class="wrap-login100-img2" style="background-image: url(img/gracias.svg);"></div>
</div>
@section('script-js')
<script type="text/javascript">
    
	var x = document.getElementById("formulario");
	var y = document.getElementById("gracias");
	var z = document.getElementById("oculto");

	x.style.display = "block";
	y.style.display = "none";
	z.style.display = "block";


    const btnContinuar = document.getElementById("continuar");
    const lblThanks = document.getElementById("lblThanks");
    const lblErrorDni = document.getElementById("lblErrorDni");
    const lblErrorCorreo = document.getElementById("lblErrorCorreo");
    const lblErrorCelular = document.getElementById("lblErrorCelular");
    const lblErrorCondiciones = document.getElementById("lblErrorCondiciones");
    const lblErrorOtros = document.getElementById("lblErrorOtros");
    const lblErrorIngresos = document.getElementById("lblErrorIngresos");
    const lblErrorDepartamento = document.getElementById("lblErrorDepartamento");


    btnContinuar.addEventListener("click", function () {
        const dni = document.getElementById("dni");
        const correo = document.getElementById("correo");
        const celular = document.getElementById("celular");
        const condiciones = document.getElementById("condiciones");
        const otros = document.getElementById("otros");
        const departamento = document.getElementById("departamento");
        const ingresos = document.getElementById("ingresos");
        lblThanks.classList.remove('visible');
        lblThanks.classList.add('invisible');
        

        var url = './forms/contact.php';

        let formData = new FormData();
        formData.append('dni', dni.value);
        formData.append('correo', correo.value);
        formData.append('celular', celular.value);
        formData.append('condiciones', condiciones.checked);
        formData.append('otros', otros.checked);
        formData.append('departamento', departamento.value);
        formData.append('ingresos', ingresos.value);
        

        fetch(url, {
            method: "POST",
            body: formData
        })
        .then((res) => res.text())
        .then(response => {
            let rspta = JSON.parse(response);
            if(rspta.success){
                document.getElementById("dni").value = '';
                document.getElementById("correo").value = '';
                document.getElementById("celular").value = '';
                document.getElementById("condiciones").checked = false;
                document.getElementById("otros").checked = false;
                document.getElementById("ingresos").value = 'ingresos';
                document.getElementById("departamento").value = 'departamento';
                lblThanks.classList.remove('invisible');
                lblThanks.classList.add('visible');
                lblErrorDni.classList.remove('visible');
                lblErrorDni.classList.add('invisible'); 
                lblErrorCorreo.classList.remove('visible');
                lblErrorCorreo.classList.add('invisible'); 
                lblErrorCelular.classList.remove('visible');
                lblErrorCelular.classList.add('invisible');
                lblErrorCondiciones.classList.remove('visible');
                lblErrorCondiciones.classList.add('invisible'); 
                lblErrorOtros.classList.remove('visible');
                lblErrorOtros.classList.add('invisible'); 
                lblErrorDepartamento.classList.remove('visible');
                lblErrorDepartamento.classList.add('invisible'); 
                lblErrorIngresos.classList.remove('visible');
                lblErrorIngresos.classList.add('invisible'); 

                x.style.display = "none";
                y.style.display = "block";
                z.style.display = "none";


                
            } else {
                let errors = rspta.errors;
                if(errors.dni != undefined) { 
                    lblErrorDni.classList.remove('invisible');
                    lblErrorDni.classList.add('visible'); 
                    lblErrorDni.innerHTML = errors.dni;
                } else {
                    lblErrorDni.classList.remove('visible');
                    lblErrorDni.classList.add('invisible'); 
                }
                if(errors.correo != undefined) { 
                    lblErrorCorreo.classList.remove('invisible');
                    lblErrorCorreo.classList.add('visible'); 
                    lblErrorCorreo.innerHTML = errors.correo;
                } else {
                    lblErrorCorreo.classList.remove('visible');
                    lblErrorCorreo.classList.add('invisible'); 
                }
                if(errors.celular != undefined) { 
                    lblErrorCelular.classList.remove('invisible');
                    lblErrorCelular.classList.add('visible'); 
                    lblErrorCelular.innerHTML = errors.celular;
                } else {
                    lblErrorCelular.classList.remove('visible');
                    lblErrorCelular.classList.add('invisible'); 
                }
                if(errors.condiciones != undefined) { 
                    lblErrorCondiciones.classList.remove('invisible');
                    lblErrorCondiciones.classList.add('visible'); 
                    lblErrorCondiciones.innerHTML = errors.condiciones;
                } else {
                    lblErrorCondiciones.classList.remove('visible');
                    lblErrorCondiciones.classList.add('invisible'); 
                }
                if(errors.otros != undefined) { 
                    lblErrorOtros.classList.remove('invisible');
                    lblErrorOtros.classList.add('visible'); 
                    lblErrorOtros.innerHTML = errors.otros;
                } else {
                    lblErrorOtros.classList.remove('visible');
                    lblErrorOtros.classList.add('invisible'); 
                }
                if(errors.departamento != undefined) { 
                    lblErrorDepartamento.classList.remove('invisible');
                    lblErrorDepartamento.classList.add('visible'); 
                    lblErrorDepartamento.innerHTML = errors.departamento;
                } else {
                    lblErrorDepartamento.classList.remove('visible');
                    lblErrorDepartamento.classList.add('invisible'); 
                }
                if(errors.ingresos != undefined) { 
                    lblErrorIngresos.classList.remove('invisible');
                    lblErrorIngresos.classList.add('visible'); 
                    lblErrorIngresos.innerHTML = errors.ingresos;
                } else {
                    lblErrorIngresos.classList.remove('visible');
                    lblErrorIngresos.classList.add('invisible'); 
                }
            }	
        }).catch(error => console.log(error))
    });

</script>
@stop
@endsection
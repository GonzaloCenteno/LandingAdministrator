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
        <div class="col-3">
            <button type="button" id="btnModificarFormulario" class="btn btn-sm btn-secondary">Modificar Formulario</button>
        </div>

        <div class="modal fade" id="modalFormulario" tabindex="-1" aria-labelledby="modalFormularioLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalFormularioLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="titulo" class="col-form-label">Titulo:</label>
                            <input type="text" class="form-control" id="txttitulo" name="txttitulo">
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="col-form-label">Texto DNI:</label>
                            <input type="text" class="form-control" id="txtDni" name="txtDni">
                        </div>
                        <div class="mb-3">
                        <select class="fontawesomeSelect">
     <option value='fa-500px'>&#xf26e; fa-500px</option>
		<option value='fa-address-book'>&#xf2b9; fa-address-book</option>

                        </div>
                        <div class="mb-3">
                            <label for="correoElectronico" class="col-form-label">Texto Correo Electronico:</label>
                            <input type="text" class="form-control" id="txtCorreoElectronico" name="txtCorreoElectronico">
                        </div>
                        <div class="mb-3">
                            <label for="numeroCelular" class="col-form-label">Texto Numero Celular:</label>
                            <input type="text" class="form-control" id="txtNumeroCelular" name="txtNumeroCelular">
                        </div>
                        <div class="mb-3">
                            <label for="numeroCelular" class="col-form-label">Texto Nombre Persona:</label>
                            <input type="text" class="form-control" id="txtNombrePersona" name="txtNombrePersona">
                        </div>
                        <div class="mb-3">
                            <label for="numeroCelular" class="col-form-label">Texto Adicional:</label>
                            <input type="text" class="form-control" id="txtTextoAdicional" name="txtTextoAdicional">
                        </div>
                        <div class="mb-3">
                            <img id="imgPortada" class="img-thumbnail rounded mx-auto d-block" width="20%">
                        </div>
                        <div class="mb-3">
                            <label for="imgPrincipal" class="form-label">Imagen Portada:</label>
                            <input class="form-control" type="file" id="imgPrincipal" name="imgPrincipal" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" id="guardarFormulario" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script-js')
<script type="text/javascript">
    var selectorTipoFormulario = document.getElementById('tipoFormulario');
    var modalFormulario = new bootstrap.Modal(document.getElementById("modalFormulario"), { backdrop: false, focus: false});
    var modalFormularioLabel = document.getElementById('modalFormularioLabel');
    
    document.getElementById('btnModificarFormulario').addEventListener('click', (event) => {
        let token = document.head.querySelector("[name='csrf-token'][content]").content;
        let tipoFormulario = selectorTipoFormulario.value;
        let titulo = document.getElementById('txttitulo');
        let txtDni = document.getElementById('txtDni');
        let txtCorreoElectronico = document.getElementById('txtCorreoElectronico');
        let txtNumeroCelular = document.getElementById('txtNumeroCelular');
        let imgPortada = document.getElementById('imgPortada');
        let txtTextoAdicional = document.getElementById('txtTextoAdicional');
        let txtNombrePersona = document.getElementById('txtNombrePersona');
        
        if(tipoFormulario == 0) { return false;}

        let url = "{{ route('formulario.show', 'value') }}";
            url = url.replace('value', selectorTipoFormulario.value);
        
        fetch(url, {
            method: "GET",
            headers: {
                "X-CSRF-Token": token,
            },
        })
        .then((res) => res.text())
        .then(response => {
            let rspta = JSON.parse(response);

            if(!rspta) { return false; }

            if(selectorTipoFormulario.value == 1) {
                modalFormularioLabel.innerHTML = 'Formulario General';
            } else if (selectorTipoFormulario.value == 2) {
                modalFormularioLabel.innerHTML = 'Formulario Ahorros';
            } else if (selectorTipoFormulario.value == 3) {
                modalFormularioLabel.innerHTML = 'Formulario Créditos';
            }
            
            rspta.forEach(function(data) {
                console.log(data);
                switch (data.ELEM_Tipo) {
                    case 'L': 
                        titulo.value = data.Valor;
                    break;
                    case 'T': 
                        if(data.ELEM_Id == 3) {
                            txtDni.value = data.Valor;
                        } else if (data.ELEM_Id == 4) {
                            txtCorreoElectronico.value = data.Valor;
                        } else if (data.ELEM_Id == 5) {
                            txtNumeroCelular.value = data.Valor;
                        } else if (data.ELEM_Id == 6) {
                            txtNombrePersona.value = data.Valor;
                        } else if (data.ELEM_Id == 7) {
                            txtTextoAdicional.value = data.Valor;
                        }
                    break;
                    case 'I': 
                        imgPortada.src = data.Valor;
                    break;
                    default: ''
                }
            })
            modalFormulario.show();
        }).catch(error => alert(error))
    });

    document.getElementById('guardarFormulario').addEventListener('click', (event) => {
        var token = document.head.querySelector("[name='csrf-token'][content]").content;
        let titulo = document.getElementById('txttitulo');
        let imgPrincipal = document.getElementById('imgPrincipal');
        let txtDni = document.getElementById('txtDni');
        let txtCorreoElectronico = document.getElementById('txtCorreoElectronico');
        let txtNumeroCelular = document.getElementById('txtNumeroCelular');
        let txtTextoAdicional = document.getElementById('txtTextoAdicional');
        let txtNombrePersona = document.getElementById('txtNombrePersona');

        let formData = new FormData();
            formData.append('FORM_Id', selectorTipoFormulario.value);
            formData.append('titulo', titulo.value);
            formData.append('dni', txtDni.value);
            formData.append('correoElectronico', txtCorreoElectronico.value);
            formData.append('numeroCelular', txtNumeroCelular.value);
            formData.append('imagen', imgPrincipal.files[0]);
            formData.append('nombrePersona', txtNombrePersona.value);
            formData.append('textoAdicional', txtTextoAdicional.value);
        
        let url = "{{ route('formulario.store') }}";
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
            document.getElementById('txttitulo').value = '';
            document.getElementById('imgPrincipal').value = '';
            if(rspta.status){
                modalFormulario.hide();
            }
            
        }).catch(error => console.log(error))
    });
    
</script>
@stop
@endsection

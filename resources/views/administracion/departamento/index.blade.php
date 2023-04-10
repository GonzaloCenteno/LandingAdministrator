@extends('layouts.app')

@section('contenido')
<div class="container">
    <div class="col-3">
        <button type="button" id="btnNuevoDepartamento" class="btn btn-sm btn-secondary">Crear Departamento</button>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <table class="table table-sm table-hover">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre Departamento</th>
                <th scope="col">Valor Departamento</th>
                <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departamentos as $departamento)
                    <tr>
                        <th scope="row">{{ $departamento->DEPA_Id }}</th>
                        <th scope="row">{{ $departamento->DEPA_Nombre }}</th>
                        <th scope="row">{{ $departamento->DEPA_Valor }}</th>
                        <th scope="row">
                            <div class="d-grid gap-2 d-md-block">
                                <button class="btn btn-outline-primary btn-sm" onclick="editarDepartamento({{ $departamento->DEPA_Id }})" type="button">Editar</button>
                                <button class="btn btn-outline-danger btn-sm" onclick="eliminarDepartamento({{ $departamento->DEPA_Id }})" type="button">Eliminar</button>
                            </div>
                        </th>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>

        <div class="modal fade" id="modalDepartamento" tabindex="-1" aria-labelledby="modalFormularioLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalFormularioLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="Nombre" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="txtNombre" name="txtNombre" autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="Valor" class="col-form-label">Valor:</label>
                            <input type="text" class="form-control" id="txtValor" name="txtValor" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" id="modificarDepartamento" class="btn btn-primary">Modificar</button>
                        <button type="button" id="crearDepartamento" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script-js')
<script type="text/javascript">
    var modalDepartamento = new bootstrap.Modal(document.getElementById("modalDepartamento"), { backdrop: false, focus: false});
    var modalFormularioLabel = document.getElementById('modalFormularioLabel');
    var modificarDepartamento = document.getElementById('modificarDepartamento');
    var crearDepartamento = document.getElementById('crearDepartamento');
    var nombre = document.getElementById('txtNombre');
    var valor = document.getElementById('txtValor');
    var id = 0;

    function editarDepartamento(DEPA_Id)
    {
        let token = document.head.querySelector("[name='csrf-token'][content]").content;

        let url = "{{ route('departamento.show', 'value') }}";
            url = url.replace('value', DEPA_Id);
        
        fetch(url, {
            method: "GET",
            headers: {
                "X-CSRF-Token": token,
            },
        })
        .then((res) => res.text())
        .then(response => {
            let rspta = JSON.parse(response);
            modalFormularioLabel.innerHTML = 'EDITAR DEPARTAMENTO';
            nombre.value = rspta.DEPA_Nombre;
            valor.value = rspta.DEPA_Valor;
            id = rspta.DEPA_Id
            modalDepartamento.show();
            crearDepartamento.style.display = 'none';
            modificarDepartamento.style.display = 'block';
        }).catch(error => alert(error))
    }

    document.getElementById('modificarDepartamento').addEventListener('click', (event) => {
        let token = document.head.querySelector("[name='csrf-token'][content]").content;
        
        let url = "{{ route('departamento.update', 'value') }}";
            url = url.replace('value', id);

        fetch(url +'?'+ new URLSearchParams({
                DEPA_Nombre: nombre.value,
                DEPA_Valor: valor.value,
            }), {
            method: "PUT",
            headers: {
                "X-CSRF-Token": token
            },
        })
        .then((res) => res.text())
        .then(response => {
            let rspta = JSON.parse(response);
            if(rspta.status){
                location.reload();
                return false;
            }
            
        }).catch(error => console.log(error))
    });

    function eliminarDepartamento(DEPA_Id)
    {
        let token = document.head.querySelector("[name='csrf-token'][content]").content;

        let url = "{{ route('departamento.destroy', 'value') }}";
            url = url.replace('value', DEPA_Id);
        fetch(url, {
            method: "DELETE",
            headers: {
                "X-CSRF-Token": token,
            },
        })
        .then((res) => res.text())
        .then(response => {
            location.reload();
            return false;
        }).catch(error => console.log(error))
    }

    document.getElementById('btnNuevoDepartamento').addEventListener('click', (event) => {
        modalDepartamento.show();
        modalFormularioLabel.innerHTML = 'CREAR DEPARTAMENTO';
        crearDepartamento.style.display = 'block';
        modificarDepartamento.style.display = 'none';
        nombre.value = '';
        valor.value = '';
    });

    document.getElementById('crearDepartamento').addEventListener('click', (event) => {
        let token = document.head.querySelector("[name='csrf-token'][content]").content;
        
        let formData = new FormData();
            formData.append('DEPA_Nombre', nombre.value);
            formData.append('DEPA_Valor', valor.value);

        let url = "{{ route('departamento.store') }}";
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
            if(rspta.status){
                location.reload();
                return false;
            }
        }).catch(error => console.log(error))
    });
</script>
@stop
@endsection

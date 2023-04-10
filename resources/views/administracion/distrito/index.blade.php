@extends('layouts.app')

@section('contenido')
<div class="container">
    <div class="col-3">
        <button type="button" id="btnNuevoDistrito" class="btn btn-sm btn-secondary">Crear Distrito</button>
    </div>
    <div class="row justify-content-center">
        <input type="hidden" id="idDepartamento" value="{{ $departamento->DEPA_Id }}">
        <div class="col-12">
            <table class="table table-sm table-hover">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Departamento</th>
                <th scope="col">Nombre Distrito</th>
                <th scope="col">Valor Distrito</th>
                <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($distritos as $distrito)
                    <tr>
                        <th scope="row">{{ $distrito->DIST_Id }}</th>
                        <th scope="row">{{ $distrito->departamento->DEPA_Nombre }}</th>
                        <th scope="row">{{ $distrito->DIST_Nombre }}</th>
                        <th scope="row">{{ $distrito->DIST_Valor }}</th>
                        <th scope="row">
                            <div class="d-grid gap-2 d-md-block">
                                <button class="btn btn-outline-primary btn-sm" onclick="editarDistrito({{ $distrito->DIST_Id }})" type="button">Editar</button>
                                <button class="btn btn-outline-danger btn-sm" onclick="eliminarDistrito({{ $distrito->DIST_Id }})" type="button">Eliminar</button>
                            </div>
                        </th>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>

        <div class="modal fade" id="modalDistrito" tabindex="-1" aria-labelledby="modalFormularioLabel" aria-hidden="true">
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
                        <button type="button" id="modificarDistrito" class="btn btn-primary">Modificar</button>
                        <button type="button" id="crearDistrito" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script-js')
<script type="text/javascript">
    var modalDistrito = new bootstrap.Modal(document.getElementById("modalDistrito"), { backdrop: false, focus: false});
    var modalFormularioLabel = document.getElementById('modalFormularioLabel');
    var modificarDistrito = document.getElementById('modificarDistrito');
    var crearDistrito = document.getElementById('crearDistrito');
    var nombre = document.getElementById('txtNombre');
    var valor = document.getElementById('txtValor');
    var idDepartamento = document.getElementById('idDepartamento');
    var id = 0;

    function editarDistrito(DIST_Id)
    {
        let token = document.head.querySelector("[name='csrf-token'][content]").content;

        let url = "{{ route('distrito.show', 'value') }}";
            url = url.replace('value', DIST_Id);
        
        fetch(url, {
            method: "GET",
            headers: {
                "X-CSRF-Token": token,
            },
        })
        .then((res) => res.text())
        .then(response => {
            let rspta = JSON.parse(response);
            modalFormularioLabel.innerHTML = 'EDITAR DISTRITO';
            nombre.value = rspta.DIST_Nombre;
            valor.value = rspta.DIST_Valor;
            id = rspta.DIST_Id
            modalDistrito.show();
            crearDistrito.style.display = 'none';
            modificarDistrito.style.display = 'block';
        }).catch(error => alert(error))
    }

    document.getElementById('modificarDistrito').addEventListener('click', (event) => {
        let token = document.head.querySelector("[name='csrf-token'][content]").content;

        let url = "{{ route('distrito.update', 'value') }}";
            url = url.replace('value', id);

        fetch(url +'?'+ new URLSearchParams({
                DIST_Nombre: nombre.value,
                DIST_Valor: valor.value,
            }), {
            method: "PUT",
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

    function eliminarDistrito(DIST_Id)
    {
        let token = document.head.querySelector("[name='csrf-token'][content]").content;

        let url = "{{ route('distrito.destroy', 'value') }}";
            url = url.replace('value', DIST_Id);
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

    document.getElementById('btnNuevoDistrito').addEventListener('click', (event) => {
        modalDistrito.show();
        modalFormularioLabel.innerHTML = 'CREAR DISTRITO';
        crearDistrito.style.display = 'block';
        modificarDistrito.style.display = 'none';
        nombre.value = '';
        valor.value = '';
    });

    document.getElementById('crearDistrito').addEventListener('click', (event) => {
        let token = document.head.querySelector("[name='csrf-token'][content]").content;
        
        let formData = new FormData();
            formData.append('DIST_Nombre', nombre.value);
            formData.append('DIST_Valor', valor.value);
            formData.append('DEPA_Id', idDepartamento.value);

        let url = "{{ route('distrito.store') }}";
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

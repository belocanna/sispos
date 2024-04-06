<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0">Perfil</h2>
            </div>
            <div class="col sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
                    <li class="active"> / Perfil</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <!-- Small boxes (Stat box) -->
    <div class="card border-light">
        <div class="card-header bg-primary">
            <div class="row mb-1">
                <div class="col-md-10">
                    <h4 class='text-center'>Perfil del Usuario</h4>
                </div>
            </div>
            <br>
        </div>
        <div class="card-body">
            <form action="" id="frmEmpresa">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="hidden" name="" id="idEmpresa">
                                <label for="my-input">Numero de Identificacion</label>
                                <input id="documentoEmpresa" class="form-control" type="text" name="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="my-input">Nombre o Razon Social</label>
                                <input id="nombreEmpresa" class="form-control" type="text" name="" onkeyup="javascript:this.value=this.value.toUpperCase()">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="my-input">Direccion</label>
                                <input id="direccionEmpresa" class="form-control" type="text" name="" onkeyup="javascript:this.value=this.value.toUpperCase()">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="my-input">Telefono</label>
                                <input id="telefonoEmpresa" class="form-control" type="text" name="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="my-input">Correo Electronico</label>
                                <input id="correoEmpresa" class="form-control" type="text" name="" onkeyup="javascript:this.value=this.value.toLowerCase()">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="my-input">Ciudad</label>
                                <input id="ciudadEmpresa" class="form-control" type="text" name="" onkeyup="javascript:this.value=this.value.toUpperCase()">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="my-input">Responsable</label>
                                <input id="responsableEmpresa" class="form-control" type="text" name="" onkeyup="javascript:this.value=this.value.toUpperCase()">
                            </div>
                        </div>
                    </div>
                    <button type="button" id="btnGuardarEmpresa" class="btn btn-primary">Registrar Datos</button>
                </div>
            </form>
        </div>

    </div>

</div>

<script src="archivos/js/empresa.js"></script>
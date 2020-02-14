<div class="modal fade" id="modalExclusao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {{Form::open(['route'=>'pacientes.index', 'method' => 'DELETE'])}}
            <div class="modal-header modal-header-danger">Confirmar exclusão</div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button class="btn btn-danger btn-ok">Remover</button>
                <a type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
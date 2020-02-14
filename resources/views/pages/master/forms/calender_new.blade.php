<div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Nova consulta</h4>
            </div>
            {!! Form::open(['route' => 'consultas.store',
                'id' => 'antoform',
                'class' => 'form-horizontal form-label-left', 'data-parsley-validate']) !!}
            <div class="modal-body">
                <div id="testmodal" style="padding: 5px 20px;">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Cadastro</label>
                        <div class="col-sm-9">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="anonimo"> Paciente Não Cadastrado
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group cadastrado">
                        <label class="col-sm-3 control-label">Paciente</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="idpaciente">
                                @foreach($Page->Pacientes as $paciente)
                                    <option value="{{$paciente->idpaciente}}">{{$paciente->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group anonimo esconde">
                        <label class="col-sm-3 control-label">Nome</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nome">
                        </div>
                    </div>
                    <div class="form-group anonimo esconde">
                        <label class="col-sm-3 control-label">Telefone</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="telefone">
                        </div>
                    </div>
                    @include('pages.master.forms.agenda')
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary antosubmit">Salvar</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
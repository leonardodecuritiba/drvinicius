<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Documentos</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <button class="btn btn-primary"
                                data-toggle="modal"
                                data-type="document"
                                data-idpaciente="{{$Paciente->idpaciente}}"
                                data-target="#modalUploads">
                            <i class="fa fa-upload fa-2"></i> Novo Documento
                        </button>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if($Paciente->has_documentos())
                    <table class="table table-striped dt-responsive table-bordered nowrap" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Paciente->documentos as $selecao)
                            <tr>
                                <td>
                                    {{$selecao->id}}
                                </td>
                                <td>{{$selecao->titulo}}</td>
                                <td>{{$selecao->descricao}}</td>
                                <td>
                                    <a class="btn btn-default btn-xs" target="_blank"
                                       href="{{$selecao->getDocumentoThumb()}}"><i class="fa fa-eye"></i> Abrir</a>
                                    <a class="btn btn-danger btn-xs"
                                       data-nome="Documento #{{$selecao->id}}"
                                       data-href="{{route('documentos.pacientes.destroy',$selecao->id)}}"
                                       data-toggle="modal"
                                       data-target="#modalExclusao"><i class="fa fa-trash-o fa-sm"></i> Excluir </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="jumbotron">
                        <h1>Ops!</h1>
                        <h3>Nenhum documento encontrado!</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Imagens</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <button class="btn btn-primary"
                                data-toggle="modal"
                                data-type="image"
                                data-idpaciente="{{$Paciente->idpaciente}}"
                                data-target="#modalUploads">
                            <i class="fa fa-upload fa-2"></i> Nova Imagem
                        </button>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                @if($Paciente->has_images())
                    <table class="table table-striped dt-responsive table-bordered nowrap" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($Paciente->images as $selecao)
                            <tr>
                                <td>
                                    {{$selecao->id}}
                                </td>
                                <td>{{$selecao->titulo}}</td>
                                <td>{{$selecao->descricao}}</td>
                                <td>
                                    <a class="btn btn-default btn-xs" target="_blank"
                                       href="{{$selecao->getLink()}}"><i class="fa fa-eye"></i> Abrir</a>
                                    <a class="btn btn-danger btn-xs"
                                       data-nome="Documento #{{$selecao->id}}"
                                       data-href="{{route('imagens.pacientes.destroy',$selecao->id)}}"
                                       data-toggle="modal"
                                       data-target="#modalExclusao"><i class="fa fa-trash-o fa-sm"></i> Excluir </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="jumbotron">
                        <h1>Ops!</h1>
                        <h3>Nenhuma imagem encontrado!</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{--Upload Documentos/Imagens--}}
<script>
    $('#modalUploads').on('show.bs.modal', function (event) {
        var $btn = event.relatedTarget;
        var $this = $(this);
        var $form = $($this).find('div.modal-content form');
        switch ($($btn).data('type')) {
            case 'document' : {
                $($this).find('div.modal-header h4').html('Upload de documentos');
                $($form).find('input[name=type]').val($($btn).data('type'));
                $($form).find('input[name=idpaciente]').val($($btn).data('idpaciente'));
                $($form).attr('action', "{{route('documentos.pacientes.store')}}");
                break;
            }
            case 'image' : {
                $($this).find('div.modal-header h4').html('Upload de imagens');
                $($form).find('input[name=type]').val($($btn).data('type'));
                $($form).find('input[name=idpaciente]').val($($btn).data('idpaciente'));
                $($form).attr('action', "{{route('imagens.pacientes.store')}}");
                break;
            }
        }

    })
</script>
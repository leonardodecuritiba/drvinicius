@extends('layouts.template')
@section('page_content')

    <!-- Modal agendar -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Adicionar profissional</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Nome:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" name="nome" value="" maxlength="100">
                                <span class="fa fa-user-md form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">CPF:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="number" class="form-control" name="cpf" value="" maxlength="11">
                                <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">CRO:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="number" class="form-control" name="cro" value="" maxlength="5">
                                <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Celular:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="number" class="form-control" name="celular" value="" maxlength="12">
                                <span class="fa fa-mobile form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Telefone:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="number" class="form-control" name="telefone" value="" maxlength="12">
                                <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Endereço:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" name="endereco" value="" maxlength="120">
                                <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Cidade:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" name="cidade" value="" maxlength="60">
                                <span class="fa fa-home form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Estado:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <select class="select2_group form-control">
                                    <option value="AC" name="acre">Acre (AC)</option>
                                    <option value="AL" name="alagoas">Alagoas (AL)</option>
                                    <option value="AP" name="amapa">Amapá (AP)</option>
                                    <option value="AM" name="amazonas">Amazonas (AM)</option>
                                    <option value="BA" name="bahia">Bahia (BA)</option>
                                    <option value="CE" name="ceara">Ceará (CE)</option>
                                    <option value="DF" name="distritofedereal">Distrito Federal (DF)</option>
                                    <option value="MN" name="espiritosanto">Espírito Santo (ES)</option>
                                    <option value="MS" name="goias">Goiás (GO)</option>
                                    <option value="MO" name="maranhao">Maranhão (MA)</option>
                                    <option value="OK" name="matogrosso">Mato Grosso (MT)</option>
                                    <option value="SD" name="mtogrossodosul">Mato Grosso do Sul (MS)</option>
                                    <option value="TX" name="minasgerais">Minas Gerais (MG)</option>
                                    <option value="TN" name="para">Pará (PA)</option>
                                    <option value="WI" name="paraiba">Paraíba (PB)</option>
                                    <option value="AC" name="parana" selected>Paraná (PR)</option>
                                    <option value="AL" name="pernambuco">Pernambuco (PE)</option>
                                    <option value="AP" name="piaui">Piauí (PI)</option>
                                    <option value="AM" name="riodejaneiro">Rio de Janeiro (RJ)</option>
                                    <option value="BA" name="riograndedonorte">Rio Grande do Norte (RN)</option>
                                    <option value="CE" name="riograndedosul">Rio Grande do Sul (RS)</option>
                                    <option value="DF" name="rondonia">Rondônia (RO)</option>
                                    <option value="MN" name="roraima">Roraima (RR)</option>
                                    <option value="MS" name="santacatarina">Santa Catarina (SC)</option>
                                    <option value="MO" name="saopaulo">São Paulo (SP)</option>
                                    <option value="OK" name="sergipe">Sergipe (SE)</option>
                                    <option value="SD" name="tocantins">Tocantins (TO)</option>
                                </select>
                                <span class="fa fa-home form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">E-mail:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" name="email" value="" maxlength="50">
                                <span class="fa fa-envelope-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Senha:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="password" class="form-control" name="password" value="" maxlength="60">
                                <span class="fa fa-times form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Nova Senha:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="password" class="form-control" name="password1" value="" maxlength="60">
                                <span class="fa fa-times form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Permissões:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <select class="select2_group form-control" name="permissoes" maxlength="40">
                                    <optgroup label="Permissões cadastrados">
                                        <option value="1" name="administrador">Administrador</option>
                                        <option value="2" name="dentista">Dentista</option>
                                        <option value="3" name="secretario">Secretário</option>
                                        <option value="4" name="aluno">Aluno</option>
                                    </optgroup>
                                </select>
                                <span class="fa fa-file-text-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-6 col-sm-6 col-xs-12">Caixa padrão(tratamento, débitos,
                                etc...)</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div id="gender" class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default" data-toggle-class="btn-primary"
                                           data-toggle-passive-class="btn-default">
                                        <input type="radio" name="0" value="male"> &nbsp; Sim &nbsp;
                                    </label>
                                    <label class="btn btn-primary active" data-toggle-class="btn-primary"
                                           data-toggle-passive-class="btn-default">
                                        <input type="radio" name="1" value="female" checked=""> Não
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary antosubmit">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal agendar -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Editar profissional</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Nome:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" name="nome" value="Lorem Ipsum" maxlength="100">
                                <span class="fa fa-user-md form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">CPF:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="number" class="form-control" name="cpf" value="10124204900" maxlength="11">
                                <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">CRO:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="number" class="form-control" name="cro" value="33333" maxlength="5">
                                <span class="fa fa-book form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Celular:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="number" class="form-control" name="celular" value="4198888888"
                                       maxlength="12">
                                <span class="fa fa-mobile form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Telefone:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="number" class="form-control" name="telefone" value="4133333333"
                                       maxlength="12">
                                <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Endereço:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" name="endereco" value="Lorem Ipsum 123"
                                       maxlength="120">
                                <span class="fa fa-map-marker form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Cidade:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" name="cidade" value="Curitiba" maxlength="60">
                                <span class="fa fa-home form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Estado:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <select class="select2_group form-control">
                                    <option value="AC" name="acre">Acre (AC)</option>
                                    <option value="AL" name="alagoas">Alagoas (AL)</option>
                                    <option value="AP" name="amapa">Amapá (AP)</option>
                                    <option value="AM" name="amazonas">Amazonas (AM)</option>
                                    <option value="BA" name="bahia">Bahia (BA)</option>
                                    <option value="CE" name="ceara">Ceará (CE)</option>
                                    <option value="DF" name="distritofedereal">Distrito Federal (DF)</option>
                                    <option value="MN" name="espiritosanto">Espírito Santo (ES)</option>
                                    <option value="MS" name="goias">Goiás (GO)</option>
                                    <option value="MO" name="maranhao">Maranhão (MA)</option>
                                    <option value="OK" name="matogrosso">Mato Grosso (MT)</option>
                                    <option value="SD" name="mtogrossodosul">Mato Grosso do Sul (MS)</option>
                                    <option value="TX" name="minasgerais">Minas Gerais (MG)</option>
                                    <option value="TN" name="para">Pará (PA)</option>
                                    <option value="WI" name="paraiba">Paraíba (PB)</option>
                                    <option value="AC" name="parana" selected>Paraná (PR)</option>
                                    <option value="AL" name="pernambuco">Pernambuco (PE)</option>
                                    <option value="AP" name="piaui">Piauí (PI)</option>
                                    <option value="AM" name="riodejaneiro">Rio de Janeiro (RJ)</option>
                                    <option value="BA" name="riograndedonorte">Rio Grande do Norte (RN)</option>
                                    <option value="CE" name="riograndedosul">Rio Grande do Sul (RS)</option>
                                    <option value="DF" name="rondonia">Rondônia (RO)</option>
                                    <option value="MN" name="roraima">Roraima (RR)</option>
                                    <option value="MS" name="santacatarina">Santa Catarina (SC)</option>
                                    <option value="MO" name="saopaulo">São Paulo (SP)</option>
                                    <option value="OK" name="sergipe">Sergipe (SE)</option>
                                    <option value="SD" name="tocantins">Tocantins (TO)</option>
                                </select>
                                <span class="fa fa-home form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">E-mail:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="text" class="form-control" name="email" value="lorem@ipsum.com"
                                       maxlength="50">
                                <span class="fa fa-envelope-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Senha:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="password" class="form-control" name="password" value="21212121"
                                       maxlength="60">
                                <span class="fa fa-times form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Nova Senha:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input type="password" class="form-control" name="password1" value="2121212"
                                       maxlength="60">
                                <span class="fa fa-times form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Permissões:</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <select class="select2_group form-control" name="permissoes" maxlength="40">
                                    <optgroup label="Permissões cadastrados">
                                        <option value="1" name="administrador">Administrador</option>
                                        <option value="2" name="dentista" selected>Dentista</option>
                                        <option value="3" name="secretario">Secretário</option>
                                        <option value="4" name="aluno">Aluno</option>
                                    </optgroup>
                                </select>
                                <span class="fa fa-file-text-o form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-6 col-sm-6 col-xs-12">Caixa padrão(tratamento, débitos,
                                etc...)</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div id="gender" class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default" data-toggle-class="btn-primary"
                                           data-toggle-passive-class="btn-default">
                                        <input type="radio" name="0" value="male"> &nbsp; Sim &nbsp;
                                    </label>
                                    <label class="btn btn-primary active" data-toggle-class="btn-primary"
                                           data-toggle-passive-class="btn-default">
                                        <input type="radio" name="1" value="female" checked=""> Não
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary antosubmit">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Você tem certeza que deseja excluir esse
                        profissional?</h4>
                </div>
                <div class="modal-body" style="background:rgba(217, 83, 79, 0.57);">
                    <button type="button" class="btn btn-round btn-success">Sim</button>
                    <button type="button" class="btn btn-round btn-danger">Não</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Adicionar profissional');
        })
    </script>

    <!-- page content -->
    <h2>Equipe</h2>
    <div class="row tile_count" style="background:#E7E7E7; padding:10px;">

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Novo
            profissional
        </button>
        <div class="form-group">
            <div class="col-md-4 col-sm-4 col-xs-9" style="float:right; margin-top:-40px;">
                <select class="select2_group form-control">
                    <optgroup label="Cirugiões cadastrados">
                        <option value="AL" name="">Ativo</option>
                        <option value="AR" name="">Inativo</option>
                        <option value="AR" name="">Todos</option>

                    </optgroup>
                </select>
                <span class="fa fa-file-text-o form-control-feedback right" aria-hidden="true"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Pesquisar profissional...">
                    <span class="input-group-btn">
										<button class="btn btn-default" type="button"><i
                                                    class="fa fa-chevron-circle-right"></i></button>
									</span>
                </div>
            </div>
        </div>
        <table class="table table-striped projects ">
            <thead>
            <tr>
                <th style="width: 20%">Dentista</th>
                <th style="width: 25%">E-mail</th>
                <th style="width: 15%">Tipo</th>
                <th style="width: 10%">Permissões</th>
                <th style="width: 15%">Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><a>Dr. Carlo Franco</a>
                    <br/>
                    <small>CRO: 0122.01.2015</small></td>
                <td>
                    <a>carlos.franco@gmail.com </a>
                </td>
                <td>
                    <a> Administrador Geral</a>
                </td>
                <td class="project_progress">
                    <a>25 permissões de 30</a>
                </td>

                <td>
                    <button type="button" data-toggle="modal" data-target="#exampleModal1" class="btn btn-info btn-xs">
                        <i class="fa fa-pencil"></i> Editar </a>
                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal"
                                data-target="#exampleModal2"><i class="fa fa-pencil"></i> Excluir </a>
                </td>
            </tr>
            <tr>
                <td><a>Dr. Carlo Franco</a>
                    <br/>
                    <small>Data: 01.01.2015</small></td>
                <td>
                    <a>carlos.franco@gmail.com </a>
                </td>
                <td>
                    <a> Administrador Geral </a>
                </td>
                <td class="project_progress">
                    <a>25 permissões de 30</a>
                </td>

                <td>
                    <button type="button" data-toggle="modal" data-target="#exampleModal1" class="btn btn-info btn-xs">
                        <i class="fa fa-pencil"></i> Editar </a>
                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal"
                                data-target="#exampleModal2"><i class="fa fa-pencil"></i> Excluir </a>
                </td>
            </tr>
            <tr>
                <td><a>Dr. Carlo Franco</a>
                    <br/>
                    <small>Data: 01.01.2015</small></td>
                <td>
                    <a>carlos.franco@gmail.com </a>
                </td>
                <td>
                    <a> Administrador Geral </a>
                </td>
                <td class="project_progress">
                    <a>25 permissões de 30</a>
                </td>

                <td>
                    <button type="button" data-toggle="modal" data-target="#exampleModal1" class="btn btn-info btn-xs">
                        <i class="fa fa-pencil"></i> Editar </a>
                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal"
                                data-target="#exampleModal2"><i class="fa fa-pencil"></i> Excluir </a>
                </td>
            </tr>
            <tr>
                <td><a>Dr. Carlo Franco</a>
                    <br/>
                    <small>Data: 01.01.2015</small></td>
                <td>
                    <a>carlos.franco@gmail.com </a>
                </td>
                <td>
                    <a> Administrador Geral </a>
                </td>
                <td class="project_progress">
                    <a>25 permissões de 30</a>
                </td>

                <td>
                    <button type="button" data-toggle="modal" data-target="#exampleModal1" class="btn btn-info btn-xs">
                        <i class="fa fa-pencil"></i> Editar </a>
                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal"
                                data-target="#exampleModal2"><i class="fa fa-pencil"></i> Excluir </a>

                </td>
            </tr>

            </tbody>
        </table>
        <!-- end user projects -->
        <ul class="pagination">
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">6</a></li>
            <li><a href="#">7</a></li>
            <li><a href="#">8</a></li>
            <li><a href="#">9</a></li>
            <li><a href="#">10</a></li>
        </ul>
    </div>

    <!-- icheck -->
    <script src="js/icheck/icheck.min.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="js/moment.min.js"></script>
    <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>

@endsection
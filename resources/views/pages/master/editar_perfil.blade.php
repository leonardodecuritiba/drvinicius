@extends('layouts.template')
@section('page_content')

    <link href="css/editor/external/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="css/editor/index.css" rel="stylesheet">
    <!-- select2 -->
    <link href="css/select/select2.min.css" rel="stylesheet">
    <!-- switchery -->
    <link rel="stylesheet" href="css/switchery/switchery.min.css"/>


    <!-- page content -->
    <div class="">

        <div class="page-title">
            <div class="title_left">
                <h3>Editar perfil - Dr José Fernando</h3>
            </div>
            <!--<div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
            </span>
                    </div>
                </div>
            </div>-->
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Dados pessoais</h2>
                        <!--  <ul class="nav navbar-right panel_toolbox">
                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                              </li>
                              <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                  <ul class="dropdown-menu" role="menu">
                                      <li><a href="#">Settings 1</a>
                                      </li>
                                      <li><a href="#">Settings 2</a>
                                      </li>
                                  </ul>
                              </li>
                              <li><a class="close-link"><i class="fa fa-close"></i></a>
                              </li>
                          </ul>-->
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Nome:
                                </label>
                                <div class="col-md-11 col-sm-11 col-xs-6 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="nome"
                                           id="inputSuccess2" value="Jose">
                                    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">E-mail:
                                </label>
                                <div class="col-md-5 col-sm-5 col-xs-6 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="e-mail"
                                           id="inputSuccess2" value="dr.jose@gmail.com">
                                    <span class="fa fa-envelope-o form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Senha:
                                </label>
                                <div class="col-md-5 col-sm-5 col-xs-6 form-group has-feedback">
                                    <input type="password" class="form-control has-feedback-left" name="password"
                                           id="inputSuccess2" value="kkkkkk">
                                    <span class="fa fa-unlock form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Telefone:
                                </label>
                                <div class="col-md-5 col-sm-5 col-xs-6 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="telefone"
                                           id="inputSuccess3" value="(41)3223-9999">
                                    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Celular:
                                </label>
                                <div class="col-md-5 col-sm-5 col-xs-6 form-group has-feedback">
                                    <input type="text" class="form-control has-feedback-left" name="celular"
                                           id="inputSuccess2" value="(41)9879-9999">
                                    <span class="fa fa-mobile form-control-feedback left" aria-hidden="true"></span>
                                </div>
                                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Sexo.:
                                </label>
                                <div class="col-md-5 col-sm-5 col-xs-6 form-group has-feedback">
                                    <select class="form-control" name="sexo">
                                        <option value="AL" name="0">Feminino</option>
                                        <option value="AL" name="1">Masculino</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">CPF:
                                    </label>
                                    <div class="col-md-5 col-sm-5 col-xs-6 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="cpf"
                                               id="inputSuccess2" value="122.333.245-21">
                                        <span class="fa fa-newspaper-o form-control-feedback left"
                                              aria-hidden="true"></span>
                                    </div>
                                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">CRO:
                                    </label>
                                    <div class="col-md-5 col-sm-5 col-xs-6 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="cro"
                                               id="inputSuccess3" value="51.546.324-5">
                                        <span class="fa fa-newspaper-o form-control-feedback left"
                                              aria-hidden="true"></span>
                                    </div>
                                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Foto:
                                    </label>
                                    <div class="col-md-5 col-sm-5 col-xs-6 form-group has-feedback">
                                        <input name="foto" type="file" class="form-control" rows="9" cols="25"
                                               required="required" data-parsley-id="0599">
                                        <span class="fa fa-newspaper-o form-control-feedback right"
                                              aria-hidden="true"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Endereço:
                                    </label>
                                    <div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="endereco"
                                               id="inputSuccess2" value="Frederico Maurer">
                                        <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Bairro.:
                                    </label>
                                    <div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback">
                                        <input type="text" class="form-control" name="bairro" id="inputSuccess3"
                                               value="Hauer">
                                        <span class="fa fa-home form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Complemen.:
                                    </label>
                                    <div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback">
                                        <input type="text" class="form-control" name="complemento" id="inputSuccess3"
                                               value="Casa">
                                        <span class="fa fa-home form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Cidade:
                                    </label>
                                    <div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback">
                                        <input type="text" class="form-control has-feedback-left" name="cidade"
                                               id="inputSuccess2" value="Curitiba">
                                        <span class="fa fa-home form-control-feedback left" aria-hidden="true"></span>
                                    </div>
                                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">CEP:
                                    </label>
                                    <div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback">
                                        <input type="text" class="form-control" id="inputSuccess3" name="cep"
                                               value="91.543.222">
                                        <span class="fa fa-newspaper-o form-control-feedback right"
                                              aria-hidden="true"></span>
                                    </div>
                                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">UF:
                                    </label>
                                    <div class="col-md-3 col-sm-3 col-xs-6 form-group has-feedback">
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

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-1">
                                        <button type="submit" class="btn btn-danger">Cancelar</button>
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                    </div>
                                </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#birthday').daterangepicker({
                    singleDatePicker: true,
                    calender_style: "picker_4"
                }, function (start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                });
            });
        </script>

    </div>

    <!-- /footer content -->


    <script src="js/icheck/icheck.min.js"></script>
    <!-- tags -->
    <script src="js/tags/jquery.tagsinput.min.js"></script>
    <!-- switchery -->
    <script src="js/switchery/switchery.min.js"></script>
    <!-- select2 -->
    <script src="js/select/select2.full.js"></script>
    <!-- form validation -->
    <script type="text/javascript" src="js/parsley/parsley.min.js"></script>


    <!-- daterangepicker -->
    <script type="text/javascript" src="js/moment.min2.js"></script>
    <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
    <!-- richtext editor -->
    <script src="js/editor/bootstrap-wysiwyg.js"></script>
    <script src="js/editor/external/jquery.hotkeys.js"></script>
    <script src="js/editor/external/google-code-prettify/prettify.js"></script>

    <!-- textarea resize -->
    <script src="js/textarea/autosize.min.js"></script>
    <script>
        autosize($('.resizable_textarea'));
    </script>

@endsection
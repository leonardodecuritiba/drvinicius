<div class="profile_img">
    <!-- end of image cropping -->
    <div id="crop-avatar">
        <!-- Current avatar -->
        <div class="avatar-view" title="Change the avatar">
            <img src="{{$Paciente->getFoto()}}" width="100%" alt="Avatar">
        </div>
    </div>
    <!-- end of image cropping -->
</div>
<h4>{{$Paciente->nome}}</h4>
<ul class="list-unstyled user_data">
    <li>
        <i class="fa fa-briefcase user-profile-icon"></i> <strong>Plano:</strong> {{$Paciente->plano->nome}}
    <li>
    @if($Paciente->contato->getCidadeEstado() != NULL)
        <li>
            <i class="fa fa-map-marker user-profile-icon"></i> {{$Paciente->contato->getCidadeEstado()}}</li>
        <li>
    @endif
    @if($Paciente->contato->celular != NULL)
        <li class="m-top-xs">
            <i class="fa fa-phone user-profile-icon"></i>
            <span class="show-celular">{{$Paciente->contato->celular}}</span>
        </li>
    @endif
    @if($Paciente->contato->email != NULL)
        <li class="m-top-xs">
            <i class="fa fa-envelope-o user-profile-icon"></i>
            <a href="#" target="_blank">{{$Paciente->contato->email}}</a>
        </li>
    @endif
    @if($Paciente->contato->data_nascimento != NULL)
        <li class="m-top-xs">
            <i class="fa fa-calendar-o user-profile-icon"></i>
            <a href="#" target="_blank">{{$Paciente->getIdade()}} anos</a>
        </li>
    @endif
    <li class="m-top-xs">
        <a class="btn btn-danger btn-xs"
           data-nome="{{$Paciente->nome}}"
           data-href="{{route(strtolower($Page->link).'.destroy',$Paciente->idpaciente)}}"
           data-toggle="modal"
           data-target="#modalExclusao"><i class="fa fa-trash-o fa-sm"></i> Remover</a>
        <button type="button" class="btn btn-info btn-xs add-retorno"
                data-idpaciente="{{$Paciente->idpaciente}}"
                data-toggle="modal"
                data-target="#modalRetorno">
            <i class="fa fa-plus"></i> Agendar retorno
        </button>
    </li>
</ul>
@if($Paciente->has_evolucao())
	<?php $evolucao = $Paciente->getLastEvolucao();?>
    <div class="ln_solid"></div>
    <h4>Última evolução</h4>
    <ul class="list-unstyled user_data">
        <li>
            <p>{{$evolucao->data_evolucao}}</p>
            <div class="progress progress_sm">
                <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
            </div>
            <p>
                {{$evolucao->texto}}
            </p>
        </li>
    </ul>
@endif
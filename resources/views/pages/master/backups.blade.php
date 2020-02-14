@extends('layouts.template')
@section('style_content')
    <!-- Datatables -->
    @include('helpers.datatables.head')
    <!-- /Datatables -->
@endsection
@section('page_content')
    <!-- /Seach form -->
    <div class="x_panel">
        <div class="x_title">
            <h2>{{$Page->Targets}} encontrados</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 animated fadeInDown">
                    <a href="{{route('backups.function','clean')}}" class="btn btn-primary"><i
                                class="fa fa-refresh"></i> Fazer Limpeza</a>
                    <a target="_blank" href="{{route('backups.function','run')}}" class="btn btn-success"><i
                                class="fa fa-save"></i> Novo Backup</a>
                </div>
            </div>
            @if(count($Backups) > 0)
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 animated fadeInDown">
                        <table class="table table-striped dt-responsive table-bordered nowrap" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Criação</th>
                                <th colspan="2">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($Backups as $backup)
                                <tr>
                                    <td>{{$backup->getFilename()}}</td>
                                    <td>{{\Carbon\Carbon::createFromTimestamp($backup->getMTime())->format('H:i d/m/Y')}}</td>
                                    <td><a class="btn btn-success btn-xs"
                                           href="{{asset('backups/' . config('app.url') .'/'. $backup->getFilename())}}"><i
                                                    class="fa fa-download"></i> Download</a>
                                        <a class="btn btn-danger btn-xs"
                                           href="{{route('backups.destroy',$backup->getFilename())}}"><i
                                                    class="fa fa-trash"></i> Remover</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                @include('layouts.search.no-results')
            @endif
        </div>
    </div>
@endsection
@section('scripts_content')
    <!-- Datatables -->
    @include('helpers.datatables.foot')
    <script>
        $(document).ready(function () {
            $('.dt-responsive').DataTable(
                {
                    "language": language_pt_br,
                    "pageLength": 10,
                    "bLengthChange": false, //used to hide the property
                    "bFilter": false,
                    "order": [0, "desc"]
                }
            );
        });
    </script>
    <!-- /Datatables -->
@endsection
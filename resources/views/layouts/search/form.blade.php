<div id="search" class="x_panel">
    <div class="x_content">
        <div class="col-md-4 col-md-offset-2 col-sm-4 col-xs-12 ">
            {!! Form::open(array('route'=>strtolower($Page->link).'.index','method'=>'GET','id'=>'search')) !!}
            <div class="col-md-12 col-sm-12 col-xs-12 input-group input-group-lg">
                <input id="buscar" name="busca" type="text" class="form-control"
                       value="{{Request::has('busca')?Request::get('busca'):''}}"
                       placeholder="Buscar {{$Page->Target}}...">
                <span class="input-group-btn">
                    <button class="btn btn-info" type="submit">Buscar</button>
                </span>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12 form-group">
            <a href="{{ route(strtolower($Page->link).'.create') }}"
               class="btn btn-info btn-lg btn-block">Cadastrar {{$Page->Target}}</a>
        </div>
        @if(Request::has('busca'))
            <div class="col-md-1 col-sm-4 col-xs-12 form-group">
                <a href="{{ URL::previous() }}" class="btn btn-warning btn-lg btn-block">Voltar</a>
            </div>
        @endif
    </div>
</div>
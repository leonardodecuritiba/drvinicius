<tr>
    <td rowspan="3" colspan="3">
        <img src="{{$clinica->getFotoPrint()}}">
    </td>

    <td colspan="7">{{$clinica->nome}}</td>
</tr>
<tr>
    <td colspan="7">{{$clinica->contato->getEnderecoCompleto()}}</td>
</tr>
<tr>
    <td colspan="7">Emitido por: {{Auth::user()->nome()}}</td>
    {{--<td colspan="2">Data: {{Carbon\Carbon::now()->format('d/m/Y')}}</td>--}}
</tr>
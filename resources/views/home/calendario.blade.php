@extends('home.layout')

@section('inner-content')
    <h2>Meu calendário</h2>
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">
                            Domingo<br>({{ $de->format('d/m') }})
                        </th>
                        <th class="text-center">
                            Segunda<br>({{ $de->addDay()->format('d/m') }})
                        </th>
                        <th class="text-center">
                            Terça<br>({{ $de->addDay()->format('d/m') }})
                        </th>
                        <th class="text-center">
                            Quarta<br>({{ $de->addDay()->format('d/m') }})
                        </th>
                        <th class="text-center">
                            Quinta<br>({{ $de->addDay()->format('d/m') }})
                        </th>
                        <th class="text-center">
                            Sexta<br>({{ $de->addDay()->format('d/m') }})
                        </th>
                        <th class="text-center">
                            Sábado<br>({{ $de->addDay()->format('d/m') }})
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $aulas->get($de->subDays(6)->format('d/m/Y')) }}</td>
                        <td>{{ $aulas->get($de->addDay()->format('d/m/Y')) }}</td>
                        <td>{{ $aulas->get($de->addDay()->format('d/m/Y')) }}</td>
                        <td>{{ $aulas->get($de->addDay()->format('d/m/Y')) }}</td>
                        <td>{{ $aulas->get($de->addDay()->format('d/m/Y')) }}</td>
                        <td>{{ $aulas->get($de->addDay()->format('d/m/Y')) }}</td>
                        <td>{{ $aulas->get($de->addDay()->format('d/m/Y')) }}</td>

                    </tr>
                </tbody>
            </table>
        </div>
        {{$aulas}}

    </div>
@endsection
{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header text-center">Nodos y Edges</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col text-center">

                                @if (session('message'))
                                    {{ session('message') }}
                                @endif
                                <form action="{{ route('nodo') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nodo">Nodo</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" class="form-control text-center" name="nombre"
                                            placeholder="Ingrese el Nombre del Nodo">
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Valor:</label>
                                        <input type="text" class="form-control text-center" name="valor"
                                            placeholder="Ingrese el Valor del Nodo">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success">
                                    </div>
                                </form>
                            </div>



                            <div class="col text-center">
                                <form action="{{ route('edge') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nodo">Edges</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Raiz:</label>
                                        <fieldset>
                                            <select name="raiz" class="form-control" id="raiz">
                                                <option value="" hidden disabled selected value>Seleccione un Nodo...
                                                </option>
                                                @foreach ($nodos as $nodo)
                                                    <option value="{{ $nodo->id }}">{{ $nodo->Nombre }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Dirigido:</label>
                                        <fieldset>
                                            <select name="dirigido" class="form-control" id="dirigido">
                                                <option value="" hidden disabled selected value>Seleccione un Nodo...
                                                </option>
                                                @foreach ($nodos as $nodo)
                                                    <option value="{{ $nodo->id }}">{{ $nodo->Nombre }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="form-group">
                                        <label for="peso">Peso:</label>
                                        <input type="text" class="form-control text-center" name="peso"
                                            placeholder="Ingrese el Peso del Edge">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success">
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <br>
                <div class="card">
                    <div class="card-header text-center">Grafo</div>
                    <a href="{{ route('borrar') }}" class="btn btn-danger">Borrar Grafo</a>
                    <a href="{{ route('reco', ['id' => 1]) }}" class="btn btn-success">Ver recorrido</a>
                    <input type="hidden" id="json" value="{{ $queso }}">
                    <input type="hidden" id="jsonedges" value="{{ $edges }}">
                    <div class="card-body" id="mynetwork">
                        <div></div>
                    </div>
                </div>

                <br> <br> <br> <br>
            </div>
        </div>

        <script>
            var json = $("#json").val();
            var jaso = $("#jsonedges").val();
            var datas = JSON.parse(json);
            var edge = JSON.parse(jaso);
            console.log(edge);
            var nodes = new vis.DataSet();

            datas.forEach(function(dat, index) {
                nodes.add([{
                    id: dat['id'],
                    label: dat['Nombre']
                }]);
            });

            // create an array with edges
            var edges = new vis.DataSet();


            edge.forEach(function(edg, index) {
                edges.add([{
                    from: edg['Raiz'],
                    to: edg['Dirigido'],
                    label: edg['Peso'].toString()
                }]);

            });




            // create a network
            var container = document.getElementById('mynetwork');
            var data = {
                nodes: nodes,
                edges: edges,
            };
            var options = {
                width: '780px',
                height: '400px'
            };
            var network = new vis.Network(container, data, options);

        </script>

    @endsection

    {{-- Scripts Section --}}
    @section('scripts')

    @endsection

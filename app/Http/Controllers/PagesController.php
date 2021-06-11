<?php

namespace App\Http\Controllers;

use App\Models\Nodo;
use App\Models\Edge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index()
    {
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';

        $nodos = Nodo::all();

        $queso = json_encode($nodos);

        $edges = json_encode(Edge::all());

        return view('pages.dashboard', ['nodos' => $nodos, 'queso' => $queso, 'edges' => $edges]);
    }

    public function saveNodo(Request $request)
    {
        $nodo = new Nodo();

        $nombre = $request->input('nombre');
        $valor = $request->input('valor');

        $nodo->nombre = $nombre;
        $nodo->valor = $valor;
        $nodo->save();

        return redirect()->route('index');
    }
    public function saveEdge(Request $request)
    {
        $edge = new Edge();

        $raiz = $request->input('raiz');
        $dirigido = $request->input('dirigido');
        $peso = (int) $request->input('peso');

        $edge->Raiz = $raiz;
        $edge->Dirigido = $dirigido;
        $edge->Peso = $peso;

        $edge->save();

        $edge->rRaiz->peso =  $edge->rRaiz->peso + $peso;
        $edge->rDirigido->peso =  $edge->rDirigido->peso + $peso;

        $edge->rRaiz->save();
        $edge->rDirigido->save();

        return redirect()->route('index');
    }

    public function borrarTodoAlv()
    {
        DB::table('edge')->delete();
        DB::table('nodo')->delete();

        return redirect()->route('index');
    }
    public function recorrido($id)
    {
        # code...
        if ($id != 1) {
            //algo
            $nodo = Nodo::find($id);
        } else {
            //algo mas
            $nodo = Nodo::first();
        }
        return view('pages.recorrido', ['nodo' => $nodo, 'id' => $id]);
    }
}

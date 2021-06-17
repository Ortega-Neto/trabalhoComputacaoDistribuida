<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ResponsavelsController;

class EventosController extends Controller
{
    public function buscarEventos(){
        try{            
            $eventos = Evento::get();
                       
            if(!empty($eventos[0])){
                echo $eventos;
            }
            else {
                return response()->json(['erro' => 'Nenhuma Evento encontrado'], 404);
            }
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }

    public function inserirEvento(Request $request){
        try{
            $user = Evento::buscarIdResponsavel($request['id_responsavel']);

            if(!empty($user[0])){
                $evento = Evento::create($request->all());
                
                DB::table('responsavels')
                ->where('id', $request['id_responsavel'])
                ->update(array('id_evento' => $evento['id']));

                return response()->json(
                        [
                            'eventoInserido' => [
                                'id' => $evento['id'],
                                'nome' => $evento['nome'],
                                'data' => $evento['data'],
                                'lote' => $evento['lote'],
                                'valor_lote' => $evento['valor_lote'],
                                'id_responsavel' => $evento['id_responsavel'],
                                'created_at' => $evento['created_at'],
                                'updated_at' => $evento['updated_at']
                            ]
                        ],
                        201
                    );
            }
            else{
                return response()->json(['erro' => 'Administrador não registrado'], 404);
            }
            
        }
        catch (Exception $ex){
            return response()->json(['erro' => $ex], 404);
        }
    }
    
    public static function buscarEventoPeloId($id){
        try{
            $evento = Evento::find($id);
            return $evento != []? $evento : response()->json(['erro' => 'Evento não encontrado'], 404);
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }
    
    public function atualizarEvento(Request $request, $id){
        try{
            if(isset($request['rga_evento'])){
                $user = Evento::buscarRGA($request['rga_evento']);

                if(!empty($user[0])){
                    return $this->realizarAtualizacao($request, $id);
                }
                else{
                    return response()->json(['erro' => 'User não registrado'], 404);
                }
            }
            else {
                return $this->realizarAtualizacao($request, $id);
            }
            
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }
    
    private function realizarAtualizacao(Request $request, $id){
        try{
            $evento = Evento::findOrFail($id);
            $evento->update($request->all());
            
            $eventoAtualizado = Evento::findOrFail($id);
            return response()->json(
                    [
                        'eventoAtualizado' => [
                            'id' => $evento['id'],
                            'nome' => $eventoAtualizado['nome'],
                            'data' => $eventoAtualizado['data'],
                            'lote' => $eventoAtualizado['lote'],
                            'valor_lote' => $eventoAtualizado['valor_lote'],
                            'id_responsavel' => $eventoAtualizado['id_responsavel'],
                            'created_at' => $eventoAtualizado['created_at'],
                            'updated_at' => $eventoAtualizado['updated_at']
                        ]
                    ],
                    200
                );
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }


    public function deletarEvento($id){
        try{
            $evento = Evento::find($id);
            $responsavelsController = new ResponsavelsController();
            $responsavelsController->deletarResponsavel($evento['id_responsavel']);
            
            if($evento != null){
                $eventoDeletado = $evento;
                $evento->delete();
                return response()->json(
                        [
                            'eventoDeletado' => [
                                'id' => $evento['id'],
                                'nome' => $eventoDeletado['nome'],
                                'data' => $eventoDeletado['data'],
                                'lote' => $eventoDeletado['lote'],
                                'valor_lote' => $eventoDeletado['valor_lote'],
                                'id_responsavel' => $eventoDeletado['id_responsavel'],
                                'created_at' => $eventoDeletado['created_at'],
                                'updated_at' => $eventoDeletado['updated_at']
                            ]
                        ],
                        200
                    );
            }
            else{
                response()->json(['erro' => "Evento não encontrado"], 404);
            }
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }
}

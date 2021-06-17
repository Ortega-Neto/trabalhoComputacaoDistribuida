<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Responsavel;

class ResponsavelsController extends Controller
{
     public function buscarResponsaveis(){
        try{            
            $responsaveis = Responsavel::get();
                       
            if(!empty($responsaveis[0])){
                echo $responsaveis;
            }
            else {
                return response()->json(['erro' => 'Nenhuma Responsavel encontrado'], 404);
            }
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }

    public function inserirResponsavel(Request $request){
        try{
            $user = Responsavel::buscarIdUser($request['id_responsavel']);

            if(!empty($user[0])){
                $responsavel = Responsavel::create($request->all());

                return response()->json(
                        [
                            'responsavelInserido' => [
                                'id' => $responsavel['id'],
                                'id_responsavel' => $responsavel['id_responsavel'],
                                'id_evento' => $responsavel['id_evento'],
                                'created_at' => $responsavel['created_at'],
                                'updated_at' => $responsavel['updated_at']
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
    
    public static function buscarResponsavelPeloId($id){
        try{
            $responsavel = Responsavel::find($id);
            return $responsavel != []? $responsavel : response()->json(['erro' => 'Responsavel não encontrado'], 404);
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }
    
    public function atualizarResponsavel(Request $request, $id){
        try{
            if(isset($request['rga_responsavel'])){
                $user = Responsavel::buscarRGA($request['rga_responsavel']);

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
            $responsavel = Responsavel::findOrFail($id);
            $responsavel->update($request->all());
            
            $responsavelAtualizado = Responsavel::findOrFail($id);
            return response()->json(
                    [
                        'responsavelAtualizado' => [
                            'id' => $responsavelAtualizado['id'],
                            'id_responsavel' => $responsavelAtualizado['id_responsavel'],
                            'id_evento' => $responsavelAtualizado['id_evento'],
                            'created_at' => $responsavelAtualizado['created_at'],
                            'updated_at' => $responsavelAtualizado['updated_at']
                        ]
                    ],
                    200
                );
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }


    public function deletarResponsavel($id){
        try{
            $responsavel = Responsavel::find($id);
            
            if($responsavel != null){
                $responsavelDeletado = $responsavel;
                $responsavel->delete();
                return response()->json(
                        [
                            'responsavelDeletado' => [
                                'id' => $responsavelDeletado['id'],
                                'id_responsavel' => $responsavelDeletado['id_responsavel'],
                                'id_evento' => $responsavelDeletado['id_evento'],
                                'created_at' => $responsavelDeletado['created_at'],
                                'updated_at' => $responsavelDeletado['updated_at']
                            ]
                        ],
                        200
                    );
            }
            else{
                response()->json(['erro' => "Responsavel não encontrado"], 404);
            }
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudante;

class EstudantesController extends Controller
{
    public function buscarEstudantes(){
        try{
            $nome = isset($_GET['nome'])? $_GET['nome'] : "";
            
            $estudantes = Estudante::buscarEstudantePeloNome($nome);
                       
            if(empty($estudantes)){
                echo $estudantes;
            }
            else {
                return response()->json(['erro' => 'Nenhum estudante encontrado'], 404);
            }
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }

    public function inserirEstudante(Request $request){
        try{
            $estudante = Estudante::create($request->all());

            return response()->json(
                    [
                        'estudanteInserido' => [
                            'id' => $estudante['id'],
                            'rga' => $estudante['rga'],
                            'nome' => $estudante['nome'],
                            'cpf' => $estudante['cpf'],
                            'data_nascimento' => $estudante['data_nascimento'],
                            'curso' => $estudante['curso'],
                            'created_at' => $estudante['created_at'],
                            'updated_at' => $estudante['updated_at']
                        ]
                    ],
                    201
                );
        }
        catch (Exception $ex){
            return response()->json(['erro' => $ex], 404);
        }
    }
    
    public static function buscarEstudantePeloId($id){
        try{
            $estudante = Estudante::find($id);
            return $estudante != []? $estudante : response()->json(['erro' => 'Estudante não encontrado'], 404);
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }
    
    public function atualizarEstudante(Request $request, $id){
        try{
            $estudante = Estudante::findOrFail($id);
            $estudante->update($request->all());
            
            $estudanteAtualizado = Estudante::findOrFail($id);
            return response()->json(
                    [
                        'estudanteAtualizado' => [
                            'id' => $estudanteAtualizado['id'],
                            'rga' => $estudanteAtualizado['rga'],
                            'nome' => $estudanteAtualizado['nome'],
                            'cpf' => $estudanteAtualizado['cpf'],
                            'data_nascimento' => $estudanteAtualizado['data_nascimento'],
                            'curso' => $estudanteAtualizado['curso'],
                            'created_at' => $estudanteAtualizado['created_at'],
                            'updated_at' => $estudanteAtualizado['updated_at']
                        ]
                    ],
                    200
                );
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }
    
    public function deletarEstudante($id){
        try{
            $estudante = Estudante::findOrFail($id);
            
            if($estudante != null){
                $estudanteDeletado = $estudante;
                $estudante->delete();
                return response()->json(
                        [
                            'estudanteDeletado' => [
                            'id' => $estudanteDeletado['id'],
                            'rga' => $estudanteDeletado['rga'],
                            'nome' => $estudanteDeletado['nome'],
                            'cpf' => $estudanteDeletado['cpf'],
                            'data_nascimento' => $estudanteDeletado['data_nascimento'],
                            'curso' => $estudanteDeletado['curso'],
                            'created_at' => $estudanteDeletado['created_at'],
                            'updated_at' => $estudanteDeletado['updated_at']
                            ]
                        ],
                        200
                    );
            }
            else{
                response()->json(['erro' => "Estudante não encontrado"], 404);
            }
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }
}

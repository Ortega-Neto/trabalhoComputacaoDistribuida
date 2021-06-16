<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carteirinha;

class CarteirinhasController extends Controller
{
    public function buscarCarteirinhas(){
        try{            
            $carteirinhas = Carteirinha::get();
                       
            if(!empty($carteirinhas[0])){
                echo $carteirinhas;
            }
            else {
                return response()->json(['erro' => 'Nenhuma Carteirinha encontrada'], 404);
            }
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }

    public function inserirCarteirinha(Request $request){
        try{
            $estudante = Carteirinha::buscarRGA($request['rga_carteirinha']);

            if(!empty($estudante[0])){
                $carteirinha = Carteirinha::create($request->all());

                return response()->json(
                        [
                            'carDeletadoteirinha' => [
                                'id' => $carteirinha['id'],
                                'rga_carteirinha' => $carteirinha['rga_carteirinha'],
                                'data_emissao' => $carteirinha['data_emissao'],
                                'created_at' => $carteirinha['created_at'],
                                'updated_at' => $carteirinha['updated_at']
                            ]
                        ],
                        201
                    );
            }
            else{
                return response()->json(['erro' => 'RGA não registrado'], 404);
            }
            
        }
        catch (Exception $ex){
            return response()->json(['erro' => $ex], 404);
        }
    }
    
    public static function buscarCarteirinhaPeloId($id){
        try{
            $carteirinha = Carteirinha::find($id);
            return $carteirinha != []? $carteirinha : response()->json(['erro' => 'Carteirinha não encontrado'], 404);
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }
    
    public function atualizarCarteirinha(Request $request, $id){
        try{
            if(isset($request['rga_carteirinha'])){
                $estudante = Carteirinha::buscarRGA($request['rga_carteirinha']);

                if(!empty($estudante[0])){
                    return $this->realizarAtualizacao($request, $id);
                }
                else{
                    return response()->json(['erro' => 'RGA não registrado'], 404);
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
            $carteirinha = Carteirinha::findOrFail($id);
            $carteirinha->update($request->all());
            
            $carteirinhaAtualizada = Carteirinha::findOrFail($id);
            return response()->json(
                    [
                        'carDeletadoteirinha' => [
                            'id' => $carteirinhaAtualizada['id'],
                            'rga_carteirinha' => $carteirinhaAtualizada['rga_carteirinha'],
                            'data_emissao' => $carteirinhaAtualizada['data_emissao'],
                            'created_at' => $carteirinhaAtualizada['created_at'],
                            'updated_at' => $carteirinhaAtualizada['updated_at']
                        ]
                    ],
                    200
                );
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }


    public function deletarCarteirinha($id){
        try{
            $carteirinha = Carteirinha::findOrFail($id);
            
            if($carteirinha != null){
                $carteirinhaDeletada = $carteirinha;
                $carteirinha->delete();
                return response()->json(
                        [
                            'carteirinhaDeletado' => [
                                'id' => $carteirinhaDeletada['id'],
                                'rga_carteirinha' => $carteirinhaDeletada['rga_carteirinha'],
                                'data_emissao' => $carteirinhaDeletada['data_emissao'],
                                'created_at' => $carteirinhaDeletada['created_at'],
                                'updated_at' => $carteirinhaDeletada['updated_at']
                            ]
                        ],
                        200
                    );
            }
            else{
                response()->json(['erro' => "Carteirinha não encontrada"], 404);
            }
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }
}

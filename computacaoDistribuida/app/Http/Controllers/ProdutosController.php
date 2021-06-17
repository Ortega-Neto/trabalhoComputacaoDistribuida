<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutosController extends Controller
{
    public function buscarProdutos(){
        try{            
            $produtos = Produto::get();
                       
            if(!empty($produtos[0])){
                echo $produtos;
            }
            else {
                return response()->json(['erro' => 'Nenhuma Produto encontrado'], 404);
            }
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }

    public function inserirProduto(Request $request){
        try{
            $user = Produto::buscarIdUser($request['id_administrador']);

            if(!empty($user[0])){
                $produto = Produto::create($request->all());

                return response()->json(
                        [
                            'produtoInserido' => [
                                'id' => $produto['id'],
                                'nome' => $produto['nome'],
                                'tamanho' => $produto['tamanho'],
                                'quantidade' => $produto['quantidade'],
                                'preco' => $produto['preco'],
                                'id_administrador' => $produto['id_administrador'],
                                'created_at' => $produto['created_at'],
                                'updated_at' => $produto['updated_at']
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
    
    public static function buscarProdutoPeloId($id){
        try{
            $produto = Produto::find($id);
            return $produto != []? $produto : response()->json(['erro' => 'Produto não encontrado'], 404);
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }
    
    public function atualizarProduto(Request $request, $id){
        try{
            if(isset($request['rga_produto'])){
                $user = Produto::buscarRGA($request['rga_produto']);

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
            $produto = Produto::findOrFail($id);
            $produto->update($request->all());
            
            $produtoAtualizado = Produto::findOrFail($id);
            return response()->json(
                    [
                        'produtoAtualizado' => [
                            'id' => $produtoAtualizado['id'],
                            'nome' => $produtoAtualizado['nome'],
                            'tamanho' => $produtoAtualizado['tamanho'],
                            'quantidade' => $produtoAtualizado['quantidade'],
                            'preco' => $produtoAtualizado['preco'],
                            'id_administrador' => $produtoAtualizado['id_administrador'],
                            'created_at' => $produtoAtualizado['created_at'],
                            'updated_at' => $produtoAtualizado['updated_at']
                        ]
                    ],
                    200
                );
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }


    public function deletarProduto($id){
        try{
            $produto = Produto::findOrFail($id);
            
            if($produto != null){
                $produtoDeletado = $produto;
                $produto->delete();
                return response()->json(
                        [
                            'produtoDeletado' => [
                                'id' => $produtoDeletado['id'],
                                'nome' => $produtoDeletado['nome'],
                                'tamanho' => $produtoDeletado['tamanho'],
                                'quantidade' => $produtoDeletado['quantidade'],
                                'preco' => $produtoDeletado['preco'],
                                'id_administrador' => $produtoDeletado['id_administrador'],
                                'created_at' => $produtoDeletado['created_at'],
                                'updated_at' => $produtoDeletado['updated_at']
                            ]
                        ],
                        200
                    );
            }
            else{
                response()->json(['erro' => "Produto não encontrado"], 404);
            }
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function buscarUsers(){
        try{
            
            $users = User::get();
                       
            if(!empty($users[0])){
                echo $users;
            }
            else {
                return response()->json(['erro' => 'Nenhum user encontrado'], 404);
            }
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }

    public function inserirUser(Request $request){
        try{
            $user = User::create($request->all());

            return response()->json(
                    [
                        'userInserido' => [
                            'id' => $user['id'],
                            'nome' => $user['nome'],
                            'email' => $user['email'],
                            'cpf' => $user['cpf'],
                            'email_verified_at' => $user['email_verified_at'],
                            'password' => $user['password'],
                            'remember_token' => $user['remember_token'],
                            'created_at' => $user['created_at'],
                            'updated_at' => $user['updated_at']
                        ]
                    ],
                    201
                );
        }
        catch (Exception $ex){
            return response()->json(['erro' => $ex], 404);
        }
    }
    
    public static function buscarUserPeloId($id){
        try{
            $user = User::find($id);
            return $user != []? $user : response()->json(['erro' => 'User não encontrado'], 404);
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }
    
    public function atualizarUser(Request $request, $id){
        try{
            $user = User::findOrFail($id);
            $user->update($request->all());
            
            $userAtualizado = User::findOrFail($id);
            return response()->json(
                    [
                        'userAtualizado' => [
                            'id' => $userAtualizado['id'],
                            'nome' => $userAtualizado['nome'],
                            'email' => $userAtualizado['email'],
                            'cpf' => $userAtualizado['cpf'],
                            'email_verified_at' => $userAtualizado['email_verified_at'],
                            'password' => $userAtualizado['password'],
                            'remember_token' => $userAtualizado['remember_token'],
                            'created_at' => $userAtualizado['created_at'],
                            'updated_at' => $userAtualizado['updated_at']
                        ]
                    ],
                    200
                );
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }
    
    public function deletarUser($id){
        try{
            $user = User::findOrFail($id);
            
            if($user != null){
                $userDeletado = $user;
                $user->delete();
                return response()->json(
                        [
                            'userDeletado' => [
                                'id' => $userDeletado['id'],
                                'nome' => $userDeletado['nome'],
                                'email' => $userDeletado['email'],
                                'cpf' => $userDeletado['cpf'],
                                'email_verified_at' => $userDeletado['email_verified_at'],
                                'password' => $userDeletado['password'],
                                'remember_token' => $userDeletado['remember_token'],
                                'created_at' => $userDeletado['created_at'],
                                'updated_at' => $userDeletado['updated_at']
                            ]
                        ],
                        200
                    );
            }
            else{
                response()->json(['erro' => "User não encontrado"], 404);
            }
        } catch (Exception $ex) {
            return response()->json(['erro' => $ex], 404);
        }
    }
}

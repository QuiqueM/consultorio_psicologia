<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class requestRegistro extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>'required|email||unique:users',
            'password'=>'required|min:8',
            'password2'=>'required|min:8',
            'password2'=>'same:password'
        ];
    }
    public function messages(){
        return[
            'email.required'=>'El campo correo es obligatorio',
            'email.unique'=>'El correo ya esta siendo usado',

            'password.required'=>'El campo contraseña es obligatorio con un minimo de 8 caracteres',
            'password2'=>'Campo confirmacion de contraseña obligatorio',
            'password2.same'=>'las contraseñas no coiciden'
        ];
    }
}

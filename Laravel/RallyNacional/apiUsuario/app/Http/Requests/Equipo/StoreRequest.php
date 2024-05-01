<?php

namespace App\Http\Requests\Equipo;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            "nombre" => ["required"],
            "participantes" => ["required", "array"],
            "sede_id" => ["required"],
            "desafio_id" => ["required"],
            "participantes.*.nombres" => ["required"],
            "participantes.*.apellidos" => ["required"],
            "participantes.*.cedula" => ["required", "min:16", "max:16"],
            "participantes.*.genero_id" => ["required"]
        ];
    }
}

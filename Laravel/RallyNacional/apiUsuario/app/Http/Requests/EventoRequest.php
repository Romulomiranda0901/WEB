<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /*
        $user = $this->user();
        $rol = $user->rol()->get();
        dd($rol);
        */
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
            "fecha_inicia" => ["required", "date"],
            "fecha_finaliza" => ["required", "date"],
            "anyo" => ["required", "numeric"]
        ];
    }
}

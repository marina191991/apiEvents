<?php

namespace App\Http\Requests;

use App\Models\Ticket;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    protected $ticketsIds =[] ;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(\Illuminate\Http\Request $request): array
    {
        return [
           'places' => ['required', 'array'],
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return ['places.array' => 'Places must be array'];
    }
}

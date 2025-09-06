<?php

namespace App\Http\Requests;

class UpdateTicketRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'status' => 'nullable|string',
            'priority' => 'nullable|string',
        ];
    }
}

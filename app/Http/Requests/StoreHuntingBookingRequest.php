<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHuntingBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tour_name' => 'required|string|max:255',
            'hunter_name' => 'required|string|max:255',
            'guide_id' => 'required|exists:guides,id',
            'date' => 'required|date|after_or_equal:today',
            'participants_count' => 'required|integer|min:1|max:10',
        ];
    }
}

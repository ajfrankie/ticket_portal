<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Adjust if you need auth checks later
    }

    public function rules(): array
    {
        return [
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'nullable|in:open,in_progress,closed',
            'user_id' => 'required|exists:users,id', // Ensure the user exists
        ];
    }

    public function messages(): array
    {
        return [
            'subject.required' => 'The subject is required.',
            'description.required' => 'The description is required.',
            'priority.required' => 'Please select a priority.',
            'priority.in' => 'Invalid priority selected.',
            'status.in' => 'Invalid status provided.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // obsłużysz policy później
    }

    public function rules()
    {
        return [
            'title'       => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'priority'    => 'sometimes|string|in:low,medium,high',
            'status'      => 'sometimes|string|in:open,in_progress,closed',
            'assignee_id' => 'nullable|exists:users,id',
            'tags'        => 'array',
            'tags.*'      => 'integer|exists:tags,id',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true; // obsłużysz policy później
    }

    public function rules()
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'priority'    => 'required|string|in:low,medium,high',
            'status'      => 'required|string|in:open,in_progress,closed',
            'assignee_id' => 'nullable|exists:users,id',
            'tags'        => 'array',
            'tags.*'      => 'integer|exists:tags,id',
        ];
    }
}

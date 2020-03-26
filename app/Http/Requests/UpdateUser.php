<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUser extends FormRequest
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
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'email' => [
                'nullable',
                'email',
                function ($attribute, $value, $fail) {
                    $id = $this->route('user');
                    $user = User::where('email',$this->email)->where('user_id','<>',$id)->get()->count();
                    if ($user) {
                        $fail(__('messages.emailTaken'));
                    }
                },
            ]
        ];
    }
}

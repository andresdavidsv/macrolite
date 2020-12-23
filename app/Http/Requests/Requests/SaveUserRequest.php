<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SaveUserRequest extends FormRequest
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
        if ($this->isMethod('PATCH')) {
            $password = ['nullable', 'string', 'min:8','required_with:password-confirm'];
        } else {
            $password = ['required', 'string', 'min:8'];
        }

        return [
            'name' => 'required',
            'email' => ['required','email',Rule::unique('users')->ignore($this->user)],
            'password' => $password,
            'password-confirm' => ['required_with:password', 'sometimes','same:password'],
        ];
    }

    public function createUser(SaveUserRequest $request)
    {
        DB::transaction(function () use($request) {
            $user = User::create($this->validated());
            $user['password'] = Hash::make($user['password']);

            $user->save();
        });
    }

    public function updateUser(User $user,SaveUserRequest $request)
    {
        DB::transaction(function () use($user,$request) {

            $data = $this->validated();
            if ($data['password'] != NULL) {
                $data['password']  = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $user->fill($data);
            $user->save();

        });
    }
}
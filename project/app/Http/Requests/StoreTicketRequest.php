<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required_without:phone', 'email'],
            'phone' => ['required_without:email', 'regex:/^\+?[0-9]{1,15}$/'], // E.164
            'theme' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'files'  => ['nullable', 'array'],
            'files.*' => ['nullable', 'file', 'mimes:jpg,jpeg,png,gif,zip,rar,glb,gltf', 'max:153600'], // 150MB
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Не заполнены обязательные поля.',

            'email.email' => 'Поле email должно соответствовать формату email',
            '*.required_without' => 'Укажите email или телефон.',

            'phone.regex' => 'Неверный формат телефона (E.164).',

            'theme.string' => 'Поле theme должно быть строкой.',
            'theme.max' => 'Поле theme не должно превышать 255 символов.',

            'text.string' => 'Поле text должно быть строкой.',

            'files.mimes' => 'Недопустимый формат файла!',
            'files.*.max' => 'Файл не должен превышать 150 МБ.',
        ];
    }
}

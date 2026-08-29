<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class RegisterRequest extends FormRequest
{
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $commonPasswords = array_flip(array_map(
            static fn (string $password): string => strtolower(trim($password)),
            file(public_path('10k-most-common.txt'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: []
        ));

        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'business_name' => ['nullable', 'string', 'max:255'],
            'business_address' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', function (string $attribute, mixed $value, \Closure $fail): void {
                $user = User::withTrashed()->where('email', $value)->first();
                if (!$user) return;

                if ($user->trashed() && $user->deleted_at->addDays(15)->isFuture()) {
                    $fail('You cannot register with this email until ' . $user->deleted_at->addDays(15)->format('d M Y, H:i') . '.');
                    return;
                }

                if (!$user->trashed()) $fail('This email is already registered.');
            }],
            'phone' => ['nullable', 'regex:/^[6-9][0-9]{9}$/', Rule::unique('users', 'phone')],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:255',
                function (string $attribute, mixed $value, \Closure $fail) use ($commonPasswords): void {
                    if (isset($commonPasswords[strtolower($value)])) {
                        $fail('This password is too common. Please choose a stronger password.');
                    }
                },
            ],
            'password_confirmation' => ['required', 'same:password'],
        ];
    }
}

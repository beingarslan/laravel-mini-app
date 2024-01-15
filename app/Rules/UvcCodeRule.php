<?php

namespace App\Rules;

use App\Models\UvcCode;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UvcCodeRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $uvc_code = UvcCode::where('uvc', $value)->first();

        if (!$uvc_code) {
            $fail('The UVC Code is invalid.');
        }

        if ($uvc_code?->is_used) {
            $fail('The UVC Code is already used.');
        }
    }
}

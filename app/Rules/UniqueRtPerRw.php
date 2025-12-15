<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Rt;

class UniqueRtPerRw implements ValidationRule
{
    protected $rwId;
    protected $excludeRtId;

    public function __construct($rwId, $excludeRtId = null)
    {
        $this->rwId = $rwId;
        $this->excludeRtId = $excludeRtId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = Rt::where('rw_id', $this->rwId)
                   ->where('nomor_rt', $value);

        // Exclude current RT when updating
        if ($this->excludeRtId) {
            $query->where('rt_id', '!=', $this->excludeRtId);
        }

        if ($query->exists()) {
            $fail('Nomor RT :input sudah ada di RW ini.');
        }
    }
}

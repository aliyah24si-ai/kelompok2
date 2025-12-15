<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\AnggotaLembaga;

class NoOverlappingPeriod implements ValidationRule
{
    protected $wargaId;
    protected $lembagaId;
    protected $jabatanId;
    protected $tglMulai;
    protected $excludeId;

    public function __construct($wargaId, $lembagaId, $jabatanId, $tglMulai, $excludeId = null)
    {
        $this->wargaId = $wargaId;
        $this->lembagaId = $lembagaId;
        $this->jabatanId = $jabatanId;
        $this->tglMulai = $tglMulai;
        $this->excludeId = $excludeId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Skip validation if jabatan is null (allowed)
        if (!$this->jabatanId) {
            return;
        }

        $hasOverlap = AnggotaLembaga::hasOverlappingPeriod(
            $this->wargaId,
            $this->lembagaId,
            $this->jabatanId,
            $this->tglMulai,
            $value, // tgl_selesai
            $this->excludeId
        );

        if ($hasOverlap) {
            $fail('Warga sudah memiliki jabatan yang sama di lembaga ini dengan periode yang bersinggungan.');
        }
    }
}

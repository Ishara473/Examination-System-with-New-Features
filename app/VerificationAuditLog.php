<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerificationAuditLog extends Model
{
    protected $table = 'verification_audit_logs';

    protected $fillable = [
        'document_id_searched',
        'registration_no_searched',
        'verification_method',
        'is_valid',
        'failure_reason',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'is_valid' => 'boolean',
    ];

    public function transcript()
    {
        return $this->belongsTo(Transcript::class);
    }
}


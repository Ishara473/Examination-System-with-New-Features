<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transcript extends Model
{
    protected $table = 'transcripts';

    protected $fillable = [
        'document_id',
        'student_id',
        'batch_id',
        'fgpa',
        'class_name',
        'degree_name',
        'effective_date',
        'status',
        'status_reason',
        'status_updated_by',
        'issued_by',
        'issued_at',
    ];

    protected $casts = [
        'effective_date' => 'date',
        'issued_at' => 'datetime',
        'fgpa' => 'decimal:2',
    ];

    public function student()
    {
        return $this->belongsTo(\App\Student::class, 'student_id', 'id');
    }

    public function batch()
    {
        return $this->belongsTo(\App\Batch::class, 'batch_id', 'id');
    }

    public function issuedBy()
    {
        return $this->belongsTo(\App\User::class, 'issued_by', 'id');
    }

    public function statusUpdatedBy()
    {
        return $this->belongsTo(\App\User::class, 'status_updated_by', 'id');
    }

    public function tokens()
    {
        return $this->hasMany(\App\TranscriptToken::class, 'transcript_id', 'id');
    }

    public function activeToken()
    {
        return $this->hasOne(\App\TranscriptToken::class, 'transcript_id', 'id')->where('status', 'active')->latestOfMany();
    }
}


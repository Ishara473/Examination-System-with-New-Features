<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TranscriptToken extends Model
{
    protected $table = 'transcript_tokens';

    protected $fillable = [
        'transcript_id',
        'token_hash',
        'status',
        'revoked_at',
    ];

    protected $casts = [
        'revoked_at' => 'datetime',
    ];

    public function transcript()
    {
        return $this->belongsTo(\App\Transcript::class, 'transcript_id', 'id');
    }
}


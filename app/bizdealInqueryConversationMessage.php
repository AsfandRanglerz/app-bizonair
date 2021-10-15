<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bizdealInqueryConversationMessage extends Model
{
    /**
     * Get the user that owns the BizdealInquiryConversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Get the user that owns the bizdealInqueryConversationMessage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function convertsation()
    {
        return $this->belongsTo(BizdealInquiryConversation::class, 'conversation_id', 'id');
    }
    
}

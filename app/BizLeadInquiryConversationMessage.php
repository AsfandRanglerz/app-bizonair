<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BizLeadInquiryConversationMessage extends Model
{
     /**
     * Get the user that owns the BizdealInquiryConversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function created_by()
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
        return $this->belongsTo(BizLeadInquiryConversation::class, 'conversation_id', 'id');
    }

    /**
     * Get all of the comments for the BizLeadInquiryConversationMessage
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function my_read_messages()
    {
        return $this->hasMany(BizLeadInquiryConvoRead::class, 'message_id', 'id')->where('created_by',\Auth::id());
    }
}

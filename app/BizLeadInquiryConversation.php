<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BizLeadInquiryConversation extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    /**
     * Get all of the comments for the BizdealInquiryConversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(BizLeadInquiryConversationMessage::class, 'conversation_id', 'id');
    }

    /**
     * Get all of the comments for the BizLeadInquiryConversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function other_user_messages()
    {
        return $this->hasMany(BizLeadInquiryConversationMessage::class, 'conversation_id', 'id')->where('created_by','<>', \Auth::id());
    }

    /**
     * Get the user that owns the BizdealInquiryConversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function created_by_user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function latestMessage()
    {
        return $this->hasOne(BizLeadInquiryConversationMessage::class, 'conversation_id', 'id')->latest();
    }
    public function my_latest_message(){
        return $this->hasOne(BizLeadInquiryConversationMessage::class, 'conversation_id', 'id')->where('created_by', \Auth::id())->latest();
    }
    public function latestMessageNotMine()
    {
        return $this->hasOne(BizLeadInquiryConversationMessage::class, 'conversation_id', 'id')->where('created_by', '<>' ,\Auth::id())->latest();
    }
    /** 
    * Get all of the delete_convo for the BizdealInquiryConvoDelete
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function delete_convos()
   {
       return $this->hasMany(BizLeadInquiryConvoDelete::class, 'conversation_id', 'id');
   }
   /** 
    * Get all of the delete_convo for the BizdealInquiryConvoDelete
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function fav_convos()
    {
        return $this->hasMany(BizLeadInquiryConvoFav::class, 'conversation_id', 'id')->where('created_by',\Auth::id())->first();
    }

    /**
     * Get all of the favoro for the BizdealInquiryConversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorite_conversations()
    {
        return $this->hasMany(BizLeadInquiryConvoFav::class, 'conversation_id', 'id')->where('created_by',\Auth::id());
    }

    /**
     * Get all of the favoro for the BizdealInquiryConversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pin_conversations()
    {
        return $this->hasMany(BizLeadInquiryConvoPin::class, 'conversation_id', 'id')->where('created_by',\Auth::id());
    }
}

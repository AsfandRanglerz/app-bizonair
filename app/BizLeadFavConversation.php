<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BizLeadFavConversation extends Model
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
        return $this->hasMany(BizLeadFavConversationMessages::class, 'conversation_id', 'id');
    }

    /**
     * Get all of the comments for the BizLeadInquiryConversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function other_user_messages()
    {
        return $this->hasMany(BizLeadFavConversationMessages::class, 'conversation_id', 'id')->where('created_by','<>', \Auth::id());
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
        return $this->hasOne(BizLeadFavConversationMessages::class, 'conversation_id', 'id')->latest();
    }
    public function my_latest_message(){
        return $this->hasOne(BizLeadFavConversationMessages::class, 'conversation_id', 'id')->where('created_by', \Auth::id())->latest();
    }
    public function latestMessageNotMine()
    {
        return $this->hasOne(BizLeadFavConversationMessages::class, 'conversation_id', 'id')->where('created_by', '<>' ,\Auth::id())->latest();
    }
    /** 
    * Get all of the delete_convo for the BizdealInquiryConvoDelete
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function delete_convos()
   {
       return $this->hasMany(BizLeadFavConvoDelete::class, 'conversation_id', 'id');
   }
   /** 
    * Get all of the delete_convo for the BizdealInquiryConvoDelete
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function fav_convos()
    {
        return $this->hasMany(BizLeadFavConvoFav::class, 'conversation_id', 'id')->where('created_by',\Auth::id())->first();
    }

    /**
     * Get all of the favoro for the BizdealInquiryConversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorite_conversations()
    {
        return $this->hasMany(BizLeadFavConvoFav::class, 'conversation_id', 'id')->where('created_by',\Auth::id());
    }

    /**
     * Get all of the favoro for the BizdealInquiryConversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pin_conversations()
    {
        return $this->hasMany(BizLeadFavConvoPin::class, 'conversation_id', 'id')->where('created_by',\Auth::id());
    }
}

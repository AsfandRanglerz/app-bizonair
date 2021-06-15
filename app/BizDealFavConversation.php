<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BizDealFavConversation extends Model
{
    use SoftDeletes;
    /**
     * Get the user that owns the BizdealInquiryConversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(BuySell::class, 'buy_sell_id', 'id');
    }
    /**
     * Get all of the comments for the BizdealInquiryConversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(BizDealFavConversationMessage::class, 'conversation_id', 'id');
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
        return $this->hasOne(BizDealFavConversationMessage::class, 'conversation_id', 'id')->latest();
    }
    public function my_latest_message(){
        return $this->hasOne(BizDealFavConversationMessage::class, 'conversation_id', 'id')->where('created_by', \Auth::id())->latest();
    }
    public function latestMessageNotMine()
    {
        return $this->hasOne(BizDealFavConversationMessage::class, 'conversation_id', 'id')->where('created_by', '<>' ,\Auth::id())->latest();
    }
    /** 
    * Get all of the delete_convo for the BizdealInquiryConvoDelete
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function delete_convos()
   {
       return $this->hasMany(BizDealFavConvoDelete::class, 'conversation_id', 'id');
   }
   /** 
    * Get all of the delete_convo for the BizdealInquiryConvoDelete
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function fav_convos()
    {
        return $this->hasMany(BizDealFavConvoFav::class, 'conversation_id', 'id')->where('created_by',\Auth::id())->first();
    }

    /**
     * Get all of the favoro for the BizdealInquiryConversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorite_conversations()
    {
        return $this->hasMany(BizDealFavConvoFav::class, 'conversation_id', 'id')->where('created_by',\Auth::id());
    }

    /**
     * Get all of the favoro for the BizdealInquiryConversation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pin_conversations()
    {
        return $this->hasMany(BizDealFavConvoPin::class, 'conversation_id', 'id')->where('created_by',\Auth::id());
    }
}

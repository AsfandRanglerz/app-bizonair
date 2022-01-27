<?php

namespace App\Http\Controllers;
use Storage;
use App\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FavouriteController extends Controller
{
    public function add_to_favourite(Request $request)
    {

        $data = $request->all();
        $loger_id = auth()->user()->id;
        $reference_no = $data['reference_no'];
        $product_service_name = $data['product_service_name'];
        $product_service_types = $data['product_service_types'];
        $created_at = Carbon::now();
        $updated_at = Carbon::now();

        if(\DB::table('favourites')->where(['user_id'=>$loger_id,'reference_no'=>$reference_no])->exists()){
// record already exist
            $prdct = \App\Product::where('reference_no', $reference_no)->first();
            if($prdct){
                $cpany = \App\UserCompany::where('company_id', $prdct->company_id)->get();
                foreach($cpany as $cmp){
                    \App\Notification::where('user_id',$cmp->user_id)->where('table_name','favourites')->where('prod_id',$prdct->id)->delete();
                }
            }else{
                $bysell = \App\BuySell::where('reference_no', $reference_no)->first();
                \App\Notification::where('user_id',$bysell->user_id)->where('table_name','favourites')->where('prod_id',$bysell->id)->delete();
            }
            DB::delete('delete from favourites where reference_no = ?', [$reference_no]);
            $data['feedback'] = 'true';
            $data['msg'] = 'Product removed from favourite';

        }else {
            DB::insert('insert into favourites (product_service_name,product_service_types,reference_no,user_id,created_at,updated_at) values (?, ?,?,?,?,?)', [
                $product_service_name, $product_service_types, $reference_no, $loger_id, $created_at, $updated_at
            ]);

            $product = \App\Product::where('reference_no', $reference_no)->first();
            if ($product) {
                $cmpny = \App\CompanyProfile::find($product->company_id);
                $company = \App\UserCompany::where('company_id', $product->company_id)->get();
                $user = \App\User::find($cmpny->user_id);

                $detail['user_name'] = auth()->user()->name;
                $detail['email'] = auth()->user()->email;
                $detail['product_title'] = $product_service_name;
                $detail['reference_no'] = $reference_no;

                ////////Added by taha for the fav product management

                $inq = new \App\BizLeadFavConversation();
                $inq->product_id = $product->id;
                $inq->created_by = \Auth::id();
                if($inq->save()){
                    $message = new \App\BizLeadFavConversationMessages();
                    $message->conversation_id = $inq->id;
                    $output = "Your product ".$product->product_service_name. " with Refrence#".$product->reference_no." is added to favorite by ".auth()->user()->name.".";
                    $message->message = $output;
                    $message->created_by = \Auth::id();
                    $message->save();
                }


                $userId=  \App\UserCompany::where('company_id', $product->company_id)->pluck('user_id');
                $getUser = \App\User::whereIn('id',$userId)->get();
                foreach ($getUser as $userEmail){
                    \Mail::to($userEmail->email)->send(new \App\Mail\FavouriteProductMail($detail));
                }

                foreach ($company as $comp) {
                    $notification = new Notification();
                    $notification->user_id = $comp->user_id;
                    $notification->table_name = 'favourites';
                    $notification->table_data = 'Lead';
                    $notification->notification_text = $product->product_service_name . ' Favourite product added by ' . auth()->user()->name;
                    $notification->prod_id = $product->id;
                    $notification->product_service_types = $product->product_service_types;
                    $notification->product_service_name = $product->product_service_name;
                    $notification->prod_comp_id = $product->company_id;
                    $notification->save();
                }
            } else {
                $buysell = \App\BuySell::where('reference_no', $reference_no)->first();
                $user = \App\User::find($buysell->user_id);

                $detail['user_name'] = auth()->user()->name;
                $detail['email'] = auth()->user()->email;
                $detail['product_title'] = $product_service_name;
                $detail['reference_no'] = $reference_no;
                \Mail::to($user->email)->send(new \App\Mail\FavouriteProductMail($detail));

                $notification = new Notification();
                $notification->user_id = $user->id;
                $notification->table_name = 'favourites';
                $notification->table_data = 'Deal';
                $notification->notification_text = $buysell->product_service_name . ' Favourite product added by ' . auth()->user()->name;
                $notification->prod_id = $buysell->id;
                $notification->product_service_types = $buysell->product_service_types;
                $notification->product_service_name = $buysell->product_service_name;
                $notification->prod_user_id = $buysell->user_id;
                $notification->save();


                ////////Added by taha for the fav product management

                $inq = new \App\BizDealFavConversation();
                $inq->buy_sell_id = $buysell->id;
                $inq->created_by = \Auth::id();
                if($inq->save()){
                    $message = new \App\BizDealFavConversationMessage();
                    $message->conversation_id = $inq->id;
                    $output = "Your product ".$buysell->product_service_name. " with Refrence#".$buysell->reference_no." is added to favorite by ".auth()->user()->name.".";
                    $message->message = $output;
                    $message->created_by = \Auth::id();
                    $message->save();
                }

            }

            $data['feedback'] = 'true';
            $data['msg'] = 'Product added to favourite.';
        }
        return json_encode($data);

    }

    public function get_lead_view_favourites()
    {
        $data['active'] = 'Favourite';
        $data['title'] = 'Your Favourite Leads';
        $data['user'] = \App\User::find(\auth()->id());
        $data['order'] = 'desc';
        $data['favourite'] = \App\Favourite::where('user_id','=',auth()->user()->id)->whereBetween('reference_no', ['100000', '4900000']);
        $data['count'] = $data['favourite']->count();
        $data['favourite'] = $data['favourite']->paginate();
        $data['page'] = 'bizoffice.favourite.favourite-lead-list';
        DB::table('notifications')
            ->where('user_id', auth()->id())
            ->where('prod_comp_id',\session()->get('company_id'))
            ->where('table_name','favourites')
            ->where('table_data','Lead')
            ->update(['is_display' => 1,'is_read'=>1]);

        return view('front_site.' . $data['page'])->with($data);
    }

    public function get_deal_view_favourites()
    {
        $data['active'] = 'Favourite';
        $data['title'] = 'Your Favourite Deals';
        $data['user'] = \App\User::find(\auth()->id());
        $data['order'] = 'desc';
        $data['favourite'] = \App\Favourite::where('user_id','=',auth()->user()->id)->whereNotBetween('reference_no', ['100000', '4900000']);
        $data['count'] = $data['favourite']->count();
        $data['favourite'] = $data['favourite']->paginate();
        $data['page'] = 'bizoffice.favourite.favourite-deal-list';

        DB::table('notifications')
            ->where('user_id', auth()->id())
            ->where('table_name','favourites')
            ->where('table_data','Deal')
            ->update(['is_display' => 1,'is_read'=>1]);
        return view('front_site.' . $data['page'])->with($data);
    }

    public function remove_favourite_product()
    {
        try {
            $favourite_id = decrypt(request('favourite_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($favourite_id) {

            DB::delete('delete from favourites where id = ?', [$favourite_id]);
            $data['feedback'] = 'true';
            $data['msg'] = 'Favourite Product has been removed successfully';
        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function view_blogs()
    {
        $data['active'] = 'News And Articles';
        $data['title'] = 'News & Articles';
        $data['user'] = \App\User::find(\auth()->id());
        $data['order'] = 'desc';
        $data['journal'] = \App\Journal::where('user_id','=',auth()->id());
        $data['count'] = $data['journal']->count();
        $data['journal'] = $data['journal']->get();
        $data['page'] = 'bizoffice.news-articles.news-article';


        return view('front_site.' . $data['page'])->with($data);
    }

    public function view_add_blogs()
    {
        $data['user'] = \App\User::find(\auth()->id());
        return view('front_site.bizoffice.news-articles.news-article-form', $data);
    }

    public function blog_create_form(Request $request)
    {

        $rules = [
            'title' => 'required', 'image' => 'required', 'journal_type' => 'required',

        ];
        $messages = [
            'title.required' => 'post title is required',
            'image.required' => 'post image is required',
            'journal_type.required' => 'post journal type is required',

        ];
        //dd($request->all());
        $validator = \Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            $data['feedback'] = 'false';
            $data['errors'] = $validator->errors()->getMessages();
            $data['msg'] = '';
            return json_encode($data);
        } else {

            $post = new \App\Journal();
            $post->title= request('title');
            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('journal/',$image_name,'s3');
                $path = 'journal'.'/'.$image_name;
                $url = Storage::disk('s3')->url($path);
                $post->image = $url;
            }
            $post->description= request('description');
            $post->journal_type_name= request('journal_type');
            $post->user_id= auth()->user()->id;
            $post->user_name= auth()->user()->name;

            $post->save();

            if (1 == 1) {

                $data['feedback'] = "true";
                $data['msg'] = 'News Or Article has been saved successfully';
                $data['url'] = route('view-blogs');


            } else {
                $data['feedback'] = "other";
                $data['custom_msg'] = 'Something went wrong';
            }
            return json_encode($data);
        }
    }

    public function remove_news_articles()
    {
        try {
            $journal_id = decrypt(request('journal_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($journal_id) {

            DB::delete('delete from journals where id = ?', [$journal_id]);
            $data['feedback'] = 'true';
            $data['msg'] = 'Article Or News removed successfully';
        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function edit_article_news($id)
    {
        $data['user'] = \App\User::find(\auth()->id());

        $data['info'] = \App\Journal::where('id','=',$id)->first();

        return view('front_site.bizoffice.news-articles.news-article-edit', $data);
    }

    public function update_news_article(Request $request)
    {
//        dd($request->all());

        $rules = [
            'title' => 'required', 'journal_type' => 'required',

        ];
        $messages = [
            'title.required' => 'post title is required',
//            'image.nullable' => 'post image is required',
            'journal_type.required' => 'journal type is required',
//            'journal_type.required' => 'post journal type is required',

        ];
        $validator = \Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            $data['feedback'] = 'false';
            $data['errors'] = $validator->errors()->getMessages();
            $data['msg'] = '';
            return json_encode($data);
        } else {
            $id= request('id');
            $title = request('title');
            if(!empty(request('description')))
            {
                $description = request('description');
            }
            else
            {
                $description = "";
            }
            //$publish_date = request('date');
            $journal_type_name = request('journal_type');
            $user_id = auth()->id();
            $user_name = auth()->user()->name;
            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('journal/',$image_name,'s3');
                $path = 'journal'.'/'.$image_name;
                $url = Storage::disk('s3')->url($path);
                $post = $url;
                \App\Journal::where('id', request('id'))->update(['image'=>$post]);
            }
            $journal =  \App\Journal::where('id',$id)->first();
            $journal->title = $title;
            $journal->description = $description;
            $journal->journal_type_name = $journal_type_name;
            $journal->user_id = $user_id;
            $journal->user_name = $user_name;

            if ($journal->save()) {

                $data['feedback'] = "updated";
                $data['msg'] = 'News or Article has been Updated successfully';
                $data['url'] = route('view-blogs');


            } else {
                $data['feedback'] = "other";
                $data['custom_msg'] = 'Something went wrong';
            }

            return json_encode($data);
        }
    }

    public function is_read_notification(Request $request)
    {
        try {
            $notifi_id = request('notifi_id');
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($notifi_id) {

            DB::table('notifications')
                ->where('table_name','!=','inquiries')
                ->where('table_name','!=','favourites')
                ->where('id', $notifi_id)
                ->update(['is_read' => 1]);

            $data['feedback'] = 'true';
        } else {
            $data['feedback'] = 'false';
        }

        return json_encode($data);
    }

    public function is_display_notification(Request $request)
    {
        try {
            $notifi_id = request('notifi_id');
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($notifi_id) {

            DB::table('notifications')
                ->where('id', $notifi_id)
                ->update(['is_display' => 1]);

            $data['feedback'] = 'true';
        } else {
            $data['feedback'] = 'false';
        }

        return json_encode($data);
    }
    public function send_notification_id(Request $request)
    {
        try {
            $notifi_id = request('notifi_id');
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($notifi_id) {
            DB::table('notifications')
                ->where('id', $notifi_id)
                ->update(['is_display' => 1]);
            $notifi = \App\Notification::where('user_id',auth()->id())->where('id',$notifi_id)->first();
            if ($notifi->table_name == 'favourites' && $notifi->table_data == 'Lead') {
                $data['url'] = route('get-lead-fav');
            } elseif ($notifi->table_name == 'favourites' && $notifi->table_data == 'Deal')
                $data['url'] = route('get-one-time-fav');
            elseif ($notifi->table_name == 'inquiries' && $notifi->table_data == 'Lead')
                $data['url'] = route('product-inquiries');
            elseif ($notifi->table_name == 'inquiries' && $notifi->table_data == 'Deal')
                $data['url'] = route('buysell-inquiries');
            elseif ($notifi->table_name == 'meetings' && $notifi->table_data == 'schedule')
                $data['url'] = route('company-get-meetings');
            elseif ($notifi->table_name == 'chats' && $notifi->table_data == 'message')
                $data['url'] = route('company-group-chat');
            $data['feedback'] = 'true';
        } else {
            $data['feedback'] = 'false';
        }

        return response()->json(['url'=> $data['url'],'feedback'=>true]);
    }




/////////////////////////////////////////////////////////////
///////////////////Added by taha////////////////////////////
////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////
////////////////Lead Favorites////////////////////////
//////////////////////////////////////////////////////

////////////////////Lead Inquiry////////////////////
    public function get_lead_fav(Request $request)
    {
        if(auth()->user()){
        $data['active'] = 'Inquiries';
        $data['title'] = 'MyBiz Active Inquiries';
        $data['user'] = \App\User::find(\auth()->id());
        // dd(\Auth::user()->company_profiles);
        $data['order'] = 'desc';
        $data['sent_messages'] =  \App\BizLeadFavConversation::with('product.company','messages','latestMessage','my_latest_message')->has('my_latest_message')->get();

        $data['deleted_messages'] =  \App\BizLeadFavConversation::with('product.company','messages','latestMessage','my_latest_message')->has('my_latest_message')->whereHas('delete_convos', function($q){
            $q->where('created_by',\Auth::id());
        })->get();
        // dd($data['sent_messages']);
        $data['listing'] = \App\BizLeadFavConversation::with('product.company','messages','latestMessage','my_latest_message')->where(function($q1){
            $q1->whereHas('product', function($query){
                $query->whereHas('company', function($q){
                    $q->where('company_profiles.id', \Session::get('company_id'));
                });
            })->orWhere('created_by',\Auth::id());
        })->get()->sortByDesc('latestMessage.created_at');
        // dd($data['listing']);
        // $data['request'] = $request;
        // dd($data);
        $data['page'] = 'biz_lead_fav.listing';

        return view('front_site.' . $data['page'])->with($data);
        }else{
            return view('front_site.other.login');
        }

    }

    public function get_lead_fav_messages_inbox(){
        if(request('conversation_id'))
        {
            $d['convo'] = \App\BizLeadFavConversation::with('other_user_messages')->with(['messages' => function($q){
                $q->orderBy('created_at','desc');
            }])->find(request('conversation_id'));
            // dd($d['convo']);
            if($d['convo'])
            {
                $data['data'] = view('front_site.biz_lead_fav.inbox-chat' , $d)->render();
                $data['feedback'] = 'true';
                // \App\BizLeadFavConversationMessage::where([['conversation_id',request('conversation_id')], ['created_by','<>',\Auth::id()]])->update(['is_read'=> 1]);
                if(\App\BizLeadFavConvoRead::whereIn('message_id', array_unique(\Arr::pluck($d['convo']->other_user_messages, 'id')))->where('conversation_id', request('conversation_id'))->where('created_by',\Auth::id())->count() > 0){
                    \App\BizLeadFavConvoRead::whereIn('message_id', array_unique(\Arr::pluck($d['convo']->other_user_messages, 'id')))->where('conversation_id', request('conversation_id'))->where('created_by',\Auth::id())->delete();
                }
                foreach (array_unique(\Arr::pluck($d['convo']->other_user_messages, 'id')) as $key => $value) {
                    $read = new \App\BizLeadFavConvoRead();
                    $read->conversation_id = request('conversation_id');
                    $read->message_id = $value;
                    $read->created_by = \Auth::id();
                    $read->save();
                }
                DB::table('notifications')
                    ->where('user_id', auth()->id())
                    ->where('prod_comp_id',\session()->get('company_id'))
                    ->where('table_name','favourites')
                    ->where('table_data','Lead')
                    ->update(['is_display' => 1,'is_read'=>1]);
            }
            else
            {
                $data['feedback'] = 'false';
                $data['msg'] = 'Something went Wrong';
            }
        }
        else
        {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }
        return json_encode($data);
    }

    public function get_lead_fav_messages(){
        if(request('conversation_id'))
        {
            $d['convo'] = \App\BizLeadFavConversation::with('other_user_messages')->with(['messages' => function($q){
                $q->orderBy('created_at','desc');
            }])->find(request('conversation_id'));
            // dd($d['convo']);
            if($d['convo'])
            {
                $data['data'] = view('front_site.biz_lead_fav.chat' , $d)->render();
                $data['feedback'] = 'true';
                // \App\BizLeadFavConversationMessage::where([['conversation_id',request('conversation_id')], ['created_by','<>',\Auth::id()]])->update(['is_read'=> 1]);
                if(\App\BizLeadFavConvoRead::whereIn('message_id', array_unique(\Arr::pluck($d['convo']->other_user_messages, 'id')))->where('conversation_id', request('conversation_id'))->where('created_by',\Auth::id())->count() > 0){
                    \App\BizLeadFavConvoRead::whereIn('message_id', array_unique(\Arr::pluck($d['convo']->other_user_messages, 'id')))->where('conversation_id', request('conversation_id'))->where('created_by',\Auth::id())->delete();
                }
                foreach (array_unique(\Arr::pluck($d['convo']->other_user_messages, 'id')) as $key => $value) {
                    $read = new \App\BizLeadFavConvoRead();
                    $read->conversation_id = request('conversation_id');
                    $read->message_id = $value;
                    $read->created_by = \Auth::id();
                    $read->save();
                }
                DB::table('notifications')
                    ->where('user_id', auth()->id())
                    ->where('prod_comp_id',\session()->get('company_id'))
                    ->where('table_name','favourites')
                    ->where('table_data','Lead')
                    ->update(['is_display' => 1,'is_read'=>1]);
            }
            else
            {
                $data['feedback'] = 'false';
                $data['msg'] = 'Something went Wrong';
            }
        }
        else
        {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }
        return json_encode($data);
    }

    public function reply_lead_fav_convo(){
        // dd(request()->all());
        try {
            $conversation_id = decrypt(request('conversation_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        $rule=[
            'message' => 'required',
            'created_by' => 'required',
        ];
        $validator = \Validator::make(request()->all(), $rule);
        if($validator->fails()){
            $data['errors'] = $validator->errors()->getMessages();
            $data['feedback'] = "false";
            return json_encode($data);
        }
        $messages = \App\BizLeadFavConversationMessages::where([['conversation_id',$conversation_id], ['created_by','<>',request('created_by')]])->where('created_by', '<>', \Auth::id())->get();
        // dd(array_unique(\Arr::pluck($messages, 'id')));

        if(\App\BizLeadFavConvoRead::whereIn('message_id', array_unique(\Arr::pluck($messages, 'id')))->where('conversation_id', $conversation_id)->where('created_by',\Auth::id())->count() > 0){
            \App\BizLeadFavConvoRead::whereIn('message_id', array_unique(\Arr::pluck($messages, 'id')))->where('conversation_id', $conversation_id)->where('created_by',\Auth::id())->delete();
        }
        foreach (array_unique(\Arr::pluck($messages, 'id')) as $key => $value) {
            $read = new \App\BizLeadFavConvoRead();
            $read->conversation_id = $conversation_id;
            $read->message_id = $value;
            $read->created_by = \Auth::id();
            $read->save();
        }


        $message = new \App\BizLeadFavConversationMessages();
        $message->conversation_id = $conversation_id;
        $message->message = request('message');
        $message->created_by = request('created_by');
        if(request()->file('file')){

            $file = inquiry_file_uploader(request()->file('file'), $message, 'biz_lead_inquiry');
            $message->file_path = $file;
        }
        if($message->save()){

//added by dilawar
            $prod = \App\Product::where('id',$message->convertsation->product_id)->first();
            $usercompany = \App\UserCompany::where('company_id',$prod->company_id)->get();
            foreach ($usercompany as $key => $produsercompany) {
                $notification = new Notification();
                if (request('created_by') == $produsercompany->user_id) {
                    if( $key == 0 ) {
                        $notification->user_id = $message->convertsation->created_by;
                        $notification->table_name = 'favourites';
                        $notification->table_data = 'Lead';
                        $notification->notification_text = $prod->product_service_name . ' Lead favourite Chat by ' . auth()->user()->name;
                        $notification->prod_id = $message->convertsation->product_id;
                        $notification->product_service_types = $prod->product_service_types;
                        $notification->product_service_name = $prod->product_service_name;
                        $notification->prod_comp_id = $produsercompany->company_id;
                        $notification->save();
                    }
                } elseif ($message->convertsation->created_by == auth()->id()) {
                    $notification->user_id = $produsercompany->user_id;
                    $notification->table_name = 'favourites';
                    $notification->table_data = 'Lead';
                    $notification->notification_text = $prod->product_service_name . ' Lead favourite Chat by ' . auth()->user()->name;
                    $notification->prod_id = $message->convertsation->product_id;
                    $notification->product_service_types = $prod->product_service_types;
                    $notification->product_service_name = $prod->product_service_name;
                    $notification->prod_comp_id = $produsercompany->company_id;
                    $notification->save();
                }
            }
            //added by dilawar

            if(\App\BizLeadFavConvoDelete::where('conversation_id', $conversation_id)->where('created_by', \Auth::id())->first())
                \App\BizLeadFavConvoDelete::where('conversation_id', $conversation_id)->where('created_by', \Auth::id())->delete();
            $data['feedback'] = "true";
            $data['msg'] = "Message has been sent successfully";
            $product = $message->convertsation->product;
            $data['product_name'] = $product->product_service_name;
            $data['product_price'] = $product->suitable_currencies.' '.$product->target_price_from;
            $data['product_ref_no'] = $product->reference_no;
            $data['product_image'] = '';
            $data['sent_from'] = in_array($message->convertsation->product->company->id,array_unique(\Arr::pluck(\Auth::user()->company_profiles,'id')))? $message->convertsation->product->company->company_name : get_name(\Auth::user());
            $data['sent_to'] = \Auth::id() == $message->convertsation->created_by ? $message->convertsation->product->company->company_name : get_name($message->convertsation->created_by_user);

            $data['message_created_at']= $message->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a');
            if($message->file_path)
                $data['message_file_path'] = "<a href=".url($message->file_path)." download='download'>
        <span class='d-inline fa fa-paperclip attached-icon'></span>
        </a>";
            else
                $data['message_file_path'] = '';
        }
        else{
            $data['feedback'] = "false";
            $data['msg'] = "Something went wrong";
        }
        return json_encode($data);
    }

    public function delete_lead_fav_convo(){
        try {
            $conversation_id = decrypt(request('conversation_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_id) {
            $convo = \App\BizLeadFavConversation::find($conversation_id);
            if($convo){

                // $convo->delete();
                $delete_convo = new \App\BizLeadFavConvoDelete();
                $delete_convo->conversation_id = $convo->id;
                $delete_convo->created_by = \Auth::id();
                $delete_convo->save();
                // dd($convo);
                $data['feedback'] = 'true';
                $data['msg'] = 'Inquiry has been removed successfully';
            }
            else{
                $data['feedback'] = 'false';
                $data['msg'] = 'Conversation not found';
            }

        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function favorite_lead_fav_convo(){

        try {
            $conversation_id = decrypt(request('conversation_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_id) {
            $convo = \App\BizLeadFavConversation::find($conversation_id);
            if($convo){
                $is_favorite = \App\BizLeadFavConvoFav::where('created_by',\Auth::id())->where('conversation_id',$convo->id)->first();
                if($is_favorite){
                    $is_favorite->delete();
                    $data['msg'] = 'Inquiry has been removed from favorite successfully';
                }
                else{

                    $fav_convo = new \App\BizLeadFavConvoFav();
                    $fav_convo->conversation_id = $convo->id;
                    $fav_convo->created_by = \Auth::id();
                    $fav_convo->save();
                    $data['msg'] = 'Inquiry has been added to favorite successfully';
                }

                $data['feedback'] = 'true';

            }
            else{
                $data['feedback'] = 'false';
                $data['msg'] = 'Conversation not found';
            }

        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function favorite_lead_fav_convo_multiple(){

        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



            $exist = \App\BizLeadFavConvoFav::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
            if($exist > 0){
                \App\BizLeadFavConvoFav::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
            }
            foreach ($conversation_ids as $key => $value) {
                $fav_convo = new \App\BizLeadFavConvoFav();
                $fav_convo->conversation_id = $value;
                $fav_convo->created_by = \Auth::id();
                $fav_convo->save();
            }


            $data['feedback'] = 'true';
            $data['msg'] = 'Inquiry has been added to favorite successfully';



        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function un_favorite_lead_fav_convo_multiple(){
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



            $exist = \App\BizLeadFavConvoFav::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
            if($exist > 0){
                \App\BizLeadFavConvoFav::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
                $data['feedback'] = 'true';
                $data['msg'] = 'Inquiry has been removed favorite successfully';
            }
            else{
                $data['feedback'] = 'true';
                $data['msg'] = 'No favorite inquiry found';
            }
            // foreach ($conversation_ids as $key => $value) {
            //     $fav_convo = new \App\BizdealInquiryConvoFav();
            //     $fav_convo->conversation_id = $value;
            //     $fav_convo->created_by = \Auth::id();
            //     $fav_convo->save();
            // }






        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function pin_lead_fav_convo(){

        try {
            $conversation_id = decrypt(request('conversation_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_id) {
            $convo = \App\BizLeadFavConversation::find($conversation_id);
            if($convo){
                $is_favorite = \App\BizLeadFavConvoPin::where('created_by',\Auth::id())->where('conversation_id',$convo->id)->first();
                if($is_favorite){
                    $is_favorite->delete();
                    $data['msg'] = 'Inquiry has been removed from Pined inquires successfully';
                }
                else{

                    $fav_convo = new \App\BizLeadFavConvoPin();
                    $fav_convo->conversation_id = $convo->id;
                    $fav_convo->created_by = \Auth::id();
                    $fav_convo->save();
                    $data['msg'] = 'Inquiry has been added to Pined inquires successfully';
                }

                $data['feedback'] = 'true';

            }
            else{
                $data['feedback'] = 'false';
                $data['msg'] = 'Conversation not found';
            }

        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function pin_lead_fav_convo_multiple(){

        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



            $exist = \App\BizLeadFavConvoPin::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
            if($exist > 0){
                \App\BizLeadFavConvoPin::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
            }
            foreach ($conversation_ids as $key => $value) {
                $fav_convo = new \App\BizLeadFavConvoPin();
                $fav_convo->conversation_id = $value;
                $fav_convo->created_by = \Auth::id();
                $fav_convo->save();
            }


            $data['feedback'] = 'true';
            $data['msg'] = 'Inquiry has been added to Pined inquires successfully';



        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function un_pin_lead_fav_convo_multiple(){
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



            $exist = \App\BizLeadFavConvoPin::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
            if($exist > 0){
                \App\BizLeadFavConvoPin::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
                $data['feedback'] = 'true';
                $data['msg'] = 'Inquiry has been removed from Pined inquires successfully';
            }
            else{
                $data['feedback'] = 'true';
                $data['msg'] = 'No pined inquiry found';
            }
            // foreach ($conversation_ids as $key => $value) {
            //     $fav_convo = new \App\BizdealInquiryConvoFav();
            //     $fav_convo->conversation_id = $value;
            //     $fav_convo->created_by = \Auth::id();
            //     $fav_convo->save();
            // }






        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function read_lead_fav_convo_multiple(){
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



            $exist = \App\BizLeadFavConversationMessages::whereIn('conversation_id',$conversation_ids)->where('created_by','<>', \Auth::id())->doesntHave('my_read_messages')->get();
            if(count($exist) > 0){
                // \App\BizLeadFavConversationMessage::whereIn('conversation_id',$conversation_ids)->where('created_by','<>', \Auth::id())->where('is_read', 0)->update(['is_read'=>1]);

                foreach ($exist as $key => $value) {
                    $read = new \App\BizLeadFavConvoRead();
                    $read->conversation_id = $value->conversation_id;
                    $read->message_id = $value->id;
                    $read->created_by = \Auth::id();
                    $read->save();
                }

                $data['feedback'] = 'true';
                $data['msg'] = 'Inquiry has been marked as read successfully';
            }
            else{
                $data['feedback'] = 'true';
                $data['msg'] = 'No unread inquiry found';
            }
            // foreach ($conversation_ids as $key => $value) {
            //     $fav_convo = new \App\BizdealInquiryConvoFav();
            //     $fav_convo->conversation_id = $value;
            //     $fav_convo->created_by = \Auth::id();
            //     $fav_convo->save();
            // }






        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function unread_lead_fav_convo_multiple(){
        // dd(request()->all());
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



            $exist = \App\BizLeadFavConvoRead::whereIn('conversation_id',$conversation_ids)->where('created_by',\Auth::id())->count();
            if($exist > 0){
                // foreach ($exist as $key => $value) {
                //     $value->latestMessageNotMine->is_read = 0;
                //     $value->latestMessageNotMine->save();
                // }
                \App\BizLeadFavConvoRead::whereIn('conversation_id',$conversation_ids)->where('created_by',\Auth::id())->delete();
                $data['feedback'] = 'true';
                $data['msg'] = 'Inquiry has been marked as unread successfully';
            }
            else{
                $data['feedback'] = 'true';
                $data['msg'] = 'No read inquiry found';
            }
            // foreach ($conversation_ids as $key => $value) {
            //     $fav_convo = new \App\BizdealInquiryConvoFav();
            //     $fav_convo->conversation_id = $value;
            //     $fav_convo->created_by = \Auth::id();
            //     $fav_convo->save();
            // }






        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function delete_lead_fav_convo_multiple(){
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



            $exist = \App\BizLeadFavConvoDelete::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
            if($exist > 0){
                \App\BizLeadFavConvoDelete::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
            }
            foreach ($conversation_ids as $key => $value) {
                $fav_convo = new \App\BizLeadFavConvoDelete();
                $fav_convo->conversation_id = $value;
                $fav_convo->created_by = \Auth::id();
                $fav_convo->save();
            }


            $data['feedback'] = 'true';
            $data['msg'] = 'Inquiry has been deleted successfully';



        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function get_sent_box_refresh_fav_lead(){


        try {
            $user_id = decrypt(request('user_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if($user_id)
        {
            $d['user'] = \App\User::find($user_id);
            $d['listing'] = \App\BizLeadFavConversation::with('product.company','messages','latestMessage','my_latest_message')->has('my_latest_message')->get();
            if($d['user'] && $d['listing'])
            {
                $data['data'] = view('front_site.biz_lead_fav.sent-box' , $d)->render();
                $data['feedback'] = 'true';
            }
            else
            {
                $data['feedback'] = 'false';
                $data['msg'] = 'Something went Wrong';
            }
        }
        else
        {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }
        return json_encode($data);
    }

    public function get_inbox_refresh_fav_lead(){
        try {
            $user_id = decrypt(request('user_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if($user_id)
        {
            $d['user'] = \App\User::find($user_id);
            $d['listing'] = \App\BizLeadFavConversation::with('product.company','messages','latestMessage','my_latest_message')->where(function($q1) use($user_id){
                $q1->whereHas('product', function($query) use($user_id){
                    $query->whereHas('company', function($q) use($user_id){
                        $q->where('company_profiles.id', \Session::get('company_id'));
                    });
                })->orWhere('created_by',$user_id);
            })->get()->sortByDesc('latestMessage.created_at');
            if($d['user'] && $d['listing'])
            {
                $data['data'] = view('front_site.biz_lead_fav.inbox' , $d)->render();
                $data['feedback'] = 'true';
            }
            else
            {
                $data['feedback'] = 'false';
                $data['msg'] = 'Something went Wrong';
            }
        }
        else
        {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }
        return json_encode($data);
    }

    public function get_delete_refresh_fav_lead(){

        try {
            $user_id = decrypt(request('user_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if($user_id)
        {
            $d['user'] = \App\User::find($user_id);
            $d['listing'] = \App\BizLeadFavConversation::with('product.company','messages','latestMessage','my_latest_message')->whereHas('delete_convos', function($q){
                $q->where('created_by',\Auth::id());
            })->get();
            if($d['user'] && $d['listing'])
            {
                // dd($d['listing']);;
                $data['data'] = view('front_site.biz_lead_fav.delete-box' , $d)->render();
                $data['feedback'] = 'true';
            }
            else
            {
                $data['feedback'] = 'false';
                $data['msg'] = 'Something went Wrong';
            }
        }
        else
        {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }
        return json_encode($data);
    }

    public function get_filtered_inqueries_fav_lead(){
        $user_id = \Auth::id();
        if(request('from')){
            if(request('from') == 'inbox'){

                $d['listing'] = \App\BizLeadFavConversation::with('product.company','messages','latestMessage','my_latest_message')->where(function($q1) use($user_id){
                    $q1->whereHas('product', function($query) use($user_id){
                        $query->whereHas('company', function($q) use($user_id){
                            $q->where('company_profiles.id', \Session::get('company_id'));
                        });
                    })->orWhere('created_by',$user_id);
                });

                if(request('filter') == 'star'){
                    $d['listing'] = $d['listing']->whereHas('favorite_conversations', function($q) use($user_id){
                        $q->where('biz_lead_fav_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'un-star'){

                    $d['listing'] = $d['listing']->whereDoesntHave('favorite_conversations', function($q) use($user_id){
                        $q->where('biz_lead_fav_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'read'){
                    $d['listing'] = $d['listing']->whereHas('latestMessageNotMine', function($q) {
                        $q->has('my_read_messages');
                    });
                }
                if(request('filter') == 'un-read'){
                    $d['listing'] = $d['listing']->wherehas('latestMessageNotMine', function($q) {
                        $q->doesntHave('my_read_messages');
                    });
                }
                if(request('filter') == 'pin'){
                    $d['listing'] = $d['listing']->whereHas('pin_conversations', function($q) use($user_id){
                        $q->where('biz_lead_fav_convo_pins.created_by', $user_id);
                    });
                }


                $d['listing'] = $d['listing']->get()->sortByDesc('latestMessage.created_at');
                // dd($d['listing']);
                $data['data'] = view('front_site.biz_lead_fav.inbox' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'inboxMail';



            }elseif(request('from') == 'sent'){

                $d['listing'] = \App\BizLeadFavConversation::with('product.company','messages','latestMessage','my_latest_message')->has('my_latest_message');

                if(request('filter') == 'star'){
                    $d['listing'] = $d['listing']->whereHas('favorite_conversations', function($q) use($user_id){
                        $q->where('biz_lead_fav_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'un-star'){

                    $d['listing'] = $d['listing']->whereDoesntHave('favorite_conversations', function($q) use($user_id){
                        $q->where('biz_lead_fav_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'read'){
                    $d['listing'] = $d['listing']->whereHas('latestMessageNotMine', function($q) {
                        $q->has('my_read_messages');
                    });
                }
                if(request('filter') == 'un-read'){
                    $d['listing'] = $d['listing']->wherehas('latestMessageNotMine', function($q) {
                        $q->doesntHave('my_read_messages');
                    });
                }
                if(request('filter') == 'pin'){
                    $d['listing'] = $d['listing']->whereHas('pin_conversations', function($q) use($user_id){
                        $q->where('biz_lead_fav_convo_pins.created_by', $user_id);
                    });
                }

                $d['listing'] = $d['listing']->get();
                $data['data'] = view('front_site.biz_lead_fav.sent-box' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'sentMail';

            }elseif(request('from') == 'delete'){

                $d['listing'] = \App\BizLeadFavConversation::with('product.company','messages','latestMessage','my_latest_message')->has('my_latest_message')->whereHas('delete_convos', function($q){
                    $q->where('created_by',\Auth::id());
                });

                if(request('filter') == 'star'){
                    $d['listing'] = $d['listing']->whereHas('favorite_conversations', function($q) use($user_id){
                        $q->where('biz_lead_fav_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'un-star'){

                    $d['listing'] = $d['listing']->whereDoesntHave('favorite_conversations', function($q) use($user_id){
                        $q->where('biz_lead_fav_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'read'){
                    $d['listing'] = $d['listing']->whereHas('latestMessageNotMine', function($q) {
                        $q->has('my_read_messages');
                    });
                }
                if(request('filter') == 'un-read'){
                    $d['listing'] = $d['listing']->wherehas('latestMessageNotMine', function($q) {
                        $q->doesntHave('my_read_messages');
                    });
                }
                if(request('filter') == 'pin'){
                    $d['listing'] = $d['listing']->whereHas('pin_conversations', function($q) use($user_id){
                        $q->where('biz_lead_fav_convo_pins.created_by', $user_id);
                    });
                }

                $d['listing'] = $d['listing']->get();
                $data['data'] = view('front_site.biz_lead_fav.delete-box' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'trashMail';
            }
        }
        else{
            $data['feedback'] = 'false';
            $data['msg'] = 'Request from is not found';
        }

        return json_encode($data);
    }

    public function filter_lead_onetime_inquiry_fav(){
        // dd(request()->all());
        $user_id = \Auth::id();
        if(request('from')){
            if(request('from') == 'inbox'){
                $d['listing'] = \App\BizLeadFavConversation::where(function($q1) use($user_id){
                    $q1->whereHas('product', function($query) use($user_id){
                        $query->whereHas('company', function($q) use($user_id){
                            $q->where('company_profiles.id', \Session::get('company_id'));
                        });
                    })->orWhere('created_by',$user_id);
                });
                if(request('datePicker')){
                    $d['listing'] = $d['listing']->whereHas('latestMessage', function($q){
                        $q->where(\DB::raw("STR_TO_DATE(biz_lead_fav_conversation_messages.created_at,'%Y-%m-%d')"),'=', request('datePicker'));
                    })->with(['latestMessage' => function($q){
                        $q->where(\DB::raw("STR_TO_DATE(biz_lead_fav_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
                    }]);

                }
                else{
                    $d['listing'] = $d['listing']->with('latestMessage');
                }
                if(request('ref_no')){
                    $d['listing'] = $d['listing']->whereHas('product', function($query) use($user_id){
                        $query->where('reference_no', request('ref_no'));
                    });
                }
                $d['listing'] = $d['listing']->get()->sortByDesc('latestMessage.created_at');
                // dd($d['listing']);
                $data['data'] = view('front_site.biz_lead_fav.inbox' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'inboxMail';
            }
            elseif(request('from') == 'sent-box'){
                $d['listing'] = \App\BizLeadFavConversation::has('my_latest_message');

                if(request('datePicker')){
                    $d['listing'] = $d['listing']->whereHas('my_latest_message', function($q){
                        $q->where(\DB::raw("STR_TO_DATE(biz_lead_fav_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
                    })->with(['my_latest_message' => function($q){
                        $q->where(\DB::raw("STR_TO_DATE(biz_lead_fav_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
                    }]);

                }
                else{
                    $d['listing'] = $d['listing']->with('my_latest_message');
                }
                if(request('ref_no')){
                    $d['listing'] = $d['listing']->whereHas('product', function($query) use($user_id){
                        $query->where('reference_no', request('ref_no'));
                    });
                }
                $d['listing'] = $d['listing']->get();
                //  dd($d['listing']);
                $data['data'] = view('front_site.biz_lead_fav.sent-box' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'sentMail';
            }
            elseif(request('from') == 'delete-box'){
                $d['listing'] = \App\BizLeadFavConversation::with('product.company','messages','latestMessage','my_latest_message')->has('my_latest_message')->whereHas('delete_convos', function($q){
                    $q->where('created_by',\Auth::id());
                });

                if(request('datePicker')){
                    $d['listing'] = $d['listing']->whereHas('my_latest_message', function($q){
                        $q->where(\DB::raw("STR_TO_DATE(biz_lead_fav_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
                    })->with(['my_latest_message' => function($q){
                        $q->where(\DB::raw("STR_TO_DATE(biz_lead_fav_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
                    }]);

                }
                else{
                    $d['listing'] = $d['listing']->with('my_latest_message');
                }
                if(request('ref_no')){
                    $d['listing'] = $d['listing']->whereHas('product', function($query) use($user_id){
                        $query->where('reference_no', request('ref_no'));
                    });
                }

                $d['listing'] = $d['listing']->get();
                $data['data'] = view('front_site.biz_lead_fav.delete-box' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'trashMail';

            }
        }else{
            $data['feedback'] = 'false';
            $data['msg'] = 'Request from is not found';
        }
        return json_encode($data);
    }

//////////////////////////////////////////////////////
////////////////Deal Favorites////////////////////////
//////////////////////////////////////////////////////

    public function get_one_time_fav()
    {
        // dd(\Auth::user());
        if(auth()->user()) {
            $data['active'] = 'biz_deal_favs';
            $data['title'] = 'One-Time Favorites';
            $data['user'] = \Auth::user();
            $data['order'] = 'desc';

            $data['sent_messages'] = \App\BizDealFavConversation::with('product.user', 'messages', 'latestMessage', 'my_latest_message')->has('my_latest_message')->get();

            $data['deleted_messages'] = \App\BizDealFavConversation::with('product.user', 'messages', 'latestMessage', 'my_latest_message')->has('my_latest_message')->whereHas('delete_convos', function ($q) {
                $q->where('created_by', \Auth::id());
            })->get();
            // dd($data['sent_messages']);
            $data['listing'] = \App\BizDealFavConversation::with('product.user', 'messages', 'latestMessage', 'my_latest_message')->where(function ($q1) {
                $q1->whereHas('product', function ($query) {
                    $query->whereHas('user', function ($q) {
                        $q->where('users.id', \Auth::id());
                    });
                })->orWhere('created_by', \Auth::id());
            })->get()->sortByDesc('latestMessage.created_at');
            // dd($data['listing']);
            // $data['request'] = $request;
            // dd($data);
            $data['page'] = 'biz_deal_fav.listing';

            // DB::table('notifications')
            //     ->where('user_id', auth()->id())
            //     ->where('table_name','inquiries')
            //     ->where('table_data','Deal')
            //     ->update(['is_display' => 1,'is_read'=>1]);

            return view('front_site.' . $data['page'])->with($data);
        }else{
            return view('front_site.other.login');
        }
    }

    public function get_inbox_refresh_fav(){
        try {
            $user_id = decrypt(request('user_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if($user_id)
        {
            $d['user'] = \App\User::find($user_id);
            $d['listing'] = \App\BizDealFavConversation::with('product.user','messages','latestMessage','my_latest_message')->where(function($q1) use($user_id){
                $q1->whereHas('product', function($query) use($user_id){
                    $query->whereHas('user', function($q) use($user_id){
                        $q->where('users.id', $user_id);
                    });
                })->orWhere('created_by',$user_id);
            })->get()->sortByDesc('latestMessage.created_at');
            if($d['user'] && $d['listing'])
            {
                $data['data'] = view('front_site.biz_deal_fav.inbox' , $d)->render();
                $data['feedback'] = 'true';
            }
            else
            {
                $data['feedback'] = 'false';
                $data['msg'] = 'Something went Wrong';
            }
        }
        else
        {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }
        return json_encode($data);
    }

    public function get_sent_box_refresh_fav(){


        try {
            $user_id = decrypt(request('user_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if($user_id)
        {
            $d['user'] = \App\User::find($user_id);
            $d['listing'] = \App\BizDealFavConversation::with('product.user','messages','latestMessage','my_latest_message')->has('my_latest_message')->get();
            if($d['user'] && $d['listing'])
            {
                $data['data'] = view('front_site.biz_deal_fav.sent-box' , $d)->render();
                $data['feedback'] = 'true';
            }
            else
            {
                $data['feedback'] = 'false';
                $data['msg'] = 'Something went Wrong';
            }
        }
        else
        {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }
        return json_encode($data);
    }

    public function get_delete_refresh_fav(){

        try {
            $user_id = decrypt(request('user_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if($user_id)
        {
            $d['user'] = \App\User::find($user_id);
            $d['listing'] = \App\BizDealFavConversation::with('product.user','messages','latestMessage','my_latest_message')->whereHas('delete_convos', function($q){
                $q->where('created_by',\Auth::id());
            })->get();
            if($d['user'] && $d['listing'])
            {
                $data['data'] = view('front_site.biz_deal_fav.delete-box' , $d)->render();
                $data['feedback'] = 'true';
            }
            else
            {
                $data['feedback'] = 'false';
                $data['msg'] = 'Something went Wrong';
            }
        }
        else
        {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }
        return json_encode($data);
    }

    public function get_bizdeal_fav_messages_inbox(){
        if(request('conversation_id'))
        {
            $d['convo'] = \App\BizDealFavConversation::with(['messages' => function($q){
                $q->orderBy('created_at','desc');
            }])->find(request('conversation_id'));
            // dd($d['convo']);
            if($d['convo'])
            {
                $data['data'] = view('front_site.biz_deal_fav.inbox-chat' , $d)->render();
                $data['feedback'] = 'true';
                \App\BizDealFavConversationMessage::where([['conversation_id',request('conversation_id')], ['created_by','<>',\Auth::id()]])->update(['is_read'=> 1]);
                DB::table('notifications')
                    ->where('user_id', auth()->id())
                    ->where('table_name','favourites')
                    ->where('table_data','Deal')
                    ->update(['is_display' => 1,'is_read'=>1]);
            }
            else
            {
                $data['feedback'] = 'false';
                $data['msg'] = 'Something went Wrong';
            }
        }
        else
        {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }
        return json_encode($data);
    }

    public function get_bizdeal_fav_messages(){
        if(request('conversation_id'))
        {
            $d['convo'] = \App\BizDealFavConversation::with(['messages' => function($q){
                $q->orderBy('created_at','desc');
            }])->find(request('conversation_id'));
            // dd($d['convo']);
            if($d['convo'])
            {
                $data['data'] = view('front_site.biz_deal_fav.chat' , $d)->render();
                $data['feedback'] = 'true';
                \App\BizDealFavConversationMessage::where([['conversation_id',request('conversation_id')], ['created_by','<>',\Auth::id()]])->update(['is_read'=> 1]);
                DB::table('notifications')
                    ->where('user_id', auth()->id())
                    ->where('table_name','favourites')
                    ->where('table_data','Deal')
                    ->update(['is_display' => 1,'is_read'=>1]);
            }
            else
            {
                $data['feedback'] = 'false';
                $data['msg'] = 'Something went Wrong';
            }
        }
        else
        {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }
        return json_encode($data);
    }

    public function reply_bizdeal_fav_convo(){
        // dd(request()->all());
        try {
            $conversation_id = decrypt(request('conversation_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        $rule=[
            'message' => 'required',
            'created_by' => 'required',
        ];
        $validator = \Validator::make(request()->all(), $rule);
        if($validator->fails()){
            $data['errors'] = $validator->errors()->getMessages();
            $data['feedback'] = "false";
            return json_encode($data);
        }
        \App\BizDealFavConversationMessage::where([['conversation_id',$conversation_id], ['created_by','<>',request('created_by')]])->update(['is_read'=> 1]);
        $message = new \App\BizDealFavConversationMessage();
        $message->conversation_id = $conversation_id;
        $message->message = request('message');
        $message->created_by = request('created_by');
        if(request()->file('file')){

            $file = inquiry_file_uploader(request()->file('file'), $message, 'biz_deal_fav');
            $message->file_path = $file;
        }
        if($message->save()){


            //added by dilawar
            $buysell = \App\BuySell::where('id',$message->convertsation->buy_sell_id)->first();
            $notification = new Notification();
            if(request('created_by') == $buysell->user_id){
                $notification->user_id= $message->convertsation->created_by;
            }elseif($message->convertsation->created_by == auth()->id()){
                $notification->user_id= $buysell->user_id;
            }
            $notification->table_name = 'favourites';
            $notification->table_data= 'Deal';
            $notification->notification_text= $buysell->product_service_name.' Deal favourite Chat by '.auth()->user()->name;
            $notification->prod_id= $message->convertsation->buy_sell_id;
            $notification->product_service_types= $buysell->product_service_types;
            $notification->product_service_name= $buysell->product_service_name;
            $notification->prod_user_id= $buysell->user_id;
            $notification->save();
            //added by dilawar
            if(\App\BizDealFavConvoDelete::where('conversation_id', $conversation_id)->where('created_by', \Auth::id())->first())
                \App\BizDealFavConvoDelete::where('conversation_id', $conversation_id)->where('created_by', \Auth::id())->delete();
            $data['feedback'] = "true";
            $data['msg'] = "Message has been sent successfully";
            $product = $message->convertsation->product;
            $data['product_name'] = $product->product_service_name;
            $data['product_price'] = $product->suitable_currencies.' '.$product->target_price_from;
            $data['product_ref_no'] = $product->reference_no;
            $data['product_image'] = '';
            $data['sent_to'] = \Auth::id() == $message->convertsation->created_by ? get_name($message->convertsation->product->user) : get_name($message->convertsation->created_by_user);
            $data['message_created_at']= $message->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a');
            if($message->file_path)
                $data['message_file_path'] = "<a href=".url($message->file_path)." download='download'>
            <span class='d-inline fa fa-paperclip attached-icon'></span>
            </a>";
            else
                $data['message_file_path'] = '';
        }
        else{
            $data['feedback'] = "false";
            $data['msg'] = "Something went wrong";
        }
        return json_encode($data);
    }

    public function delete_bizdeal_fav_convo(){
        try {
            $conversation_id = decrypt(request('conversation_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_id) {
            $convo = \App\BizDealFavConversation::find($conversation_id);
            if($convo){
                // $convo->delete();
                $delete_convo = new \App\BizDealFavConvoDelete();
                $delete_convo->conversation_id = $convo->id;
                $delete_convo->created_by = \Auth::id();
                $delete_convo->save();
                $data['feedback'] = 'true';
                $data['msg'] = 'Inquiry has been removed successfully';
            }
            else{
                $data['feedback'] = 'false';
                $data['msg'] = 'Conversation not found';
            }

        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function favorite_bizdeal_fav_convo(){

        try {
            $conversation_id = decrypt(request('conversation_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_id) {
            $convo = \App\BizDealFavConversation::find($conversation_id);
            if($convo){
                $is_favorite = \App\BizDealFavConvoFav::where('created_by',\Auth::id())->where('conversation_id',$convo->id)->first();
                if($is_favorite){
                    $is_favorite->delete();
                    $data['msg'] = 'Inquiry has been removed from favorite successfully';
                }
                else{

                    $fav_convo = new \App\BizDealFavConvoFav();
                    $fav_convo->conversation_id = $convo->id;
                    $fav_convo->created_by = \Auth::id();
                    $fav_convo->save();
                    $data['msg'] = 'Inquiry has been added to favorite successfully';
                }

                $data['feedback'] = 'true';

            }
            else{
                $data['feedback'] = 'false';
                $data['msg'] = 'Conversation not found';
            }

        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function favorite_bizdeal_fav_convo_multiple(){

        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



            $exist = \App\BizDealFavConvoFav::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
            if($exist > 0){
                \App\BizDealFavConvoFav::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
            }
            foreach ($conversation_ids as $key => $value) {
                $fav_convo = new \App\BizDealFavConvoFav();
                $fav_convo->conversation_id = $value;
                $fav_convo->created_by = \Auth::id();
                $fav_convo->save();
            }


            $data['feedback'] = 'true';
            $data['msg'] = 'Inquiry has been added to favorite successfully';



        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function un_favorite_bizdeal_fav_convo_multiple(){
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



            $exist = \App\BizDealFavConvoFav::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
            if($exist > 0){
                \App\BizDealFavConvoFav::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
                $data['feedback'] = 'true';
                $data['msg'] = 'Inquiry has been removed favorite successfully';
            }
            else{
                $data['feedback'] = 'true';
                $data['msg'] = 'No favorite inquiry found';
            }
            // foreach ($conversation_ids as $key => $value) {
            //     $fav_convo = new \App\BizdealInquiryConvoFav();
            //     $fav_convo->conversation_id = $value;
            //     $fav_convo->created_by = \Auth::id();
            //     $fav_convo->save();
            // }






        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function pin_bizdeal_fav_convo(){

        try {
            $conversation_id = decrypt(request('conversation_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_id) {
            $convo = \App\BizDealFavConversation::find($conversation_id);
            //        dd($convo);
            if($convo){
                $is_favorite = \App\BizDealFavConvoPin::where('created_by',\Auth::id())->where('conversation_id',$convo->id)->first();
                if($is_favorite){
                    $is_favorite->delete();
                    $data['msg'] = 'Inquiry has been removed from Pined inquires successfully';
                }
                else{

                    $fav_convo = new \App\BizDealFavConvoPin();
                    $fav_convo->conversation_id = $convo->id;
                    $fav_convo->created_by = \Auth::id();
                    $fav_convo->save();
                    $data['msg'] = 'Inquiry has been added to Pined inquires successfully';
                }

                $data['feedback'] = 'true';

            }
            else{
                $data['feedback'] = 'false';
                $data['msg'] = 'Conversation not found';
            }

        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function pin_bizdeal_fav_convo_multiple(){

        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



            $exist = \App\BizDealFavConvoPin::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
            if($exist > 0){
                \App\BizDealFavConvoPin::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
            }
            foreach ($conversation_ids as $key => $value) {
                $fav_convo = new \App\BizDealFavConvoPin();
                $fav_convo->conversation_id = $value;
                $fav_convo->created_by = \Auth::id();
                $fav_convo->save();
            }


            $data['feedback'] = 'true';
            $data['msg'] = 'Inquiry has been added to Pined inquires successfully';



        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function un_pin_bizdeal_fav_convo_multiple(){
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



            $exist = \App\BizDealFavConvoPin::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
            if($exist > 0){
                \App\BizDealFavConvoPin::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
                $data['feedback'] = 'true';
                $data['msg'] = 'Inquiry has been removed from Pined inquires successfully';
            }
            else{
                $data['feedback'] = 'true';
                $data['msg'] = 'No pined inquiry found';
            }
            // foreach ($conversation_ids as $key => $value) {
            //     $fav_convo = new \App\BizdealInquiryConvoFav();
            //     $fav_convo->conversation_id = $value;
            //     $fav_convo->created_by = \Auth::id();
            //     $fav_convo->save();
            // }






        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function read_bizdeal_fav_convo_multiple(){
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



            $exist = \App\BizDealFavConversationMessage::whereIn('conversation_id',$conversation_ids)->where('created_by','<>', \Auth::id())->where('is_read', 1)->count();
            if($exist > 0){
                \App\BizDealFavConversationMessage::whereIn('conversation_id',$conversation_ids)->where('created_by','<>', \Auth::id())->where('is_read', 0)->update(['is_read'=>1]);
                $data['feedback'] = 'true';
                $data['msg'] = 'Inquiry has been marked as read successfully';
            }
            else{
                $data['feedback'] = 'true';
                $data['msg'] = 'No unread inquiry found';
            }
            // foreach ($conversation_ids as $key => $value) {
            //     $fav_convo = new \App\BizdealInquiryConvoFav();
            //     $fav_convo->conversation_id = $value;
            //     $fav_convo->created_by = \Auth::id();
            //     $fav_convo->save();
            // }






        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function unread_bizdeal_fav_convo_multiple(){
        // dd(request()->all());
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



            $exist = \App\BizDealFavConversation::whereIn('id',$conversation_ids)->with('latestMessageNotMine')->has('latestMessageNotMine')->get();
            if(count($exist) > 0){
                foreach ($exist as $key => $value) {
                    $value->latestMessageNotMine->is_read = 0;
                    $value->latestMessageNotMine->save();
                }
                $data['feedback'] = 'true';
                $data['msg'] = 'Inquiry has been marked as unread successfully';
            }
            else{
                $data['feedback'] = 'true';
                $data['msg'] = 'No read inquiry found';
            }
            // foreach ($conversation_ids as $key => $value) {
            //     $fav_convo = new \App\BizdealInquiryConvoFav();
            //     $fav_convo->conversation_id = $value;
            //     $fav_convo->created_by = \Auth::id();
            //     $fav_convo->save();
            // }






        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function delete_bizdeal_fav_convo_multiple(){
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



            $exist = \App\BizDealFavConvoDelete::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
            if($exist > 0){
                \App\BizDealFavConvoDelete::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
            }
            foreach ($conversation_ids as $key => $value) {
                $fav_convo = new \App\BizDealFavConvoDelete();
                $fav_convo->conversation_id = $value;
                $fav_convo->created_by = \Auth::id();
                $fav_convo->save();
            }


            $data['feedback'] = 'true';
            $data['msg'] = 'Inquiry has been deleted successfully';



        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function get_filtered_inqueries_fav(){
        $user_id = \Auth::id();
        if(request('from')){
            if(request('from') == 'inbox'){

                $d['listing'] = \App\BizDealFavConversation::with('product.user','messages','latestMessage','my_latest_message')->where(function($q1) use($user_id){
                    $q1->whereHas('product', function($query) use($user_id){
                        $query->whereHas('user', function($q) use($user_id){
                            $q->where('users.id', $user_id);
                        });
                    })->orWhere('created_by',$user_id);
                });

                if(request('filter') == 'star'){
                    $d['listing'] = $d['listing']->whereHas('favorite_conversations', function($q) use($user_id){
                        $q->where('biz_deal_fav_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'un-star'){

                    $d['listing'] = $d['listing']->whereDoesntHave('favorite_conversations', function($q) use($user_id){
                        $q->where('biz_deal_fav_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'read'){
                    $d['listing'] = $d['listing']->whereHas('latestMessageNotMine', function($q) {
                        $q->where('biz_deal_fav_conversation_messages.is_read', 0);
                    });
                }
                if(request('filter') == 'un-read'){
                    $d['listing'] = $d['listing']->whereDoesntHave('latestMessageNotMine', function($q) {
                        $q->where('biz_deal_fav_conversation_messages.is_read', 0);
                    });
                }
                if(request('filter') == 'pin'){
                    $d['listing'] = $d['listing']->whereHas('pin_conversations', function($q) use($user_id){
                        $q->where('biz_deal_fav_convo_pins.created_by', $user_id);
                    });
                }


                $d['listing'] = $d['listing']->get()->sortByDesc('latestMessage.created_at');
                // dd($d['listing']);
                $data['data'] = view('front_site.biz_deal_fav.inbox' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'inboxMail';



            }elseif(request('from') == 'sent'){

                $d['listing'] = \App\BizDealFavConversation::with('product.user','messages','latestMessage','my_latest_message')->has('my_latest_message');

                if(request('filter') == 'star'){
                    $d['listing'] = $d['listing']->whereHas('favorite_conversations', function($q) use($user_id){
                        $q->where('biz_deal_fav_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'un-star'){

                    $d['listing'] = $d['listing']->whereDoesntHave('favorite_conversations', function($q) use($user_id){
                        $q->where('biz_deal_fav_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'read'){
                    $d['listing'] = $d['listing']->whereHas('latestMessageNotMine', function($q) {
                        $q->where('biz_deal_fav_conversation_messages.is_read', 0);
                    });
                }
                if(request('filter') == 'un-read'){
                    $d['listing'] = $d['listing']->whereDoesntHave('latestMessageNotMine', function($q) {
                        $q->where('biz_deal_fav_conversation_messages.is_read', 0);
                    });
                }
                if(request('filter') == 'pin'){
                    $d['listing'] = $d['listing']->whereHas('pin_conversations', function($q) use($user_id){
                        $q->where('biz_deal_fav_convo_pins.created_by', $user_id);
                    });
                }

                $d['listing'] = $d['listing']->get();
                $data['data'] = view('front_site.biz_deal_fav.sent-box' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'sentMail';

            }elseif(request('from') == 'delete'){

                $d['listing'] = \App\BizDealFavConversation::with('product.user','messages','latestMessage','my_latest_message')->has('my_latest_message')->whereHas('delete_convos', function($q){
                    $q->where('created_by',\Auth::id());
                });

                if(request('filter') == 'star'){
                    $d['listing'] = $d['listing']->whereHas('favorite_conversations', function($q) use($user_id){
                        $q->where('biz_deal_fav_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'un-star'){

                    $d['listing'] = $d['listing']->whereDoesntHave('favorite_conversations', function($q) use($user_id){
                        $q->where('biz_deal_fav_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'read'){
                    $d['listing'] = $d['listing']->whereHas('latestMessageNotMine', function($q) {
                        $q->where('biz_deal_fav_conversation_messages.is_read', 0);
                    });
                }
                if(request('filter') == 'un-read'){
                    $d['listing'] = $d['listing']->whereDoesntHave('latestMessageNotMine', function($q) {
                        $q->where('biz_deal_fav_conversation_messages.is_read', 0);
                    });
                }
                if(request('filter') == 'pin'){
                    $d['listing'] = $d['listing']->whereHas('pin_conversations', function($q) use($user_id){
                        $q->where('biz_deal_fav_convo_pins.created_by', $user_id);
                    });
                }

                $d['listing'] = $d['listing']->get();
                $data['data'] = view('front_site.biz_deal_fav.delete-box' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'trashMail';
            }
        }
        else{
            $data['feedback'] = 'false';
            $data['msg'] = 'Request from is not found';
        }

        return json_encode($data);
    }

    public function filter_bizdeal_onetime_inquiry_fav(){
        // dd(request()->all());
        $user_id = \Auth::id();
        if(request('from')){
            if(request('from') == 'inbox'){
                $d['listing'] = \App\BizDealFavConversation::where(function($q1) use($user_id){
                    $q1->whereHas('product', function($query) use($user_id){
                        $query->whereHas('user', function($q) use($user_id){
                            $q->where('users.id', $user_id);
                        });
                    })->orWhere('created_by',$user_id);
                });
                if(request('datePicker')){
                    $d['listing'] = $d['listing']->whereHas('latestMessage', function($q){
                        $q->where(\DB::raw("STR_TO_DATE(biz_deal_fav_conversation_messages.created_at,'%Y-%m-%d')"),'=', request('datePicker'));
                    })->with(['latestMessage' => function($q){
                        $q->where(\DB::raw("STR_TO_DATE(biz_deal_fav_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
                    }]);

                }
                else{
                    $d['listing'] = $d['listing']->with('latestMessage');
                }
                if(request('ref_no')){
                    $d['listing'] = $d['listing']->whereHas('product', function($query) use($user_id){
                        $query->where('reference_no', request('ref_no'));
                    });
                }
                $d['listing'] = $d['listing']->get()->sortByDesc('latestMessage.created_at');
                // dd($d['listing']);
                $data['data'] = view('front_site.biz_deal_fav.inbox' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'inboxMail';
            }
            elseif(request('from') == 'sent-box'){
                $d['listing'] = \App\BizDealFavConversation::has('my_latest_message');

                if(request('datePicker')){
                    $d['listing'] = $d['listing']->whereHas('my_latest_message', function($q){
                        $q->where(\DB::raw("STR_TO_DATE(biz_deal_fav_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
                    })->with(['my_latest_message' => function($q){
                        $q->where(\DB::raw("STR_TO_DATE(biz_deal_fav_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
                    }]);

                }
                else{
                    $d['listing'] = $d['listing']->with('my_latest_message');
                }
                if(request('ref_no')){
                    $d['listing'] = $d['listing']->whereHas('product', function($query) use($user_id){
                        $query->where('reference_no', request('ref_no'));
                    });
                }
                $d['listing'] = $d['listing']->get();
                //  dd($d['listing']);
                $data['data'] = view('front_site.biz_deal_fav.sent-box' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'sentMail';
            }
            elseif(request('from') == 'delete-box'){
                $d['listing'] = \App\BizDealFavConversation::with('product.user','messages','latestMessage','my_latest_message')->has('my_latest_message')->whereHas('delete_convos', function($q){
                    $q->where('created_by',\Auth::id());
                });

                if(request('datePicker')){
                    $d['listing'] = $d['listing']->whereHas('my_latest_message', function($q){
                        $q->where(\DB::raw("STR_TO_DATE(biz_deal_fav_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
                    })->with(['my_latest_message' => function($q){
                        $q->where(\DB::raw("STR_TO_DATE(biz_deal_fav_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
                    }]);

                }
                else{
                    $d['listing'] = $d['listing']->with('my_latest_message');
                }
                if(request('ref_no')){
                    $d['listing'] = $d['listing']->whereHas('product', function($query) use($user_id){
                        $query->where('reference_no', request('ref_no'));
                    });
                }

                $d['listing'] = $d['listing']->get();
                $data['data'] = view('front_site.biz_deal_fav.delete-box' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'trashMail';

            }
        }else{
            $data['feedback'] = 'false';
            $data['msg'] = 'Request from is not found';
        }
        return json_encode($data);
    }

}

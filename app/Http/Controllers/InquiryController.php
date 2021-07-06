<?php

namespace App\Http\Controllers;

use App\Mail\sendInquiryEmail;
use App\Mail\sendInquiryQCISEmail;
use App\Inquiry;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $_inquiry;

    function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }


    /// backup function not in use ///////////////////////////////////
    public function buysell_index_old(Request $request)
    {
        if ($request->case && $request->case == 'archive') {

            $data['active'] = 'Inquiries';
            $data['title'] = 'One-Time Active Inquiries';
            $data['user'] = \App\User::find(\auth()->id());
            $data['order'] = 'desc';
            $buysell = \App\BuySell::where('user_id',auth()->id())->get()->pluck('id');
            $data['inquiries'] = \App\Inquiry::onlyTrashed()->whereIn('buysell_id',$buysell);
            $data['count'] = $data['inquiries']->count();
            $data['inquiries'] = $data['inquiries']->paginate();
            $data['request'] = $request;
            $data['page'] = 'inquiry.buysell-inquiries-list';

            return view('front_site.' . $data['page'])->with($data);
        }else{
            $data['active'] = 'Inquiries';
            $data['title'] = 'One-Time Active Inquiries';
            $data['user'] = \App\User::find(\auth()->id());
            $data['order'] = 'desc';
            $buysell = \App\BuySell::where('user_id',auth()->id())->get()->pluck('id');
            $data['inquiries'] = \App\Inquiry::whereIn('buysell_id',$buysell);
            $data['count'] = $data['inquiries']->count();
            $data['inquiries'] = $data['inquiries']->paginate();
            $data['request'] = $request;
            $data['page'] = 'inquiry.buysell-inquiries-list';

            return view('front_site.' . $data['page'])->with($data);
        }



    }
    /// backup function end  not in use ///////////////////////////////////


    public function archive_product_inquiries(Request $request)
    {

        try {
            $prod_inquiry_id = decrypt(request('prod_inquiry_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($prod_inquiry_id) {
            $prod_inquiry = \App\Inquiry::withTrashed()->find($prod_inquiry_id);
            if ($prod_inquiry) {
                if ($prod_inquiry->trashed()) {
                    $prod_inquiry->forceDelete();
                } else {
                    $prod_inquiry->delete();
                }
                $data['feedback'] = 'true';
                $data['msg'] = 'Inquiry has been archived successfully';
            } else {
                $data['feedback'] = 'false';
                $data['msg'] = 'Something went Wrong';
            }
        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }
        return json_encode($data);
    }

    public function restore_product_inquiries(Request $request)
    {
        try {
            $prod_inquiry_id = decrypt(request('prod_inquiry_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($prod_inquiry_id) {
            $prod_inquiry = \App\Inquiry::onlyTrashed()->find($prod_inquiry_id);
            if ($prod_inquiry) {
                $prod_inquiry->restore();
                $data['feedback'] = 'true';
                $data['msg'] = 'Inquiry has been restored successfully';
            } else {
                $data['feedback'] = 'false';
                $data['msg'] = 'Something went Wrong';
            }
        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }
        return json_encode($data);
    }

    public function create()
    {
       //
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = \Auth()->user();
        $inquiry = \App\Inquiry::where('id',$id)->first();
        return view('front_site.inquiry.inquiry-show', compact('inquiry','user'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Inquiry $inquiry)
    {
        if ($inquiry->delete()) {
            json_encode(['feedback' => 'success', 'msg' => 'Inquiry has been removed successfully',]);
        }
        return Redirect::back();
    }

    public function remove_inquiry_user()
    {
        try {
            $inquiry_id = decrypt(request('inquiry_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($inquiry_id) {

            DB::delete('delete from inquiries where id = ?', [$inquiry_id]);
            $data['feedback'] = 'true';
            $data['msg'] = 'Inquiry has been removed successfully';
        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function store(Request $request)
    {
        // dd(request()->all());

        //bizdeal inquiry message creation and email notification.
        if(request('prodType') == 'Deal'){
            $inq = new \App\BizdealInquiryConversation();
            $inq->buy_sell_id = request('buysellId');
            $inq->created_by = \Auth::id();
            if($inq->save()){
                $message = new \App\bizdealInqueryConversationMessage();
                $message->conversation_id = $inq->id;
                $output = "";
                $output .= nl2br(request('description'));
                $pref = "";
                if(request('sample_with_specification_sheet')){
                    $pref .= request('sample_with_specification_sheet').', ';
                }
                if(request('latest_price_quotation')){
                    $pref .= request('latest_price_quotation').', ';
                }
                if(request('compliance_certification_required')){
                    $pref .= request('compliance_certification_required').', ';
                }
                if(request('preferred_payment_terms')){
                    $pref .= request('preferred_payment_terms').', ';
                }
                if(request('production_capacity')){
                    $pref .= request('production_capacity').', ';
                }

                // dd($pref);
                if($pref){
                    $output .= "<br><br>";
                    $output .= "<table class='table table-striped' ><tbody>";
                    $output .= "<tr><td>Preference</td><td>".rtrim($pref, ', ')."</td></tr></tbody></table>";
                }

                $message->message = $output;
                if(request()->file('image')){
                    $file = inquiry_file_uploader(request()->file('image'), $message, 'biz_deal_inquiry');
                    $message->file_path = $file;
                }
                $message->created_by = \Auth::id();
                $message->save();

            }
        }
        else{
            $inq = new \App\BizLeadInquiryConversation();
            $inq->product_id = request('prodId');
            $inq->created_by = \Auth::id();
            if($inq->save()){
                $message = new \App\BizLeadInquiryConversationMessage();
                $message->conversation_id = $inq->id;
                $output = "";
                $output .= nl2br(request('description'));
                $pref = "";
                if(request('sample_with_specification_sheet')){
                    $pref .= request('sample_with_specification_sheet').', ';
                }
                if(request('latest_price_quotation')){
                    $pref .= request('latest_price_quotation').', ';
                }
                if(request('compliance_certification_required')){
                    $pref .= request('compliance_certification_required').', ';
                }
                if(request('preferred_payment_terms')){
                    $pref .= request('preferred_payment_terms').', ';
                }
                if(request('production_capacity')){
                    $pref .= request('production_capacity').', ';
                }

                // dd($pref);
                if($pref){
                    $output .= "<br><br>";
                    $output .= "<table class='table table-striped' ><tbody>";
                    $output .= "<tr><td>Preference</td><td>".rtrim($pref, ', ')."</td></tr></tbody></table>";
                }

                $message->message = $output;
                if(request()->file('image')){
                    $file = inquiry_file_uploader(request()->file('image'), $message, 'biz_lead_inquiry');
                    $message->file_path = $file;
                }
                $message->created_by = \Auth::id();
                $message->save();

            }
        }


        $data['inquiry'] = new \App\Inquiry();
        $data['inquiry']->user_id= request('userID');
        $data['inquiry']->product_id= request('prodId');
        $data['inquiry']->buysell_id= request('buysellId');
        $data['inquiry']->product_type= request('prodType');
        $data['inquiry']->product_service_types= request('serviceTypes');
        $data['inquiry']->reference_no= request('referenceNo');
        $data['inquiry']->contact_name= request('contactName');
        $data['inquiry']->company_name= request('companyName');
        $data['inquiry']->contact_no= request('contactNumber');
        $data['inquiry']->email= request('emailId');
        $data['inquiry']->country_name= request('country');
        $data['inquiry']->city= request('city');
        $data['inquiry']->description= request('description');
        $data['inquiry']->sample_with_specification_sheet= request('sample_with_specification_sheet');
        $data['inquiry']->latest_price_quotation= request('latest_price_quotation');
        $data['inquiry']->compliance_certification_required= request('compliance_certification_required');
        $data['inquiry']->preferred_payment_terms= request('preferred_payment_terms');
        $data['inquiry']->production_capacity= request('production_capacity');
        $data['inquiry']->qcis= request('qcis');
        $data['inquiry']->terms_condition= request('terms_condition');
        // if($request->hasFile('image')){
        //     $image = $request->file('image');
        //     $image_name = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
        //     $file = 'assets/front_site/inquiries/';
        //     // $image->move(public_path($file), $image_name);
        //     $path = $file . $image_name;
        //     $data['inquiry']->image = $path;
        // }

        $data['inquiry']->save();

        if(request('prodId'))
        {

            $product = \App\Product::where('id',request('prodId'))->where('reference_no',request('referenceNo'))->first();
            $cmpny = \App\CompanyProfile::where('id',$product->company_id)->first();
            $company = \App\UserCompany::where('company_id', $product->company_id)->get();
            $user = \App\User::where('id',$cmpny->user_id)->first();
            $name=$user->name;
            $email=$user->email;
            $phone=$user->registration_phone_no;
            $prod_name=$product->product_service_name;
            if(!empty(request('qcis'))){
                \Mail::to('info@bizonair.com')->send(new sendInquiryQCISEmail($data, $name, $prod_name,$email,$phone));
            }
            \Mail::to($user->email)->send(new sendInquiryEmail($data, $name, $prod_name));

            foreach ($company as $comp) {
                $notification = new Notification();
                $notification->user_id = $comp->user_id;
                $notification->table_name = 'inquiries';
                $notification->table_data = 'Lead';
                $notification->notification_text = $product->product_service_name . ' Lead inquiry added by ' . auth()->user()->name;
                $notification->prod_id = $product->id;
                $notification->product_service_types = $product->product_service_types;
                $notification->product_service_name = $product->product_service_name;
                $notification->prod_comp_id = $product->company_id;
                $notification->save();
            }

        }else{
            $buysell = \App\BuySell::where('id',request('buysellId'))->where('reference_no',request('referenceNo'))->first();
            $user = \App\User::find($buysell->user_id);
            $name=$user->name;
            $email=$user->email;
            $phone=$user->registration_phone_no;
            $prod_name=$buysell->product_service_name;
            if(!empty(request('qcis'))){
                \Mail::to('info@bizonair.com')->send(new sendInquiryQCISEmail($data, $name, $prod_name,$email,$phone));
            }
            \Mail::to($user->email)->send(new sendInquiryEmail($data, $name, $prod_name));

            $notification = new Notification();
            $notification->user_id= $user->id;
            $notification->table_name = 'inquiries';
            $notification->table_data= 'Deal';
            $notification->notification_text= $buysell->product_service_name.' Deal inquiry added by '.auth()->user()->name;
            $notification->prod_id= $buysell->id;
            $notification->product_service_types= $buysell->product_service_types;
            $notification->product_service_name= $buysell->product_service_name;
            $notification->prod_user_id= $buysell->user_id;
            $notification->save();
        }
        if($data['inquiry']->save()){
            $data['msg'] = 'Inquiry created  successfully !';
            $data['feedback'] = 'true';
        }

        return json_encode($data);

    }
//////////////////////////Added by Taha for Inquiry Module/////////////////////////

//////////////Bizdeal Inquiry/////////////////////

    public function buysell_index(Request $request)
    {
        // dd(\Auth::user());
            $data['active'] = 'Inquiries';
            $data['title'] = 'One-Time Active Inquiries';
            $data['user'] = \Auth::user();
            $data['order'] = 'desc';

            $data['sent_messages'] =  \App\BizdealInquiryConversation::with('product.user','messages','latestMessage','my_latest_message')->has('my_latest_message')->get();

            $data['deleted_messages'] =  \App\BizdealInquiryConversation::with('product.user','messages','latestMessage','my_latest_message')->has('my_latest_message')->whereHas('delete_convos', function($q){
                $q->where('created_by',\Auth::id());
            })->get();
            // dd($data['sent_messages']);
            $data['listing'] = \App\BizdealInquiryConversation::with('product.user','messages','latestMessage','my_latest_message')->where(function($q1){
                $q1->whereHas('product', function($query){
                    $query->whereHas('user', function($q){
                        $q->where('users.id', \Auth::id());
                    });
                })->orWhere('created_by',\Auth::id());
            })->get()->sortByDesc('latestMessage.created_at');
            // dd($data['listing']);
            // $data['request'] = $request;
            // dd($data);
            $data['page'] = 'biz_deal_inquiry.listing';

        DB::table('notifications')
            ->where('user_id', auth()->id())
            ->where('table_name','inquiries')
            ->where('table_data','Deal')
            ->update(['is_display' => 1,'is_read'=>1]);

            return view('front_site.' . $data['page'])->with($data);
    }

    public function get_inbox_refresh(){
        try {
            $user_id = decrypt(request('user_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if($user_id)
            {
                $d['user'] = \App\User::find($user_id);
                $d['listing'] = \App\BizdealInquiryConversation::with('product.user','messages','latestMessage','my_latest_message')->where(function($q1) use($user_id){
                    $q1->whereHas('product', function($query) use($user_id){
                        $query->whereHas('user', function($q) use($user_id){
                            $q->where('users.id', $user_id);
                        });
                    })->orWhere('created_by',$user_id);
                })->get()->sortByDesc('latestMessage.created_at');
                if($d['user'] && $d['listing'])
                {
                    $data['data'] = view('front_site.biz_deal_inquiry.inbox' , $d)->render();
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

    public function get_sent_box_refresh(){


            try {
                $user_id = decrypt(request('user_id'));
            } catch (\RuntimeException $e) {
                return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
            }
            if($user_id)
                {
                    $d['user'] = \App\User::find($user_id);
                    $d['listing'] = \App\BizdealInquiryConversation::with('product.user','messages','latestMessage','my_latest_message')->has('my_latest_message')->get();
                    if($d['user'] && $d['listing'])
                    {
                        $data['data'] = view('front_site.biz_deal_inquiry.sent-box' , $d)->render();
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

    public function get_delete_refresh(){

            try {
                $user_id = decrypt(request('user_id'));
            } catch (\RuntimeException $e) {
                return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
            }
            if($user_id)
                {
                    $d['user'] = \App\User::find($user_id);
                    $d['listing'] = \App\BizdealInquiryConversation::with('product.user','messages','latestMessage','my_latest_message')->whereHas('delete_convos', function($q){
                        $q->where('created_by',\Auth::id());
                    })->get();
                    if($d['user'] && $d['listing'])
                    {
                        $data['data'] = view('front_site.biz_deal_inquiry.delete-box' , $d)->render();
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

    public function get_bizdeal_inquiry_messages(){
        if(request('conversation_id'))
            {
                $d['convo'] = \App\BizdealInquiryConversation::with(['messages' => function($q){
                    $q->orderBy('created_at','desc');
                }])->find(request('conversation_id'));
                // dd($d['convo']);
                if($d['convo'])
                {
                    $data['data'] = view('front_site.biz_deal_inquiry.chat' , $d)->render();
                    $data['feedback'] = 'true';
                    \App\bizdealInqueryConversationMessage::where([['conversation_id',request('conversation_id')], ['created_by','<>',\Auth::id()]])->update(['is_read'=> 1]);
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

    public function reply_bizdeal_inquiry_convo(){
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
        \App\bizdealInqueryConversationMessage::where([['conversation_id',$conversation_id], ['created_by','<>',request('created_by')]])->update(['is_read'=> 1]);
        $message = new \App\bizdealInqueryConversationMessage();
        $message->conversation_id = $conversation_id;
        $message->message = request('message');
        $message->created_by = request('created_by');
        if(request()->file('file')){
            $file = inquiry_file_uploader(request()->file('file'), $message, 'biz_deal_inquiry');
            $message->file_path = $file;
        }
        if($message->save()){



            if(\App\BizdealInquiryConvoDelete::where('conversation_id', $conversation_id)->where('created_by', \Auth::id())->first())
            \App\BizdealInquiryConvoDelete::where('conversation_id', $conversation_id)->where('created_by', \Auth::id())->delete();
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

    public function delete_bizdeal_inquiry_convo(){
        try {
            $conversation_id = decrypt(request('conversation_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_id) {
            $convo = \App\BizdealInquiryConversation::find($conversation_id);
            if($convo){
                // $convo->delete();
                $delete_convo = new \App\BizdealInquiryConvoDelete();
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

    public function favorite_bizdeal_inquiry_convo(){

        try {
            $conversation_id = decrypt(request('conversation_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_id) {
            $convo = \App\BizdealInquiryConversation::find($conversation_id);
            if($convo){
                $is_favorite = \App\BizdealInquiryConvoFav::where('created_by',\Auth::id())->where('conversation_id',$convo->id)->first();
                if($is_favorite){
                    $is_favorite->delete();
                    $data['msg'] = 'Inquiry has been removed from favorite successfully';
                }
                else{

                    $fav_convo = new \App\BizdealInquiryConvoFav();
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

    public function favorite_bizdeal_inquiry_convo_multiple(){

        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



                $exist = \App\BizdealInquiryConvoFav::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
                if($exist > 0){
                    \App\BizdealInquiryConvoFav::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
                }
                foreach ($conversation_ids as $key => $value) {
                    $fav_convo = new \App\BizdealInquiryConvoFav();
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

    public function un_favorite_bizdeal_inquiry_convo_multiple(){
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



                $exist = \App\BizdealInquiryConvoFav::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
                if($exist > 0){
                    \App\BizdealInquiryConvoFav::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
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

    public function pin_bizdeal_inquiry_convo(){

        try {
            $conversation_id = decrypt(request('conversation_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_id) {
            $convo = \App\BizdealInquiryConversation::find($conversation_id);
            if($convo){
                $is_favorite = \App\BizdealInquiryConvoPin::where('created_by',\Auth::id())->where('conversation_id',$convo->id)->first();
                if($is_favorite){
                    $is_favorite->delete();
                    $data['msg'] = 'Inquiry has been removed from Pined inquires successfully';
                }
                else{

                    $fav_convo = new \App\BizdealInquiryConvoPin();
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

    public function pin_bizdeal_inquiry_convo_multiple(){

        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



                $exist = \App\BizdealInquiryConvoPin::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
                if($exist > 0){
                    \App\BizdealInquiryConvoPin::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
                }
                foreach ($conversation_ids as $key => $value) {
                    $fav_convo = new \App\BizdealInquiryConvoPin();
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

    public function un_pin_bizdeal_inquiry_convo_multiple(){
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



                $exist = \App\BizdealInquiryConvoPin::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
                if($exist > 0){
                    \App\BizdealInquiryConvoPin::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
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

    public function read_bizdeal_inquiry_convo_multiple(){
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



                $exist = \App\bizdealInqueryConversationMessage::whereIn('conversation_id',$conversation_ids)->where('created_by','<>', \Auth::id())->where('is_read', 1)->count();
                if($exist > 0){
                    \App\bizdealInqueryConversationMessage::whereIn('conversation_id',$conversation_ids)->where('created_by','<>', \Auth::id())->where('is_read', 0)->update(['is_read'=>1]);
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

    public function unread_bizdeal_inquiry_convo_multiple(){
        // dd(request()->all());
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



                $exist = \App\BizdealInquiryConversation::whereIn('id',$conversation_ids)->with('latestMessageNotMine')->has('latestMessageNotMine')->get();
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

    public function delete_bizdeal_inquiry_convo_multiple(){
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



                $exist = \App\BizdealInquiryConvoDelete::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
                if($exist > 0){
                    \App\BizdealInquiryConvoDelete::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
                }
                foreach ($conversation_ids as $key => $value) {
                    $fav_convo = new \App\BizdealInquiryConvoDelete();
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

    public function get_filtered_inqueries(){
        $user_id = \Auth::id();
        if(request('from')){
            if(request('from') == 'inbox'){

                $d['listing'] = \App\BizdealInquiryConversation::with('product.user','messages','latestMessage','my_latest_message')->where(function($q1) use($user_id){
                    $q1->whereHas('product', function($query) use($user_id){
                        $query->whereHas('user', function($q) use($user_id){
                            $q->where('users.id', $user_id);
                        });
                    })->orWhere('created_by',$user_id);
                });

                if(request('filter') == 'star'){
                    $d['listing'] = $d['listing']->whereHas('favorite_conversations', function($q) use($user_id){
                        $q->where('bizdeal_inquiry_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'un-star'){

                    $d['listing'] = $d['listing']->whereDoesntHave('favorite_conversations', function($q) use($user_id){
                        $q->where('bizdeal_inquiry_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'read'){
                    $d['listing'] = $d['listing']->whereHas('latestMessageNotMine', function($q) {
                        $q->where('bizdeal_inquery_conversation_messages.is_read', 0);
                    });
                }
                if(request('filter') == 'un-read'){
                    $d['listing'] = $d['listing']->whereDoesntHave('latestMessageNotMine', function($q) {
                        $q->where('bizdeal_inquery_conversation_messages.is_read', 0);
                    });
                }
                if(request('filter') == 'pin'){
                    $d['listing'] = $d['listing']->whereHas('pin_conversations', function($q) use($user_id){
                        $q->where('bizdeal_inquiry_convo_pins.created_by', $user_id);
                    });
                }


                $d['listing'] = $d['listing']->get()->sortByDesc('latestMessage.created_at');
                // dd($d['listing']);
                $data['data'] = view('front_site.biz_deal_inquiry.inbox' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'inboxMail';



            }elseif(request('from') == 'sent'){

                $d['listing'] = \App\BizdealInquiryConversation::with('product.user','messages','latestMessage','my_latest_message')->has('my_latest_message');

                if(request('filter') == 'star'){
                    $d['listing'] = $d['listing']->whereHas('favorite_conversations', function($q) use($user_id){
                        $q->where('bizdeal_inquiry_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'un-star'){

                    $d['listing'] = $d['listing']->whereDoesntHave('favorite_conversations', function($q) use($user_id){
                        $q->where('bizdeal_inquiry_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'read'){
                    $d['listing'] = $d['listing']->whereHas('latestMessageNotMine', function($q) {
                        $q->where('bizdeal_inquery_conversation_messages.is_read', 0);
                    });
                }
                if(request('filter') == 'un-read'){
                    $d['listing'] = $d['listing']->whereDoesntHave('latestMessageNotMine', function($q) {
                        $q->where('bizdeal_inquery_conversation_messages.is_read', 0);
                    });
                }
                if(request('filter') == 'pin'){
                    $d['listing'] = $d['listing']->whereHas('pin_conversations', function($q) use($user_id){
                        $q->where('bizdeal_inquiry_convo_pins.created_by', $user_id);
                    });
                }

                $d['listing'] = $d['listing']->get();
                $data['data'] = view('front_site.biz_deal_inquiry.sent-box' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'sentMail';

            }elseif(request('from') == 'delete'){

                $d['listing'] = \App\BizdealInquiryConversation::with('product.user','messages','latestMessage','my_latest_message')->has('my_latest_message')->whereHas('delete_convos', function($q){
                    $q->where('created_by',\Auth::id());
                });

                if(request('filter') == 'star'){
                    $d['listing'] = $d['listing']->whereHas('favorite_conversations', function($q) use($user_id){
                        $q->where('bizdeal_inquiry_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'un-star'){

                    $d['listing'] = $d['listing']->whereDoesntHave('favorite_conversations', function($q) use($user_id){
                        $q->where('bizdeal_inquiry_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'read'){
                    $d['listing'] = $d['listing']->whereHas('latestMessageNotMine', function($q) {
                        $q->where('bizdeal_inquery_conversation_messages.is_read', 0);
                    });
                }
                if(request('filter') == 'un-read'){
                    $d['listing'] = $d['listing']->whereDoesntHave('latestMessageNotMine', function($q) {
                        $q->where('bizdeal_inquery_conversation_messages.is_read', 0);
                    });
                }
                if(request('filter') == 'pin'){
                    $d['listing'] = $d['listing']->whereHas('pin_conversations', function($q) use($user_id){
                        $q->where('bizdeal_inquiry_convo_pins.created_by', $user_id);
                    });
                }

                $d['listing'] = $d['listing']->get();
                $data['data'] = view('front_site.biz_deal_inquiry.delete-box' , $d)->render();
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

    public function filter_bizdeal_onetime_inquiry(){
        // dd(request()->all());
        $user_id = \Auth::id();
        if(request('from')){
            if(request('from') == 'inbox'){
                $d['listing'] = \App\BizdealInquiryConversation::where(function($q1) use($user_id){
                    $q1->whereHas('product', function($query) use($user_id){
                        $query->whereHas('user', function($q) use($user_id){
                            $q->where('users.id', $user_id);
                        });
                    })->orWhere('created_by',$user_id);
                });
                if(request('datePicker')){
                    $d['listing'] = $d['listing']->whereHas('latestMessage', function($q){
                        $q->where(\DB::raw("STR_TO_DATE(bizdeal_inquery_conversation_messages.created_at,'%Y-%m-%d')"),'=', request('datePicker'));
                    })->with(['latestMessage' => function($q){
                        $q->where(\DB::raw("STR_TO_DATE(bizdeal_inquery_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
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
                $data['data'] = view('front_site.biz_deal_inquiry.inbox' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'inboxMail';
            }
            elseif(request('from') == 'sent-box'){
                $d['listing'] = \App\BizdealInquiryConversation::has('my_latest_message');

                if(request('datePicker')){
                    $d['listing'] = $d['listing']->whereHas('my_latest_message', function($q){
                        $q->where(\DB::raw("STR_TO_DATE(bizdeal_inquery_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
                    })->with(['my_latest_message' => function($q){
                        $q->where(\DB::raw("STR_TO_DATE(bizdeal_inquery_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
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
                $data['data'] = view('front_site.biz_deal_inquiry.sent-box' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'sentMail';
            }
            elseif(request('from') == 'delete-box'){
                $d['listing'] = \App\BizdealInquiryConversation::with('product.user','messages','latestMessage','my_latest_message')->has('my_latest_message')->whereHas('delete_convos', function($q){
                    $q->where('created_by',\Auth::id());
                });

                if(request('datePicker')){
                    $d['listing'] = $d['listing']->whereHas('my_latest_message', function($q){
                        $q->where(\DB::raw("STR_TO_DATE(bizdeal_inquery_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
                    })->with(['my_latest_message' => function($q){
                        $q->where(\DB::raw("STR_TO_DATE(bizdeal_inquery_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
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
                $data['data'] = view('front_site.biz_deal_inquiry.delete-box' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'trashMail';

            }
        }else{
            $data['feedback'] = 'false';
            $data['msg'] = 'Request from is not found';
        }
        return json_encode($data);
    }

    ////////////////////Lead Inquiry////////////////////
    public function product_index(Request $request)
    {

            $data['active'] = 'Inquiries';
            $data['title'] = 'MyBiz Active Inquiries';
            $data['user'] = \App\User::find(\auth()->id());
            // dd(\Auth::user()->company_profiles);
            $data['order'] = 'desc';
            $data['sent_messages'] =  \App\BizLeadInquiryConversation::with('product.company','messages','latestMessage','my_latest_message')->has('my_latest_message')->get();

            $data['deleted_messages'] =  \App\BizLeadInquiryConversation::with('product.company','messages','latestMessage','my_latest_message')->has('my_latest_message')->whereHas('delete_convos', function($q){
                $q->where('created_by',\Auth::id());
            })->get();
            // dd($data['sent_messages']);
            $data['listing'] = \App\BizLeadInquiryConversation::with('product.company','messages','latestMessage','my_latest_message')->where(function($q1){
                $q1->whereHas('product', function($query){
                    $query->whereHas('company', function($q){
                        $q->where('company_profiles.id', \Session::get('company_id'));
                    });
                })->orWhere('created_by',\Auth::id());
            })->get()->sortByDesc('latestMessage.created_at');
            // dd($data['listing']);
            // $data['request'] = $request;
            // dd($data);
            $data['page'] = 'biz_lead_inquiry.listing';
            DB::table('notifications')
                ->where('user_id', auth()->id())
                ->where('prod_comp_id',\session()->get('company_id'))
                ->where('table_name','inquiries')
                ->where('table_data','Lead')
                ->update(['is_display' => 1,'is_read'=>1]);
            return view('front_site.' . $data['page'])->with($data);

    }

    public function get_bizLead_inquiry_messages(){
        if(request('conversation_id'))
            {
                $d['convo'] = \App\BizLeadInquiryConversation::with('other_user_messages')->with(['messages' => function($q){
                    $q->orderBy('created_at','desc');
                }])->find(request('conversation_id'));
                // dd($d['convo']);
                if($d['convo'])
                {
                    $data['data'] = view('front_site.biz_lead_inquiry.chat' , $d)->render();
                    $data['feedback'] = 'true';
                    // \App\BizLeadInquiryConversationMessage::where([['conversation_id',request('conversation_id')], ['created_by','<>',\Auth::id()]])->update(['is_read'=> 1]);
                    if(\App\BizLeadInquiryConvoRead::whereIn('message_id', array_unique(\Arr::pluck($d['convo']->other_user_messages, 'id')))->where('conversation_id', request('conversation_id'))->where('created_by',\Auth::id())->count() > 0){
                        \App\BizLeadInquiryConvoRead::whereIn('message_id', array_unique(\Arr::pluck($d['convo']->other_user_messages, 'id')))->where('conversation_id', request('conversation_id'))->where('created_by',\Auth::id())->delete();
                    }
                    foreach (array_unique(\Arr::pluck($d['convo']->other_user_messages, 'id')) as $key => $value) {
                        $read = new \App\BizLeadInquiryConvoRead();
                        $read->conversation_id = request('conversation_id');
                        $read->message_id = $value;
                        $read->created_by = \Auth::id();
                        $read->save();
                    }
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

    public function reply_bizLead_inquiry_convo(){
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
        $messages = \App\BizLeadInquiryConversationMessage::where([['conversation_id',$conversation_id], ['created_by','<>',request('created_by')]])->where('created_by', '<>', \Auth::id())->get();
        // dd(array_unique(\Arr::pluck($messages, 'id')));

        if(\App\BizLeadInquiryConvoRead::whereIn('message_id', array_unique(\Arr::pluck($messages, 'id')))->where('conversation_id', $conversation_id)->where('created_by',\Auth::id())->count() > 0){
            \App\BizLeadInquiryConvoRead::whereIn('message_id', array_unique(\Arr::pluck($messages, 'id')))->where('conversation_id', $conversation_id)->where('created_by',\Auth::id())->delete();
        }
        foreach (array_unique(\Arr::pluck($messages, 'id')) as $key => $value) {
            $read = new \App\BizLeadInquiryConvoRead();
            $read->conversation_id = $conversation_id;
            $read->message_id = $value;
            $read->created_by = \Auth::id();
            $read->save();
        }


        $message = new \App\BizLeadInquiryConversationMessage();
        $message->conversation_id = $conversation_id;
        $message->message = request('message');
        $message->created_by = request('created_by');
        if(request()->file('file')){
            $file = inquiry_file_uploader(request()->file('file'), $message, 'biz_deal_inquiry');
            $message->file_path = $file;
        }
        if($message->save()){



            if(\App\BizLeadInquiryConvoDelete::where('conversation_id', $conversation_id)->where('created_by', \Auth::id())->first())
            \App\BizLeadInquiryConvoDelete::where('conversation_id', $conversation_id)->where('created_by', \Auth::id())->delete();
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

    public function delete_bizLead_inquiry_convo(){
        try {
            $conversation_id = decrypt(request('conversation_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_id) {
            $convo = \App\BizLeadInquiryConversation::find($conversation_id);
            if($convo){
                // $convo->delete();
                $delete_convo = new \App\BizLeadInquiryConvoDelete();
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

    public function favorite_bizLead_inquiry_convo(){

        try {
            $conversation_id = decrypt(request('conversation_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_id) {
            $convo = \App\BizLeadInquiryConversation::find($conversation_id);
            if($convo){
                $is_favorite = \App\BizLeadInquiryConvoFav::where('created_by',\Auth::id())->where('conversation_id',$convo->id)->first();
                if($is_favorite){
                    $is_favorite->delete();
                    $data['msg'] = 'Inquiry has been removed from favorite successfully';
                }
                else{

                    $fav_convo = new \App\BizLeadInquiryConvoFav();
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

    public function favorite_bizLead_inquiry_convo_multiple(){

        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



                $exist = \App\BizLeadInquiryConvoFav::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
                if($exist > 0){
                    \App\BizLeadInquiryConvoFav::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
                }
                foreach ($conversation_ids as $key => $value) {
                    $fav_convo = new \App\BizLeadInquiryConvoFav();
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

    public function un_favorite_bizLead_inquiry_convo_multiple(){
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



                $exist = \App\BizLeadInquiryConvoFav::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
                if($exist > 0){
                    \App\BizLeadInquiryConvoFav::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
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

    public function pin_bizLead_inquiry_convo(){

        try {
            $conversation_id = decrypt(request('conversation_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_id) {
            $convo = \App\BizLeadInquiryConversation::find($conversation_id);
            if($convo){
                $is_favorite = \App\BizLeadInquiryConvoPin::where('created_by',\Auth::id())->where('conversation_id',$convo->id)->first();
                if($is_favorite){
                    $is_favorite->delete();
                    $data['msg'] = 'Inquiry has been removed from Pined inquires successfully';
                }
                else{

                    $fav_convo = new \App\BizLeadInquiryConvoPin();
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

    public function pin_bizLead_inquiry_convo_multiple(){

        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



                $exist = \App\BizLeadInquiryConvoPin::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
                if($exist > 0){
                    \App\BizLeadInquiryConvoPin::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
                }
                foreach ($conversation_ids as $key => $value) {
                    $fav_convo = new \App\BizLeadInquiryConvoPin();
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

    public function un_pin_bizLead_inquiry_convo_multiple(){
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



                $exist = \App\BizLeadInquiryConvoPin::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
                if($exist > 0){
                    \App\BizLeadInquiryConvoPin::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
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

    public function read_bizLead_inquiry_convo_multiple(){
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



                $exist = \App\BizLeadInquiryConversationMessage::whereIn('conversation_id',$conversation_ids)->where('created_by','<>', \Auth::id())->doesntHave('my_read_messages')->get();
                if(count($exist) > 0){
                    // \App\BizLeadInquiryConversationMessage::whereIn('conversation_id',$conversation_ids)->where('created_by','<>', \Auth::id())->where('is_read', 0)->update(['is_read'=>1]);

                    foreach ($exist as $key => $value) {
                        $read = new \App\BizLeadInquiryConvoRead();
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

    public function unread_bizLead_inquiry_convo_multiple(){
        // dd(request()->all());
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



                $exist = \App\BizLeadInquiryConvoRead::whereIn('conversation_id',$conversation_ids)->where('created_by',\Auth::id())->count();
                if($exist > 0){
                    // foreach ($exist as $key => $value) {
                    //     $value->latestMessageNotMine->is_read = 0;
                    //     $value->latestMessageNotMine->save();
                    // }
                    \App\BizLeadInquiryConvoRead::whereIn('conversation_id',$conversation_ids)->where('created_by',\Auth::id())->delete();
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

    public function delete_bizLead_inquiry_convo_multiple(){
        try {
            $conversation_ids = array_map('decrypt', request('conversation_id')) ;
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if ($conversation_ids) {



                $exist = \App\BizLeadInquiryConvoDelete::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->count();
                if($exist > 0){
                    \App\BizLeadInquiryConvoDelete::where('created_by',\Auth::id())->whereIn('conversation_id',$conversation_ids)->delete();
                }
                foreach ($conversation_ids as $key => $value) {
                    $fav_convo = new \App\BizLeadInquiryConvoDelete();
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

    public function get_sent_box_refresh_bizLead(){


        try {
            $user_id = decrypt(request('user_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if($user_id)
            {
                $d['user'] = \App\User::find($user_id);
                $d['listing'] = \App\BizLeadInquiryConversation::with('product.company','messages','latestMessage','my_latest_message')->has('my_latest_message')->get();
                if($d['user'] && $d['listing'])
                {
                    $data['data'] = view('front_site.biz_lead_inquiry.sent-box' , $d)->render();
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

    public function get_inbox_refresh_bizLead(){
        try {
            $user_id = decrypt(request('user_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
        }
        if($user_id)
            {
                $d['user'] = \App\User::find($user_id);
                $d['listing'] = \App\BizLeadInquiryConversation::with('product.company','messages','latestMessage','my_latest_message')->where(function($q1) use($user_id){
                    $q1->whereHas('product', function($query) use($user_id){
                        $query->whereHas('company', function($q) use($user_id){
                            $q->where('company_profiles.id', \Session::get('company_id'));
                        });
                    })->orWhere('created_by',$user_id);
                })->get()->sortByDesc('latestMessage.created_at');
                if($d['user'] && $d['listing'])
                {
                    $data['data'] = view('front_site.biz_lead_inquiry.inbox' , $d)->render();
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

    public function get_delete_refresh_bizLead(){

            try {
                $user_id = decrypt(request('user_id'));
            } catch (\RuntimeException $e) {
                return json_encode(['feedback' => 'encrypt_issue' , 'msg' => 'Something Went Wrong']);
            }
            if($user_id)
                {
                    $d['user'] = \App\User::find($user_id);
                    $d['listing'] = \App\BizLeadInquiryConversation::with('product.company','messages','latestMessage','my_latest_message')->whereHas('delete_convos', function($q){
                        $q->where('created_by',\Auth::id());
                    })->get();
                    if($d['user'] && $d['listing'])
                    {
                        // dd($d['listing']);;
                        $data['data'] = view('front_site.biz_lead_inquiry.delete-box' , $d)->render();
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

    public function get_filtered_inqueries_bizLead(){
        $user_id = \Auth::id();
        if(request('from')){
            if(request('from') == 'inbox'){

                $d['listing'] = \App\BizLeadInquiryConversation::with('product.company','messages','latestMessage','my_latest_message')->where(function($q1) use($user_id){
                    $q1->whereHas('product', function($query) use($user_id){
                        $query->whereHas('company', function($q) use($user_id){
                            $q->where('company_profiles.id', \Session::get('company_id'));
                        });
                    })->orWhere('created_by',$user_id);
                });

                if(request('filter') == 'star'){
                    $d['listing'] = $d['listing']->whereHas('favorite_conversations', function($q) use($user_id){
                        $q->where('biz_lead_inquiry_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'un-star'){

                    $d['listing'] = $d['listing']->whereDoesntHave('favorite_conversations', function($q) use($user_id){
                        $q->where('biz_lead_inquiry_convo_favs.created_by', $user_id);
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
                        $q->where('biz_lead_inquiry_convo_pins.created_by', $user_id);
                    });
                }


                $d['listing'] = $d['listing']->get()->sortByDesc('latestMessage.created_at');
                // dd($d['listing']);
                $data['data'] = view('front_site.biz_lead_inquiry.inbox' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'inboxMail';



            }elseif(request('from') == 'sent'){

                $d['listing'] = \App\BizLeadInquiryConversation::with('product.company','messages','latestMessage','my_latest_message')->has('my_latest_message');

                if(request('filter') == 'star'){
                    $d['listing'] = $d['listing']->whereHas('favorite_conversations', function($q) use($user_id){
                        $q->where('biz_lead_inquiry_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'un-star'){

                    $d['listing'] = $d['listing']->whereDoesntHave('favorite_conversations', function($q) use($user_id){
                        $q->where('biz_lead_inquiry_convo_favs.created_by', $user_id);
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
                        $q->where('biz_lead_inquiry_convo_pins.created_by', $user_id);
                    });
                }

                $d['listing'] = $d['listing']->get();
                $data['data'] = view('front_site.biz_lead_inquiry.sent-box' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'sentMail';

            }elseif(request('from') == 'delete'){

                $d['listing'] = \App\BizLeadInquiryConversation::with('product.company','messages','latestMessage','my_latest_message')->has('my_latest_message')->whereHas('delete_convos', function($q){
                    $q->where('created_by',\Auth::id());
                });

                if(request('filter') == 'star'){
                    $d['listing'] = $d['listing']->whereHas('favorite_conversations', function($q) use($user_id){
                        $q->where('biz_lead_inquiry_convo_favs.created_by', $user_id);
                    });
                }
                if(request('filter') == 'un-star'){

                    $d['listing'] = $d['listing']->whereDoesntHave('favorite_conversations', function($q) use($user_id){
                        $q->where('biz_lead_inquiry_convo_favs.created_by', $user_id);
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
                        $q->where('biz_lead_inquiry_convo_pins.created_by', $user_id);
                    });
                }

                $d['listing'] = $d['listing']->get();
                $data['data'] = view('front_site.biz_lead_inquiry.delete-box' , $d)->render();
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

    public function filter_bizLead_onetime_inquiry(){
        // dd(request()->all());
        $user_id = \Auth::id();
        if(request('from')){
            if(request('from') == 'inbox'){
                $d['listing'] = \App\BizLeadInquiryConversation::where(function($q1) use($user_id){
                    $q1->whereHas('product', function($query) use($user_id){
                        $query->whereHas('company', function($q) use($user_id){
                            $q->where('company_profiles.id', \Session::get('company_id'));
                        });
                    })->orWhere('created_by',$user_id);
                });
                if(request('datePicker')){
                    $d['listing'] = $d['listing']->whereHas('latestMessage', function($q){
                        $q->where(\DB::raw("STR_TO_DATE(biz_lead_inquiry_conversation_messages.created_at,'%Y-%m-%d')"),'=', request('datePicker'));
                    })->with(['latestMessage' => function($q){
                        $q->where(\DB::raw("STR_TO_DATE(biz_lead_inquiry_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
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
                $data['data'] = view('front_site.biz_lead_inquiry.inbox' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'inboxMail';
            }
            elseif(request('from') == 'sent-box'){
                $d['listing'] = \App\BizLeadInquiryConversation::has('my_latest_message');

                if(request('datePicker')){
                    $d['listing'] = $d['listing']->whereHas('my_latest_message', function($q){
                        $q->where(\DB::raw("STR_TO_DATE(biz_lead_inquiry_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
                    })->with(['my_latest_message' => function($q){
                        $q->where(\DB::raw("STR_TO_DATE(biz_lead_inquiry_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
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
                $data['data'] = view('front_site.biz_lead_inquiry.sent-box' , $d)->render();
                $data['feedback'] = 'true';
                $data['body_id'] = 'sentMail';
            }
            elseif(request('from') == 'delete-box'){
                $d['listing'] = \App\BizLeadInquiryConversation::with('product.company','messages','latestMessage','my_latest_message')->has('my_latest_message')->whereHas('delete_convos', function($q){
                    $q->where('created_by',\Auth::id());
                });

                if(request('datePicker')){
                    $d['listing'] = $d['listing']->whereHas('my_latest_message', function($q){
                        $q->where(\DB::raw("STR_TO_DATE(biz_lead_inquiry_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
                    })->with(['my_latest_message' => function($q){
                        $q->where(\DB::raw("STR_TO_DATE(biz_lead_inquiry_conversation_messages.created_at,'%Y-%m-%d')"), request('datePicker'));
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
                $data['data'] = view('front_site.biz_lead_inquiry.delete-box' , $d)->render();
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

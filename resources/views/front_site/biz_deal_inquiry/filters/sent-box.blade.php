@if(count($listing) > 0)
@foreach ($listing as $key => $list)
<div class="content-box-email mail-reply-box">
    <input type="hidden" class="main-convo" data-main-convo="{{encrypt($list->id)}}">
    <div class="py-2 px-2 d-flex justify-content-between">
        <div class="d-flex w-60">
            <div class="d-inline-block custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input"
                    id="customControlAutosizing2{{$key}}" data-main-convo="{{encrypt($list->id)}}">
                <label class="custom-control-label" for="customControlAutosizing2{{$key}}"></label>
            </div>
            <p class="mb-0 px-2"><span
                    class="fa @if(check_in_my_fav($list)) fa-star-o @else fa-star @endif fav add-fav"></span>
            </p>
            <p class="mb-0 ml-2 click overflow-text-dots-one-line h-1-5-rm @if($list->latestMessageNotMine && $list->latestMessageNotMine->is_read == 0  ) font-weight-bold @endif" data-click-id="{{$list->id}}">
                <span>{{$list->product->product_service_name}}</span> - <span
                    class="refer">Ref# {{$list->product->reference_no}}</span> -
                <span>{{mb_strimwidth((strip_tags($list->my_latest_message->message)), 0, 50, "...")}}</span>
            </p>
        </div>
        <div class="d-flex">
            <p class="mb-0 click @if($list->latestMessage->is_read == 0 && $list->latestMessage->created_by != \Auth::id() ) font-weight-bold @endif"
               data-click-id="{{$list->id}}">
                <span>{{date('M d h:i:s A', strtotime($list->my_latest_message->created_at))}}</span>
            </p>
            <p class="mb-0 px-2"><span class="fa fa-trash trash-bin"></span></p>
            <p class="mb-0"><span class="ml-2 fa fa-reply reply-msg"></span></p>
        </div>
    </div>
    <div class="mx-3 position-relative reply-input-field">
        <textarea class="form-control send-box"></textarea>
        <div class="position-absolute d-flex align-items-center top-0 sent-attach-btn-send-icon">
            <div class="input-group-prepend">
                <div class="input-group-text blue-btn p-0"><span id="upload_button" class="p-0"
                        data-original-title="" title=""><label class="m-0"><input type="file"
                                id="file" class="d-none upload-file"> <span
                                class="fa fa-paperclip text-white p-2"></span></label></span></div>
            </div>
            <button class="ml-2 send-icon send-icon-convo"><span
                    class="fa fa-paper-plane"></span></button>
        </div>
    </div>
</div>
@endforeach
    </div>

@else
<p class="py-3 text-center font-500 zero-inquires">Sorry, no inquiries found!</p>
@endif

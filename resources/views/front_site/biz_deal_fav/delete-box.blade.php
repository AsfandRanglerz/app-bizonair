<div class="mails-inbox">
    <div class="py-2 px-2 mails-inbox-header">
        <input type="hidden" name="from" value="delete">
        {{-- <div class="d-inline-block custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input selectAll" id="selectAll1">
            <label class="custom-control-label" for="selectAll1"></label>
        </div> --}}
        <span class="mx-2 fa fa-refresh mails-inbox-icons " data-action="refresh"></span>
        {{-- <span class="mx-2 fa fa-trash mails-inbox-icons"></span> --}}
        <span class="mx-2 fa fa-star-o mails-inbox-icons" data-action="un-star"></span>
        <span class="mx-2 fa fa-star mails-inbox-icons" data-action="star"></span>
        <span class="mx-2 fal fa-envelope mails-inbox-icons" data-action="read"></span>
        <span class="mx-2 fas fa-envelope mails-inbox-icons" data-action="un-read"></span>
        <span class="mx-2 fas fa-flag  mails-inbox-icons" data-action="pin"></span>
    </div>

    <div class="dynamic-filters-body">
        @if(count($listing) > 0)
    @foreach ($listing as $list)

    <div class="content-box-email mail-reply-box">
        <input type="hidden" class="main-convo" data-main-convo="{{encrypt($list->id)}}">
        <div class="py-2 px-2 d-flex justify-content-between">
            <div class="d-flex w-60">
                <p class="mb-0 px-2"><span
                        class="fa @if(check_in_my_fav($list,'fav')) fa-star-o @else fa-star @endif fav add-fav"></span>
                </p>
                <p class="mb-0 px-2"><span class=" @if(check_in_my_pin($list,'fav'))far @else fas @endif fa-flag add-to-pin"></span></p>
                <p class="mb-0 ml-2 click overflow-text-dots-one-line h-1-5-rm @if($list->latestMessageNotMine && $list->latestMessageNotMine->is_read == 0  ) font-weight-bold @endif"
                    data-click-id="{{$list->id}}"><span>{{$list->product->product_service_name}}</span> -
                    <span class="refer">Ref# {{$list->product->reference_no}}</span> -
                    <span>{{mb_strimwidth((strip_tags($list->latestMessage->message)), 0, 50, "...")}}</span>
                </p>
            </div>

            <div class="d-flex">
                <p class="mb-0 click @if($list->latestMessage->is_read == 0  && $list->latestMessage->created_by != \Auth::id()) font-weight-bold @endif"
                   data-click-id="{{$list->id}}">
                    <span>{{date('M d h:i:s A', strtotime($list->latestMessage->created_at))}}</span></p>

                <p class="mb-0"><span class="ml-2 fa fa-reply reply-msg"></span></p>
            </div>

        </div>
        <div class="pb-3 mx-3 position-relative reply-input-field">
            <textarea class="form-control send-box"></textarea>
            <div class="position-absolute d-flex align-items-center top-0 sent-attach-btn-send-icon">
                <div class="input-group-prepend">
                    <div class="input-group-text blue-btn p-0"><span id="upload_button" class="p-0"
                            data-original-title="" title=""><label class="m-0"><input type="file" id="file"
                                    class="d-none upload-file"> <span
                                    class="fa fa-paperclip text-white p-2"></span></label></span></div>
                </div>
                <button class="ml-2 send-icon send-icon-convo"><span
                        class="fa fa-paper-plane"></span></button>
                        <button type="submit" disabled="" class="btn-pro btn red-btn d-none ml-2 align-items-center  justify-content-center"><span class="spinner-border spinner-border-sm mr-1" ml-2="" role="status" aria-hidden="true"></span></button>
            </div>
        </div>
    </div>
    @endforeach
    </div>

    @else
    <p class="py-3 text-center font-500 zero-inquires">Sorry, no inquiries found!</p>
    @endif
</div>

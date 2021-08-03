<form action="{{route('search_product')}}" class="position-relative form-inline mt-2">
    <select class="position-absolute h-100 px-1 py-1 select-cat" name="category" id="serchfltr" style="background: #344356">
        <option value="" selected disabled>Select Category</option>
        <option value="Regular Supplier">Regular Supplier</option>
        <option value="Regular Buyer">Regular Buyer</option>
        <option value="One-Time Supplier">One-Time Supplier</option>
        <option value="One-Time Buyer">One-Time Buyer</option>
        <option value="Regular Services">Service Providers</option>
        <option value="One-Time Services">Service Seekers</option>
        <option value="Reference Number">Reference Number</option>
        <option value="Keywords">Keywords</option>
        <option value="articles">Articles</option>
        <option value="news">News</option>
        <option value="events">Events</option>
    </select>
    <input class="w-100 form-control fa-square-o fa-check-square-o biz-search" type="search" autocomplete="off" placeholder="Find Textile Materials, Machinery, Chemicals &amp; More..." aria-label="Search" id="searchKeyword" name="keywords">
    <div class="search-suggestions">
        <ul class="mb-0 overflow-auto links search_results_links"></ul>
    </div>
    <button class="position-absolute right-0 btn search-btn searchmega" type="submit">
        <span class="fa fa-search" aria-hidden="true"></span>
    </button>
</form>


@push('js')
    <script>
        $(document).delegate('#searchKeyword', 'keyup', function(e) {
            e.preventDefault();
            function ucFirst(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }
            var inpdata =ucFirst($(this).val());
            // var inpdata =$(this).val();
            var token='{{csrf_token()}}';
            $.ajax({
                type:'POST',
                url: '{{ url('/livesearch') }}',
                data:{inpdata:inpdata,_token:token},
                cache: false,
                success: function(data) {
                    var response = $.parseJSON(data);
                    // console.log(response);
                    var output = '';
                    if(response.length > 0){
                        response.forEach(function(item){
                            output += "<li id='searchWord'><a href="+item.link+" class='clearfix link' id='schWord'>"+item.value.replace(inpdata, '<b>' + inpdata + '</b>')+"<span class='float-right'>"+item.category+"</span></a></li>";
                        });
                    }
                    else{

                        output += "<li id='searchWord'><a href='#' class='clearfix link' id='schWord'><span class='float-right d-none'></span></a></li>";
                    }

                    console.log(output);
                    $('.search_results_links').html(output);

                    if(output != ''){
                        $('#searchKeyword').trigger('focus');
                        $('#searchKeyword').focus(function () {
                            if($('.search-suggestions .links li').length!=0) {
                                $('.search-suggestions').fadeIn(500);
                            }
                        });
                    }

                }
            });
        });
        $(document).on('click','.searchmega',function() {
            var verified1 = $('#serchfltr').val();
            var verified2 = $('#searchKeyword').val();
            console.log(verified1);
            console.log(verified2);
            if (verified1 && verified2) {
                return true;
            }else{
                alert('Please Input Complete Search Details.');
                return false;
            }
        });
    </script>
@endpush

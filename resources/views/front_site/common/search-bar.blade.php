<form action="{{route('search_product')}}" class="position-relative form-inline mt-2">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary position-absolute h-100 px-1 py-1 select-cat" data-toggle="modal" data-target="#selCategoryModel">
        <span class="sel-cat-default-text">Categories</span><span class="fa fa-angle-down"></span>
    </button>
    <input type="hidden" value="" name="category" id="selCatInput" />

    <!-- Modal -->
    <div class="modal fade sel-category-model" id="selCategoryModel" tabindex="-1" role="dialog" aria-labelledby="selCategoryModelTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title">Select Category</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column align-items-start">
                        <div class="mb-1 custom-control custom-radio custom-control-inline">
                            <input type="radio" value="All" id="allCategories" name="category_option" class="custom-control-input">
                            <label class="text-white custom-control-label" for="allCategories" >All Categories</label>
                        </div>
                        <div class="mb-1 custom-control custom-radio custom-control-inline">
                            <input type="radio" value="Regular Supplier" id="regSupplier" name="category_option" class="custom-control-input">
                            <label class="text-white custom-control-label" for="regSupplier" >Regular Supplier</label>
                        </div>
                        <div class="mb-1 custom-control custom-radio custom-control-inline">
                            <input type="radio" value="Regular Buyer" id="regBuyer" name="category_option" class="custom-control-input">
                            <label class="text-white custom-control-label" for="regBuyer">Regular Buyer</label>
                        </div>
                        <div class="mb-1 custom-control custom-radio custom-control-inline">
                            <input type="radio" value="One-Time Supplier" id="oneTimeSup" name="category_option" class="custom-control-input">
                            <label class="text-white custom-control-label" for="oneTimeSup">One-Time Supplier</label>
                        </div>
                        <div class="mb-1 custom-control custom-radio custom-control-inline">
                            <input type="radio" value="One-Time Buyer" id="oneTimeBuy" name="category_option" class="custom-control-input">
                            <label class="text-white custom-control-label" for="oneTimeBuy">One-Time Buyer</label>
                        </div>
                        <div class="mb-1 custom-control custom-radio custom-control-inline">
                            <input type="radio" value="Service Providers" id="serProv" name="category_option" class="custom-control-input">
                            <label class="text-white custom-control-label" for="serProv">Service Providers</label>
                        </div>
                        <div class="mb-1 custom-control custom-radio custom-control-inline">
                            <input type="radio" value="Service Seekers" id="serSeek" name="category_option" class="custom-control-input">
                            <label class="text-white custom-control-label" for="serSeek">Service Seekers</label>
                        </div>
                        <div class="mb-1 custom-control custom-radio custom-control-inline">
                            <input type="radio" value="Reference Number" id="refNumber" name="category_option" class="custom-control-input">
                            <label class="text-white custom-control-label" for="refNumber">Reference Number</label>
                        </div>
                        <div class="mb-1 custom-control custom-radio custom-control-inline">
                            <input type="radio" value="Keywords" id="catKeywords" name="category_option" class="custom-control-input">
                            <label class="text-white custom-control-label" for="catKeywords">Keywords</label>
                        </div>
                        <div class="mb-1 custom-control custom-radio custom-control-inline">
                            <input type="radio" value="Companies" id="catCompanies" name="category_option" class="custom-control-input">
                            <label class="text-white custom-control-label" for="catCompanies">Companies</label>
                        </div>
                        <div class="mb-1 custom-control custom-radio custom-control-inline">
                            <input type="radio" value="articles" id="catArticles" name="category_option" class="custom-control-input">
                            <label class="text-white custom-control-label" for="catArticles">Articles</label>
                        </div>
                        <div class="mb-1 custom-control custom-radio custom-control-inline">
                            <input type="radio" value="news" id="catNews" name="category_option" class="custom-control-input">
                            <label class="text-white custom-control-label" for="catNews">News</label>
                        </div>
                        <div class="mb-1 custom-control custom-radio custom-control-inline">
                            <input type="radio" value="events" id="catEvents" name="category_option" class="custom-control-input">
                            <label class="text-white custom-control-label" for="catEvents">Events</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input class="typeahead w-100 form-control fa-square-o fa-check-square-o biz-search" type="text" autocomplete="off" placeholder="Find Textile Materials, Machinery, Chemicals &amp; More..." aria-label="Search" id="searchKeyword" name="keywords">
    <div class="search-suggestions">
        <ul class="mb-0 overflow-auto links search_results_links"></ul>
    </div>
    <button class="position-absolute right-0 btn search-btn searchmega" type="submit">
        <span class="fa fa-search" aria-hidden="true"></span>
    </button>
</form>


@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script>

        $(document).ready(function() {
            var inpcategory;
            /*select category popup radio buttons*/
            $('input[name="category_option"]').on('click', function() {
                inpcategory = $('input[name=category_option]:checked').val();
                $('#selCatInput').val(inpcategory);
                $('.sel-cat-default-text').text(inpcategory);
                $('.sel-category-model .close').trigger('click');
            });
            /*select category popup radio buttons*/

            var path = "{{ url('/livesearch?inpcategory=') }}";
            $('input.typeahead').typeahead({
                source: function (keywords, process) {
                    return $.get(path + inpcategory, {keywords: keywords}, function (data) {
                        // return process(data);
                        var response = $.parseJSON(data);

                        var output = '';
                        if (response.length > 0) {
                            response.forEach(function (item) {
                                output += "<li id='searchWord'><a href=" + item.link + " class='clearfix link' id='schWord'>" + "<span class='search-text-block'>" + item.value.replace(keywords, '<b>' + keywords + '</b>') + "</span>" + "<span class='float-right'>" + item.category + "</span></a></li>";
                            });
                        } else {

                            output += "<li id='searchWord'><a href='#' class='clearfix link' id='schWord'><span class='float-right d-none'></span></a></li>";
                        }
                        console.log(output);
                        $('.search_results_links').html(output);

                        if (output != '') {
                            $('#searchKeyword').trigger('focus');
                            $('#searchKeyword').focus(function () {
                                if ($('.search-suggestions .links li').length != 0) {
                                    $('.search-suggestions').fadeIn(500);
                                }
                            });
                        }
                    });
                }
            });
        });

        $(document).on('click','.searchmega',function() {
            var verified1 = $('#selCatInput').val();
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

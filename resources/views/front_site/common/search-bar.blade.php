<form action="{{route('search_product')}}" class="position-relative form-inline mt-2">
    <select class="position-absolute h-100 px-1 py-1 select-cat" name="category" id="serchfltr" style="background: #344356">

        <option value="">Category</option>
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
    <input class="w-100 form-control fa-square-o fa-check-square-o biz-search" type="search" placeholder="Find Textile Materials, Machinery, Chemicals &amp; More..." aria-label="Search" id="searchKeyword" name="keywords">
    <button class="position-absolute right-0 btn search-btn searchmega" type="submit">
        <span class="fa fa-search" aria-hidden="true"></span>
    </button>
</form>


@push('js')

    <script>

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

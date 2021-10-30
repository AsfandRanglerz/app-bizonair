<?php
function keywords(){
    $keyword = 'Bizonair Textiles, Textile, Ginning, Spinning, Yarn Manufacturing, Spinning, Weaving, Fabric Manufacturing, Knitted, Woven, Non Woven, Natural Yarn, Synthetic Yarn, Blended Yarn,
                Specialty Yarn, Natural Fiber, Manmade Fiber, Dyeing, Printing, Wet processing, Digital printing,  Flatbed printing, Embroidery, Garments, Apparel manufacturing, Denim, Jeans, Knitwear, Shoes, Bags,
                Leather, Machines, Spare parts, Electrical, Mechanical, Cotton, Polyester, Erection, Commissioning, Product development, Sourcing, Production, Vendor management, Woven fabric, Knitted fabric,
                Non woven fabric,  Natural fibers, Synthetic fibers, Manmade fibers, Natural yarn, Synthetic yarn, Manmade yarn, Textile business, Textile services, Textile testing, Factory Assessment, Factory Audit,
                Quality check, Quality assurance, PPEs, Technical textiles, Hotel textiles, Hospital textiles, Home textiles, High performance textiles, Automotive textiles, Retail, Branding, Unstitched,
                Mens unstitched, Women unstitched, unstitched, Kids garments, Pret, Dyes, Chemicals, Pigments, Coatings, Lubricants, Leftovers, Waste, Machine parts, Eastern clothing, Western clothing, Pakistan,
                textile, textiles, online, portal, business, buy, sell, B2B, business to business, fibers, yarns, fabrics, machines, spareparts, garments, apparels, accessories, local, international, PPEs, institutional,
                hometextiles, hoteltextiles, hospitaltextiles, dyes, chemicals, Bizonair, businessbeyondboundaries, unstitched, leftovers, increasesales, growbusiness, onlinebusiness, free, textile portal, textileservices,
                jobs, careers, news, events, research, Lahore, leads, deals, onetime, regularbusiness, businessidea, Leather, Footwear, Testing, Inspection, Equipment, Leather products, footwear and bags, Trims, Packaging,
                PPEs, Gym, Exercise wear, gym wear, sportswear, work wear, towel and mats, pigments, preparatory chemicals, finishing chemicals, sizing chemicals, Processing chemicals, general chemicals, lubricants, textile waste,
                general waste, Human resources, admin, Contractual jobs, tranings, security, general, fabrication, repairing work, vendor selection, price negotiation, product development, order placement, certification, consultation, calibration,
                Laboratory, Production control, shipping, online reporting, bizonair Accounts, finance, taxation, financial audit, information technology, Post jobs, post cvs, explore jobs, explore cvs, textile news, textile blogs, textile events,
                textile articles, textile research, Textile projects, textile university, textile calculations, currency rates, cotton rates, yarn rates, textile student projects, regular supplier, regular buyer, one time supplier, one time buyer, service providers,
                service seekers, textile companies, Textile office, Mybiz office, mybiz leads, bizonair mybiz deals, chat, meetings, textile trade, myiz partners';
    return $keyword;
}
function descriptions(){
    $description = 'Pakistan Portal, Bizonair Textiles Portal, Business Portal, Free Textile Portal, Chemicals Portal, Textile Fibers Portal, Textile Materials Portal, Textile Business Portal, Textile Services Portal, Textile Machinery Portal, Textile Spare Parts Portal,
                    Textile Garments Portal, Textile Services Portal, PPEs Portal, Institutional Textiles Portal, Lahore Portal,  Best Portal, First Portal, Largest Portal, Number one Portal, #1 Portal, Textile Site, Textile Marketplace, Dyes Portal, Jobs Portal, Fastest
                    Portal, Free Portal, Convenient Portal, Textile Trade Portal, Textile Leads Portal, Textile Inquiries Portal, Textile Deals Portal, Textiles Matchmaking, Textile Solution, Textile Fraternity, Textile Community, Excellent Portal, Great Portal, Superb
                    Portal, Bizonair Pakistani portal, Global portal, worldwide portal, Textile Partners';
    return $description;
}

function getCategories($type)
{
    return \App\Category::where('type', $type)->orderBy('priority', 'ASC')->get();
}

function getSubCategories($id)
{
    return \App\Subcategory::where('category_id', $id)->orderBy('priority', 'ASC')->get();
}

function generalServices()

{

    return \App\Subservice::where('mainservice_id', '=', 2)->orderBy('priority', 'ASC')->get();

}


function texttileServices()

{

    return \App\Subservice::where('mainservice_id', '=', 1)->orderBy('priority', 'ASC')->get();

}


function textilematerials()

{

    return \App\Subcategory::where('category_id', '=', 5)->orderBy('priority', 'ASC')->get();

}


function machinaries()

{

    return \App\Subcategory::where('category_id', '=', 6)->orderBy('priority', 'ASC')->get();

}


function machinaryparts()

{

    return \App\Subcategory::where('category_id', '=', 7)->orderBy('priority', 'ASC')->get();

}


function chemicals()

{

    return \App\Subcategory::where('category_id', '=', 8)->orderBy('priority', 'ASC')->get();

}


function fachionaccessories()

{

    return \App\Subcategory::where('category_id', '=', 9)->orderBy('priority', 'ASC')->get();

}


function stocks()

{

    return \App\Subcategory::where('category_id', '=', 10)->orderBy('priority', 'ASC')->get();

}

function generate_verification_code($length = 6, $add_dashes = false, $available_sets = 'luds')

{

    $sets = array();

    if (strpos($available_sets, 'l') !== false)

        $sets[] = '357951456';

    if (strpos($available_sets, 'u') !== false)

        $sets[] = '986325478';

    if (strpos($available_sets, 'd') !== false)

        $sets[] = '23456789';

    if (strpos($available_sets, 's') !== false)

        $sets[] = '963147789';

    $all = '';

    $password = '';

    foreach ($sets as $set) {

        $password .= $set[array_rand(str_split($set))];

        $all .= $set;

    }

    $all = str_split($all);

    for ($i = 0; $i < $length - count($sets); $i++)

        $password .= $all[array_rand($all)];

    $password = str_shuffle($password);

    if (!$add_dashes)

        return $password;

    $dash_len = floor(sqrt($length));

    $dash_str = '';

    while (strlen($password) > $dash_len) {

        $dash_str .= substr($password, 0, $dash_len) . '-';

        $password = substr($password, $dash_len);

    }

    $dash_str .= $password;

    return $dash_str;

}

function get_user_status($user)
{
    $string = '';
    $user = \App\UserCompany::where('user_id',$user)->where('company_id',session()->get('company_id'))->first();
    if ($user->is_admin == 1 && $user->is_member == 0 && $user->is_owner == 1)
        $string = 'Admin, Owner';
    elseif ($user->is_admin == 1 && $user->is_member == 1)
        $string = 'Admin, Member';
    else {
        if ($user->is_admin == 1)
            $string = 'Admin';
        if ($user->is_member)
            $string = 'Member';
    }
    return $string;
}

function convertToHoursMins($time)
{
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    if ($hours != 0 && $minutes != 0)
        $output = $hours . 'hr and ' . $minutes . 'mins';
    else {
        if ($hours != 0)
            $output = $hours . 'hr';
        else
            $output = $minutes . 'mins';
    }
    return $output;
}

function check_owner($user_id)
{
    $user = \App\UserCompany::where('user_id',$user_id)->where('company_id',session()->get('company_id'))->first();
    if ($user->is_owner == 1 && $user->is_admin == 1 && $user->is_member == 0)
        return true;
    else
        return false;
}
function check_admin($user_id)
{
    $user = \App\UserCompany::where('user_id',$user_id)->where('company_id',session()->get('company_id'))->first();
    if ($user->is_owner == 0 && $user->is_admin == 1 && $user->is_member == 1)
        return true;
    else
        return false;
}
function check_member($user_id)
{
    $user = \App\UserCompany::where('user_id',$user_id)->where('company_id',session()->get('company_id'))->first();
    if ($user->is_owner == 0 && $user->is_admin == 0 && $user->is_member == 1)
        return true;
    else
        return false;
}
function checkOwnerCompany($userId,$companyId)
{
    $user = \App\UserCompany::where('user_id',$userId)->where('company_id',$companyId)->first();
    return $user;
}

function company_name($namecomp=null)
{

    $cname = \App\UserCompany::where('user_id',auth()->id())->where('company_id',$namecomp)->first();
    if($cname){
        return $cname->company_name;
    }else{
        return null;
    }


}

function file_uploader($file, $row, $folder)
{
    $filename = $file->getClientOriginalName();
    $extension = $file->getClientOriginalExtension();
    $picture1 = date('His') . $filename;
    $picture = str_replace(' ', '_', $picture1);
    $destinationPath = 'public/storage/' . $folder . '/dps';
    $dbPath = $folder . '/dps';
    $file->move($destinationPath, $picture);
    \File::delete($row->profile_pic);
    $profile_pic = $dbPath . '/' . $picture;
    return $profile_pic;
}

function get_user_image($user)
{
    if ($user->role_id == 2) {
        return $user->avatar;
    }
}

function get_userimage($user)
{
    if ($user->role_id == 2) {
        return $user->avatar;
    }

}

function getUserNameById($id)
{
    $user = \App\User::find($id);
    if ($user)
        return $user->first_name . ' ' . $user->last_name;
    else
        return '';

}

function get_user_profile_percentage($id)
{
    $percentage = 0;
    $user = \App\User::find($id);
    if ($user->email) {
        $percentage += 8;
    }
    if ($user->first_name) {
        $percentage += 8;
    }
    if ($user->last_name) {
        $percentage += 8;
    }
    if ($user->designation) {
        $percentage += 8;
    }
    if (\App\UserType::where('user_id', $id)->count()) {
        $percentage += 8;
    }
    if ($user->gender) {
        $percentage += 8;
    }
    if ($user->city) {
        $percentage += 8;
    }
    if ($user->state) {
        $percentage += 8;
    }
    if ($user->country) {
        $percentage += 8;
    }
    if ($user->registration_phone_no) {
        $percentage += 8;
    }
    if ($user->street_address) {
        $percentage += 5;
    }
    if ($user->postcode) {
        $percentage += 3;
    }
    if ($user->website) {
        $percentage += 3;
    }
    if ($user->whatsapp_number) {
        $percentage += 6;
    }
    if ($user->telephone) {
        $percentage += 3;
    }
    return $percentage;
}

function get_country_by_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $ip = '27.255.16.17';
    $json = file_get_contents("http://ipinfo.io/{$ip}?token=db92434eb86bf3");
    $details = json_decode($json, true);
    if (isset($details['country'])) {
        $country = $details['country'];
    } else {
        $country = null;
    }
//    dd($country);
    return $country;
}

function get_product_contact_no($prodid){
    $comp = \App\CompanyProfile::where('id',$prodid)->get();
    foreach ($comp as $company){
        $usercontact =\App\User::where('id',$company->user_id)->get();
        foreach ($usercontact as $contact){
            return $contact->registration_phone_no;
        }
    }
}

function get_product_city($prodid){
    $comp = \App\CompanyProfile::where('id',$prodid)->get();
    foreach ($comp as $company){
        $usercity =\App\User::where('id',$company->user_id)->get();
        foreach ($usercity as $city){
            return $city->city;
        }
    }
}

function get_product_country($prodid){
    $comp = \App\CompanyProfile::where('id',$prodid)->get();
    foreach ($comp as $company){
        $usercountry =\App\User::where('id',$company->user_id)->get();
        foreach ($usercountry as $country){
            return $country->country;
        }
    }
}

function get_product_created_at($prodid){
    $comp = \App\CompanyProfile::select('company_profiles.*', 'company_profiles.created_at as creation_date')->where('id',$prodid)->get();
    foreach ($comp as $name){
        $date=  str_replace('ago', ' ',\Carbon\Carbon::parse($name->created_at)->diffForHumans());
        return $date;
    }
}

function get_buysell_city($produserid){
    $usercity =\App\User::where('id',$produserid)->get();
    foreach ($usercity as $city){
        return $city->city;
    }
}

function get_buysell_country($produserid){
    $usercountry =\App\User::where('id',$produserid)->get();
    foreach ($usercountry as $counttry){
        return $counttry->country;
    }

}

function get_buysell_user_name($produsername){
    $username =\App\User::where('id',$produsername)->get();
    foreach ($username as $name){
        return $name->name;
    }

}

function get_buysell_email($produserid){
    $email =\App\User::where('id',$produserid)->get();
    foreach ($email as $useremail){
        return $useremail->email;
    }

}

function get_buysell_contact_no($prodid){
    $username =\App\User::where('id',$prodid)->get();
    foreach ($username as $nasme){
        return $nasme->registration_phone_no;
    }

}

function get_buysell_created_at($produserid){
    $username =\App\User::select('users.*', 'users.created_at as creation_date')->where('id',$produserid)->get();
    foreach ($username as $name){
        $date=  str_replace('ago', ' ',\Carbon\Carbon::parse($name->created_at)->diffForHumans());
        return $date;
    }

}

function get_product_company($prodid){
    $comp = \App\CompanyProfile::where('id',$prodid)->first();
    if(isset($comp))
        return $comp['company_name'];
}

function get_product_manufacturer_company($prodid){
    $comp = \App\ProductManufacturer::where('product_id',$prodid)->first();
    return $comp['manufacturer_name'];
}

function get_category_slug($catid){
    $comp = \App\Category::where('id',$catid)->first();
    return $comp['slug'];
}

function get_sub_category_slug($subcatid){
    $comp = \App\Subcategory::where('id',$subcatid)->first();
    return $comp['slug'];
}

function get_child_sub_category_slug($childsubcatid){
    $comp = \App\Childsubcategory::where('id',$childsubcatid)->get();

    return (isset($comp[0]))?$comp[0]['slug']:'';
}

function getSubcategorySellProductCount($subcatid){
    $prod = \App\Product::where('product_service_types','Sell')->where('subcategory_id',$subcatid)->count();
    return $prod;
}

function getSubSubcategorySellProductCount($subcatid,$subsubcatid){
    $prod = \App\Product::where('product_service_types','Sell')->where('subcategory_id',$subcatid)->where('childsubcategory_id',$subsubcatid)->count();
    return $prod;
}

function getSubcategoryBuyProductCount($subcatid){
    $prod = \App\Product::where('product_service_types','Buy')->where('subcategory_id',$subcatid)->count();
    return $prod;
}

function getSubSubcategoryBuyProductCount($subcatid,$subsubcatid){
    $prod = \App\Product::where('product_service_types','Buy')->where('subcategory_id',$subcatid)->where('childsubcategory_id',$subsubcatid)->count();
    return $prod;
}

function getSubcategoryServiceProductCount($subcatid){
    $prod = \App\Product::where('product_service_types','Service')->where('subcategory_id',$subcatid)->count();
    return $prod;
}

function getSubcategorySellBuysellCount($subcatid,$subsubcatid){
    $prod = \App\BuySell::where('product_service_types','Sell')->where('date_expire','>', now())->where('subcategory_id',$subcatid)->where('childsubcategory_id',$subsubcatid)->count();
    return $prod;
}

function getSubcategoryBuyBuysellCount($subcatid,$subsubcatid){
    $prod = \App\BuySell::where('product_service_types','Buy')->where('date_expire','>', now())->where('subcategory_id',$subcatid)->where('childsubcategory_id',$subsubcatid)->count();
    return $prod;
}

function getSubcategoryServiceBuysellCount($subcatid){
    $prod = \App\BuySell::where('product_service_types','Service')->where('date_expire','>=', date("d-m-Y"))->where('subcategory_id',$subcatid)->count();
    return $prod;
}

function get_cat_name($catid){
    $comp = \App\Category::where('id',$catid)->first();
    return $comp['name'];
}

function get_subcat_name($subcatid){
    $comp = \App\Subcategory::where('id',$subcatid)->first();
    return $comp['name'];
}

function get_childcat_name($childcatid){
    $comp = \App\Childsubcategory::where('id',$childcatid)->first();
    return $comp['name'];
}
function countInquiries($userId,$companyId)
{
    $products = \App\Product::where('company_id',$companyId)->get()->pluck('id');
    $count_products = \App\Inquiry::whereIn('product_id',$products)->count();
//    $buysell = \App\BuySell::where('user_id',$userId)->get()->pluck('id');
//    $count_buysell = \App\Inquiry::whereIn('buysell_id',$buysell)->count();
//    $total = $count_products + $count_buysell;
    return $count_products;

}
function countInquiriesProduct($companyId)
{
    $products = \App\Product::where('company_id',$companyId)->get()->pluck('id');
    $count_products = \App\Inquiry::whereIn('product_id',$products)->count();
    return $count_products;

}

function countInquiriesBuysell($userId)
{
    $buysell = \App\BuySell::where('user_id',$userId)->get()->pluck('id');
    $count_buysell = \App\Inquiry::whereIn('buysell_id',$buysell)->count();
    return $count_buysell;

}

function getProductViewsCount()
{
    $compid = session()->get('company_id');
    $products = \App\Product::where('company_id',$compid)->latest()->get();
    $products_counts = [];
    $products_name = [];
    $products_fav =[];
    foreach ($products as $product){
        $count = \App\View::where('prod_id',$product->id)->latest()->count();
        $fav = \App\Favourite::where('reference_no',$product->reference_no)->latest()->count();
        if($count > 0  || $fav > 0){
            array_push($products_counts,$count);
            array_push($products_fav,$fav);
            array_push($products_name,$product->product_service_name);
        }
    }
    $data[0] = $products_name;
    $data[1] = $products_counts;
    $data[2] = $products_fav;
    return $data;
}

function getProductViewsCountt()
{
    $compid = session()->get('company_id');
    $products = \App\Product::where('company_id',$compid)->oldest()->get();
    $products_counts = [];
    $products_name = [];
    $products_fav =[];
    foreach ($products as $product){
        $count = \App\View::where('prod_id',$product->id)->oldest()->count();
        $fav = \App\Favourite::where('reference_no',$product->reference_no)->oldest()->count();
        if($count > 0  || $fav > 0){
            array_push($products_counts,$count);
            array_push($products_fav,$fav);
            array_push($products_name,$product->product_service_name);
        }
    }
    $data[0] = $products_name;
    $data[1] = $products_counts;
    $data[2] = $products_fav;
    return $data;
}

function getBuysellViewsCount()
{
    $products = \App\BuySell::where('user_id',auth()->id())->latest()->get();
    $products_counts = [];
    $products_name = [];
    $products_fav =[];
    foreach ($products as $product){
        $count = \App\View::where('buysell_id',$product->id)->latest()->count();
        $fav = \App\Favourite::where('reference_no',$product->reference_no)->latest()->count();
        if($count > 0  || $fav > 0){
            array_push($products_counts,$count);
            array_push($products_fav,$fav);
            array_push($products_name,$product->product_service_name);

        }
    }
    $data[0] = $products_name;
    $data[1] = $products_counts;
    $data[2] = $products_fav;
    return $data;
}

function getBuysellViewsCountt()
{
    $products = \App\BuySell::where('user_id',auth()->id())->oldest()->get();
    $products_counts = [];
    $products_name = [];
    $products_fav =[];
    foreach ($products as $product){
        $count = \App\View::where('buysell_id',$product->id)->oldest()->count();
        $fav = \App\Favourite::where('reference_no',$product->reference_no)->oldest()->count();
        if($count > 0  || $fav > 0){
            array_push($products_counts,$count);
            array_push($products_fav,$fav);
            array_push($products_name,$product->product_service_name);

        }
    }
    $data[0] = $products_name;
    $data[1] = $products_counts;
    $data[2] = $products_fav;
    return $data;
}

function getProductViewsdashboardCount()
{
    $compid = session()->get('company_id');
    $prod = \App\Product::where('company_id',$compid)->get()->pluck('id');
    $products = \App\View::whereIn('prod_id',$prod)->count();

    return $products;
}

function getBuySellViewsdashboardCount()
{
    $user = auth()->id();
    $prod = \App\BuySell::where('user_id',$user)->get()->pluck('id');
    $products = \App\View::whereIn('buysell_id',$prod)->count();

    return $products;
}

function getProductFavCount($compid)
{
    $prod = \App\Product::whereBetween('reference_no', ['100000', '4900000'])->get()->pluck('reference_no');
    $products = \App\Favourite::where('user_id',auth()->id())->whereIn('reference_no',$prod)->count();
    return $products;

}

function getSingleProductFavCount($ref)
{
//    $prod = \App\Product::where('reference_no',$ref)->where('company_id',session()->get('company_id'))->first();
    $products = \App\Favourite::where('reference_no',$ref)->count();
    return $products;

}
function getBuysellFavCount()
{
    $prod = \App\BuySell::whereBetween('reference_no', ['5000000', '10000000'])->get()->pluck('reference_no');
    $products = \App\Favourite::where('user_id',auth()->id())->whereIn('reference_no',$prod)->count();
    return $products;
}
function getSingleBuysellFavCount($ref)
{
    $products = \App\Favourite::where('reference_no',$ref)->count();
    return $products;
}

function getUserFirstCompany()
{
    $firstcomp = \App\CompanyProfile::where('user_id',auth()->id())->oldest()->first();
    return $firstcomp->company_name;
}

function getCompanyMembersCount($comp_id)
{
    $membercompCount = \App\UserCompany::where('company_id',$comp_id)->count();
    return $membercompCount;
}

function getCompanyName($comp_id)
{
    $compname = \App\CompanyProfile::find($comp_id);
    if(isset($compname))
        return $compname['company_name'];
}

function getCompanies($userId)
{
    $company_ids = \App\UserCompany::where('user_id',$userId)->get()->pluck('company_id');
    $companies = \App\CompanyProfile::whereIn('id',$company_ids)->get();
    return $companies;
}

function checkExpiryBuysell($id){
    $today = now();
    $buysell = \App\BuySell::where('id',$id)->first();
    if($today < $buysell->date_expire){

        return 'Expired on '.$buysell->date_expire;
    }elseif($today  > $buysell->date_expire) {

        return 'Expired';
    }
}

function moneyFormat($num) {
    $explrestunits = "" ;
    if(strlen($num)>3) {
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++) {
            // creates each of the 2's group and adds a comma to the end
            if($i==0) {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            } else {
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}

//added by taha for inquiry chat

function get_name($user){
    return ucfirst($user->first_name.' '.$user->last_name);
}

function check_deleted_by_me($convo, $from='deal'){
    if($from=='deal'){
        $delete_convo = \App\BizdealInquiryConvoDelete::where('conversation_id', $convo->id)->where('created_by', \Auth::id())->first();
    }
    elseif($from == 'fav'){
        $delete_convo = \App\BizDealFavConvoDelete::where('conversation_id', $convo->id)->where('created_by', \Auth::id())->first();
    }
    elseif($from == 'fav_lead'){
        $delete_convo = \App\BizLeadFavConvoDelete::where('conversation_id', $convo->id)->where('created_by', \Auth::id())->first();
    }
    else{
        $delete_convo = \App\BizLeadInquiryConvoDelete::where('conversation_id', $convo->id)->where('created_by', \Auth::id())->first();
    }
    if($delete_convo)
        return false;
    else
        return true;
}

function check_in_my_fav($convo, $from='deal'){
    // $fav_convo = \App\BizdealInquiryConvoFav::where('conversation_id', $convo->id)->where('created_by', \Auth::id())->first();
    if($from=='deal'){
        $fav_convo = \App\BizdealInquiryConvoFav::where('conversation_id', $convo->id)->where('created_by', \Auth::id())->first();
    }
    elseif($from == 'fav'){
        $fav_convo = \App\BizDealFavConvoFav::where('conversation_id', $convo->id)->where('created_by', \Auth::id())->first();
    }
    elseif($from == 'fav_lead'){
        $fav_convo = \App\BizLeadFavConvoFav::where('conversation_id', $convo->id)->where('created_by', \Auth::id())->first();
    }
    else{
        $fav_convo = \App\BizLeadInquiryConvoFav::where('conversation_id', $convo->id)->where('created_by', \Auth::id())->first();
    }
    if($fav_convo)
        return false;
    else
        return true;
}

function check_in_my_pin($convo, $from='deal'){
    // $fav_convo = \App\BizdealInquiryConvoPin::where('conversation_id', $convo->id)->where('created_by', \Auth::id())->first();
    if($from=='deal'){
        $fav_convo = \App\BizdealInquiryConvoPin::where('conversation_id', $convo->id)->where('created_by', \Auth::id())->first();
    }
    elseif($from == 'fav'){
        $fav_convo = \App\BizDealFavConvoPin::where('conversation_id', $convo->id)->where('created_by', \Auth::id())->first();
    }
    elseif($from == 'fav_lead'){
        $fav_convo = \App\BizLeadFavConvoPin::where('conversation_id', $convo->id)->where('created_by', \Auth::id())->first();
    }
    else{
        $fav_convo = \App\BizLeadInquiryConvoPin::where('conversation_id', $convo->id)->where('created_by', \Auth::id())->first();
    }
    if($fav_convo)
        return false;
    else
        return true;
}

function count_unread_conversations($from='deal'){
    if($from == 'deal'){
        $inquiries = \App\BizdealInquiryConversation::with('product.user','messages','latestMessage','my_latest_message','latestMessageNotMine')->where(function($q1){
            $q1->whereHas('product', function($query){
                $query->whereHas('user', function($q){
                    $q->where('users.id', \Auth::id());
                });
            })->orWhere('created_by',\Auth::id());
        })->whereHas('latestMessageNotMine', function($q){
            $q->where('bizdeal_inquery_conversation_messages.is_read',0);
        })->count();
    }
    elseif($from == 'fav'){
        $inquiries = \App\BizDealFavConversation::with('product.company','messages','latestMessage','my_latest_message','latestMessageNotMine')->where(function($q1){
            $q1->whereHas('product', function($query){
                $query->whereHas('company', function($q){
                    $q->where('company_profiles.id', \Session::get('company_id'));
                });
            })->orWhere('created_by',\Auth::id());
        })->whereHas('latestMessageNotMine', function($q){
            $q->doesntHave('my_read_messages');
        })->count();
    }
    elseif($from == 'fav_lead'){
        $inquiries = \App\BizLeadFavConversation::with('product.company','messages','latestMessage','my_latest_message','latestMessageNotMine')->where(function($q1){
            $q1->whereHas('product', function($query){
                $query->whereHas('company', function($q){
                    $q->where('company_profiles.id', \Session::get('company_id'));
                });
            })->orWhere('created_by',\Auth::id());
        })->whereHas('latestMessageNotMine', function($q){
            $q->doesntHave('my_read_messages');
        })->count();
    }
    else{
        $inquiries = \App\BizLeadInquiryConversation::with('product.company','messages','latestMessage','my_latest_message','latestMessageNotMine')->where(function($q1){
            $q1->whereHas('product', function($query){
                $query->whereHas('company', function($q){
                    $q->where('company_profiles.id', \Session::get('company_id'));
                });
            })->orWhere('created_by',\Auth::id());
        })->whereHas('latestMessageNotMine', function($q){
            $q->doesntHave('my_read_messages');
        })->count();
    }

    // dd($inquiries);

    return $inquiries;
}


function inquiry_file_uploader($file, $row, $folder)
{
    $filename = $file->getClientOriginalName();
    $extension = $file->getClientOriginalExtension();
    $picture1 = date('His') . $filename;
    $picture = str_replace([' ','?','%','&'], '_', $picture1);
    $destinationPath = 'public/uploaded/' . $folder ;
// $dbPath = $folder . '/dps';
    $file->move($destinationPath, $picture);
    \File::delete($row->file_path);
    $profile_pic = $destinationPath . '/' . $picture;
    return $profile_pic;
}

function check_in_my_read($convo, $msg_id, $from='deal'){
    // $fav_convo = \App\BizdealInquiryConvoPin::where('conversation_id', $convo->id)->where('created_by', \Auth::id())->first();
    if($from=='deal'){
        $fav_convo = \App\BizdealInquiryConvoRead::where('conversation_id', $convo->id)->where('message_id', $msg_id)->where('created_by', \Auth::id())->first();
    }
    elseif($from == 'fav'){
        $fav_convo = \App\BizDealFavConvoRead::where('conversation_id', $convo->id)->where('message_id', $msg_id)->where('created_by', \Auth::id())->first();
    }
    elseif($from == 'fav_lead'){
        $fav_convo = \App\BizLeadFavConvoRead::where('conversation_id', $convo->id)->where('message_id', $msg_id)->where('created_by', \Auth::id())->first();
    }
    else{
        $fav_convo = \App\BizLeadInquiryConvoRead::where('conversation_id', $convo->id)->where('message_id', $msg_id)->where('created_by', \Auth::id())->first();
    }
    if($fav_convo)
        return false;
    else
        return true;
}



//added by taha for inquiry chat

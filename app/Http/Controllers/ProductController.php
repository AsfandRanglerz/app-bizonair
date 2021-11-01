<?php

namespace App\Http\Controllers;

use App\BuysellImage;
use App\CompanyProfile;
use App\Http\Middleware\User;
use App\Product;
use App\Category;
use App\Subcategory;
use App\View;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PragmaRX\Countries\Package\Countries;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $_category;
    private $_subcategory;
    private $_product;

    function __construct(Category $category, Subcategory $subcategory, Product $product)
    {

        $this->_category = $category;
        $this->_product = $product;
        $this->_subcategory = $subcategory;
    }

    public function index(Request $request)
    {
        $user = Auth()->user();
        if ($request->case && $request->case == 'archive') {
            $products = \App\Product::onlyTrashed()->where('company_id', session()->get('company_id'))->orderBy('id', 'desc')->get();
        } else {
            $products = \App\Product::where('company_id', session()->get('company_id'))->orderBy('id', 'desc')->get();
        }
        return view('front_site.bizoffice.products.index', compact('user', 'products', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()){
            $user = \App\User::where('id', \Auth::id())->first();
            $userCompany = \App\UserCompany::where('user_id',$user->id)->where('company_id',session()->get('company_id'))->first();
            return view('front_site.bizoffice.products.create', compact('user','userCompany'));
        }else{
            return view('front_site.other.login');
        }
    }

    public function product_list_by_category($slug)
    {

        $cat = \App\Category::where('slug', $slug)->where('type', 'Business')->first();
        $data['category'] = $cat;
        $geturl = url()->current();
        $urlslug = ucwords(str_replace('-', ' ', basename($geturl)));

        $subcategories = \App\Subcategory::where('category_id', $cat->id)->get();

        $buysell_selling = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->where('date_expire','>', now())->where('product_service_types','Sell')->where('category_id', $cat->id)->whereNull('deleted_at')->orderBy('is_featured','DESC')->latest()->limit(10)->get();

        $buysell_buying = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->where('date_expire','>', now())->where('product_service_types','Buy')->where('category_id', $cat->id)->whereNull('deleted_at')->orderBy('is_featured','DESC')->latest()->limit(10)->get();

        $categories = $this->_category->getAllCompanies();
        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();


        $topsellproduct = \App\Product::select('products.*', 'products.created_at as creation_date')->where('category_id', $cat->id)->where('product_service_types', 'Sell')->with('product_image')->orderBy('is_featured','DESC')->latest()->limit(6)->get();

        $topbuyproduct = \App\Product::select('products.*', 'products.created_at as creation_date')->where('category_id', $cat->id)->where('product_service_types', 'Buy')->with('product_image')->orderBy('is_featured','DESC')->latest()->limit(10)->get();

        $topcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->limit(2)->latest()->get();

//        self logic practice
//        $company_ids = Product::where('category_id', $cat->id)->distinct('company_id')->get()->pluck('company_id');
//        $companies = \App\CompanyProfile::whereIn('id',$company_ids)->get();

        $companies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->get();
        $ads = \App\Banner::where('dimension', 'width 1146 * height 161')->where('description','1st image')->where('page','Textile Business')->where('status', 1)->limit(1)->get();
        $textile_partners = \App\TextilePartner::all();
        return view('front_site.product.product-list-by-category',$data, compact('slug','cats', 'topcompanies', 'companies','topsellproduct', 'topbuyproduct', 'subcategories', 'urlslug', 'categories', 'buysell_selling','buysell_buying','ads','textile_partners'));
    }

    public function product_supplier_list_by_childsubcategory($category, $subcategory, $childsubcategory)
    {
        $cat = \App\Category::where('slug', $category)->where('type', 'Business')->first();
        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();
        $childsubcategory =\App\Childsubcategory::where('slug',$childsubcategory)->where('subcategory_id',$subcatid)->first();
        $prod_city_search = DB::table('products')->where('product_service_types', 'Sell')
            ->where('childsubcategory_id', $childsubcategory->id)->where('subcategory_id', $subcatid)
            ->select('city', DB::raw('count(*) as total'))
            ->groupBy('city')->orderBy('total','desc')->limit(8)
            ->get();

        $data['category'] = $data['sub_category']->category;

        $country = new Countries();
        $data['countries'] = $country->all();

        $products = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types', 'Sell')->where('childsubcategory_id', $childsubcategory->id)->whereNull('deleted_at')->with('product_image')->latest()->get();
        $viewCount = count($products);

        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();

        $topcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->limit(2)->latest()->get();

        return view('front_site.product-by-childsubcategories.product-childsubcategory-supplier',$data, compact('prod_city_search','childsubcategory','topcompanies','category', 'viewCount', 'subcategory', 'products', 'cats'));
    }

    public function product_buyer_list_by_childsubcategory($category, $subcategory,$childsubcategory)
    {
        $cat = \App\Category::where('slug', $category)->where('type', 'Business')->first();
        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();
        $childsubcategory =\App\Childsubcategory::where('slug',$childsubcategory)->where('subcategory_id',$subcatid)->first();
        $prod_city_search = DB::table('products')->where('product_service_types', 'Buy')
            ->where('childsubcategory_id', $childsubcategory->id)->where('subcategory_id', $subcatid)
            ->select('city', DB::raw('count(*) as total'))
            ->groupBy('city')->orderBy('total','desc')->limit(8)
            ->get();
        $data['category'] = $data['sub_category']->category;

        $country = new Countries();
        $data['countries'] = $country->all();

        $products = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types', 'Buy')->where('childsubcategory_id', $childsubcategory->id)->whereNull('deleted_at')->with('product_image')->latest()->get();
        $viewCount = count($products);

        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();

        $topcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->limit(2)->latest()->get();
        return view('front_site.product-by-childsubcategories.product-childsubcategory-buyer',$data, compact('prod_city_search','topcompanies','childsubcategory','category', 'viewCount', 'subcategory', 'products', 'cats'));
    }

    public function one_time_childsubcategory_seller($category, $subcategory,$childsubcategory)
    {
        $cat = \App\Category::where('slug', $category)->where('type', 'Business')->first();
        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();

        $childsubcategory =\App\Childsubcategory::where('slug',$childsubcategory)->where('subcategory_id',$subcatid)->first();
        $prod_city_search = DB::table('buy_sells')->where('subcategory_id',$subcatid)
            ->where('date_expire','>', now())->where('product_service_types','Sell')
            ->where('childsubcategory_id', $childsubcategory->id)
            ->select('city', DB::raw('count(*) as total'))
            ->groupBy('city')->orderBy('total','desc')->limit(8)
            ->get();
        $data['category'] = $data['sub_category']->category;

        $country = new Countries();
        $data['countries'] = $country->all();

        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();

        $buysell_selling = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->where('date_expire','>', now())->where('product_service_types','Sell')->where('childsubcategory_id', $childsubcategory->id)->whereNull('deleted_at')->latest()->get();
        $viewCount = count($buysell_selling);
        $topcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->limit(2)->latest()->get();
        return view('front_site.product-by-childsubcategories.one-time-childsubcategory-seller',$data, compact('prod_city_search','topcompanies','childsubcategory','category', 'subcategory','viewCount', 'cats','buysell_selling'));
    }

    public function one_time_childsubcategory_buyer($category, $subcategory,$childsubcategory)
    {
        $cat = \App\Category::where('slug', $category)->where('type', 'Business')->first();
        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();

        $childsubcategory =\App\Childsubcategory::where('slug',$childsubcategory)->where('subcategory_id',$subcatid)->first();
        $prod_city_search = DB::table('buy_sells')->where('subcategory_id',$subcatid)
            ->where('date_expire','>', now())->where('product_service_types','Buy')
            ->where('childsubcategory_id', $childsubcategory->id)
            ->select('city', DB::raw('count(*) as total'))
            ->groupBy('city')->orderBy('total','desc')->limit(8)
            ->get();
        $data['category'] = $data['sub_category']->category;

        $country = new Countries();
        $data['countries'] = $country->all();

        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();

        $buysell_buying = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->where('date_expire','>=', now())->where('product_service_types','Buy')->where('childsubcategory_id', $childsubcategory->id)->whereNull('deleted_at')->latest()->get();
        $viewCount = count($buysell_buying);
        $topcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->limit(2)->latest()->get();
        return view('front_site.product-by-childsubcategories.one-time-childsubcategory-buyer',$data, compact('prod_city_search','topcompanies','childsubcategory','category', 'subcategory', 'viewCount', 'cats','buysell_buying'));
    }

    public function product_search_supplier(Request $request,$category, $subcategory,$childsubcategory)
    {
        $subcatid = \App\Subcategory::where('slug', $subcategory)->pluck('id');
        $catid = \App\Subcategory::where('slug', $subcategory)->pluck('category_id');
        $childsubcategory =\App\Childsubcategory::where('slug',$childsubcategory)->where('subcategory_id',$subcatid)->first();
        $category = \App\Category::where('id', $catid)->first();

        $prod_city_search = DB::table('products')->where('product_service_types', 'Sell')
            ->where('childsubcategory_id', $childsubcategory->id)->where('subcategory_id', $subcatid)
            ->select('city', DB::raw('count(*) as total'))
            ->groupBy('city')->orderBy('total','desc')->limit(8)
            ->get();

        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();

        $country = new Countries();
        $data['countries'] = $country->all();

        $products = \App\Product::select('products.*', 'products.created_at as creation_date')
            ->where('product_service_types', 'Sell')->where('childsubcategory_id', $childsubcategory->id)->where('subcategory_id', $subcatid)
            ->where('city',$request->city)->get();
        $viewCount = count($products);
        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();
        return view('front_site.product-by-childsubcategories.product-search-childsubcat-supplier', $data,compact('viewCount','prod_city_search','childsubcategory', 'category', 'subcategory', 'products', 'cats'));
    }

    public function product_search_buyer(Request $request, $category, $subcategory,$childsubcategory)
    {
        $subcatid = \App\Subcategory::where('slug', $subcategory)->pluck('id');
        $catid = \App\Subcategory::where('slug', $subcategory)->pluck('category_id');
        $childsubcategory =\App\Childsubcategory::where('slug',$childsubcategory)->where('subcategory_id',$subcatid)->first();
        $category = \App\Category::where('id', $catid)->first();

        $prod_city_search = DB::table('products')->where('product_service_types', 'Buy')
            ->where('childsubcategory_id', $childsubcategory->id)->where('subcategory_id', $subcatid)
            ->select('city', DB::raw('count(*) as total'))
            ->groupBy('city')->orderBy('total','desc')->limit(8)
            ->get();

        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();

        $country = new Countries();
        $data['countries'] = $country->all();

        $products = \App\Product::select('products.*', 'products.created_at as creation_date')
            ->where('product_service_types', 'Buy')->where('childsubcategory_id', $childsubcategory->id)->where('subcategory_id', $subcatid)
            ->where('city',$request->city)->get();

        $viewCount = count($products);
        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();
        return view('front_site.product-by-childsubcategories.product-search-childsubcat-buyer', $data,compact('viewCount','prod_city_search', 'childsubcategory','category', 'subcategory', 'products', 'cats'));
    }

    public function product_one_time_search_supplier(Request $request,$category, $subcategory,$childsubcategory)
    {
        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();

        $country = new Countries();
        $data['countries'] = $country->all();
        $childsubcategory =\App\Childsubcategory::where('slug',$childsubcategory)->where('subcategory_id',$subcatid)->first();
        $prod_city_search = DB::table('buy_sells')->where('product_service_types', 'Sell')
            ->where('subcategory_id',$subcatid)->where('date_expire','>', now())
            ->where('childsubcategory_id', $childsubcategory->id)
            ->select('city', DB::raw('count(*) as total'))
            ->groupBy('city')->orderBy('total','desc')->limit(8)
            ->get();

        $subcatid = \App\Subcategory::where('slug', $subcategory)->pluck('id');
        $catid = \App\Subcategory::where('slug', $subcategory)->pluck('category_id');
        $category = \App\Category::where('id', $catid)->first();
        $products = \App\BuySell::select('buy_sells.*', 'buy_sells.created_at as creation_date')
            ->where('product_service_types', 'Sell')->where('childsubcategory_id', $childsubcategory->id)->where('subcategory_id', $subcatid)->where('date_expire','>', now())
            ->where('city',$request->city)->whereNull('deleted_at')->get();
        $viewCount = count($products);
        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();
        return view('front_site.product-by-childsubcategories.product-search-childsubcat-one-time-supplier', $data, compact('viewCount', 'prod_city_search','childsubcategory','category', 'subcategory', 'products', 'cats'));
    }

    public function product_one_time_search_buyer(Request $request, $category, $subcategory,$childsubcategory)
    {
        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();

        $country = new Countries();
        $data['countries'] = $country->all();
        $childsubcategory =\App\Childsubcategory::where('slug',$childsubcategory)->where('subcategory_id',$subcatid)->first();
        $prod_city_search = DB::table('buy_sells')->where('product_service_types', 'Buy')
            ->where('subcategory_id',$subcatid)->where('date_expire','>', now())
            ->where('childsubcategory_id', $childsubcategory->id)
            ->select('city', DB::raw('count(*) as total'))
            ->groupBy('city')->orderBy('total','desc')->limit(8)
            ->get();

        $subcatid = \App\Subcategory::where('slug', $subcategory)->pluck('id');
        $catid = \App\Subcategory::where('slug', $subcategory)->pluck('category_id');
        $category = \App\Category::where('id', $catid)->first();
        $products = \App\BuySell::select('buy_sells.*', 'buy_sells.created_at as creation_date')
            ->where('product_service_types', 'Buy')->where('childsubcategory_id', $childsubcategory->id)->where('subcategory_id', $subcatid)->where('date_expire','>', now())
            ->where('city',$request->city)->whereNull('deleted_at')->get();

        $viewCount = count($products);
        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();
        return view('front_site.product-by-childsubcategories.product-search-childsubcat-one-time-buyer', $data,compact('viewCount', 'prod_city_search','childsubcategory','category', 'subcategory', 'products', 'cats'));
    }

    public function view_all_regular_supplier_by_category($slug)
    {

        $cat = \App\Category::where('slug', $slug)->where('type', 'Business')->first();
        $data['category'] = $cat;
        $geturl = url()->current();
        $urlslug = ucwords(str_replace('-', ' ', basename($geturl)));

        $subcategories = \App\Subcategory::where('category_id', $cat->id)->get();

        $categories = $this->_category->getAllCompanies();
        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();
        if(str_contains(url()->full(), '?status=all')){
            $toptensellproduct = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types','!=','Service')->with('product_image')->whereNull('deleted_at')->orderBy('is_featured','DESC')->latest()->limit(6)->get();
            $top_6 = array_unique(\Arr::pluck($toptensellproduct,'id'));
            $topsellproduct = \App\Product::select('products.*', 'products.created_at as creation_date')->whereNotIn('id',$top_6)->where('product_service_types','!=','Service')->with('product_image')->whereNull('deleted_at')->get();
        }else{
            $toptensellproduct = \App\Product::select('products.*', 'products.created_at as creation_date')->where('category_id', $cat->id)->where('product_service_types', 'Sell')->with('product_image')->whereNull('deleted_at')->orderBy('is_featured','DESC')->latest()->limit(6)->get();
            $top_6 = array_unique(\Arr::pluck($toptensellproduct,'id'));
            $topsellproduct = \App\Product::select('products.*', 'products.created_at as creation_date')->where('category_id', $cat->id)->whereNotIn('id',$top_6)->where('product_service_types', 'Sell')->with('product_image')->whereNull('deleted_at')->get();
        }
        $topcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->limit(2)->latest()->get();

//        $company_ids = Product::where('category_id', $cat->id)->distinct('company_id')->get()->pluck('company_id');
//        $companies = \App\CompanyProfile::whereIn('id',$company_ids)->get();
        $companies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->get();
        $textile_partners = \App\TextilePartner::all();
        return view('front_site.view-all.view-all-regular-supplier',$data, compact('textile_partners','companies','topcompanies','cats',  'topsellproduct', 'toptensellproduct', 'subcategories', 'urlslug', 'categories'));
    }

    public function view_all_regular_buyer_by_category($slug)
    {

        $cat = \App\Category::where('slug', $slug)->where('type', 'Business')->first();
        $data['category'] = $cat;
        $geturl = url()->current();
        $urlslug = ucwords(str_replace('-', ' ', basename($geturl)));

        $subcategories = \App\Subcategory::where('category_id', $cat->id)->get();

        $categories = $this->_category->getAllCompanies();
        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();



        $toptenbuyproduct = \App\Product::select('products.*', 'products.created_at as creation_date')->where('category_id', $cat->id)->where('product_service_types', 'Buy')->with('product_image')->whereNull('deleted_at')->orderBy('is_featured','DESC')->latest()->limit(6)->get();
        $top_6 = array_unique(\Arr::pluck($toptenbuyproduct,'id'));
        $topbuyproduct = \App\Product::select('products.*', 'products.created_at as creation_date')->where('category_id', $cat->id)->whereNotIn('id',$top_6)->where('product_service_types', 'Buy')->with('product_image')->whereNull('deleted_at')->get();

        $topcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->limit(2)->latest()->get();

//        $company_ids = Product::where('category_id', $cat->id)->distinct('company_id')->get()->pluck('company_id');
//        $companies = \App\CompanyProfile::whereIn('id',$company_ids)->get();
        $companies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->get();
        $textile_partners = \App\TextilePartner::all();
        return view('front_site.view-all.view-all-regular-buyer',$data, compact('textile_partners','companies','topcompanies','cats',  'topbuyproduct', 'toptenbuyproduct', 'subcategories', 'urlslug', 'categories'));
    }

    public function view_all_one_time_selling_deals($slug)
    {

        $cat = \App\Category::where('slug', $slug)->where('type', 'Business')->first();
        $data['category'] = $cat;
        $geturl = url()->current();
        $urlslug = ucwords(str_replace('-', ' ', basename($geturl)));
        $subcategories = \App\Subcategory::where('category_id', $cat->id)->get();
        $categories = $this->_category->getAllCompanies();
        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();
        if(str_contains(url()->full(), '?status=all')){
            $buyselltopten_selling = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->where('date_expire','>', now())->where('product_service_types','!=','Service')->whereNull('deleted_at')->orderBy('is_featured','DESC')->latest()->limit(6)->get();
            $top_6 = array_unique(\Arr::pluck($buyselltopten_selling,'id'));
            $buysell_selling = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->whereNotIn('id',$top_6)->where('date_expire','>', now())->where('product_service_types','!=','Service')->whereNull('deleted_at')->get();
        }else{
            $buyselltopten_selling = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->where('date_expire','>', now())->where('product_service_types','Sell')->where('category_id', $cat->id)->whereNull('deleted_at')->orderBy('is_featured','DESC')->latest()->limit(6)->get();
            $top_6 = array_unique(\Arr::pluck($buyselltopten_selling,'id'));
            $buysell_selling = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->whereNotIn('id',$top_6)->where('date_expire','>', now())->where('product_service_types','Sell')->where('category_id', $cat->id)->whereNull('deleted_at')->get();
        }
        $topcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->limit(2)->latest()->get();

//        $company_ids = Product::where('category_id', $cat->id)->distinct('company_id')->get()->pluck('company_id');
//        $companies = \App\CompanyProfile::whereIn('id',$company_ids)->get();
        $companies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->get();
        $textile_partners = \App\TextilePartner::all();
        return view('front_site.view-all.view-all-one-time-selling-deals',$data, compact('textile_partners','companies','topcompanies','cats','buyselltopten_selling', 'buysell_selling', 'subcategories', 'urlslug', 'categories'));
    }

    public function view_all_one_time_buying_deals($slug)
    {
        $cat = \App\Category::where('slug', $slug)->where('type', 'Business')->first();
        $data['category'] = $cat;
        $geturl = url()->current();
        $urlslug = ucwords(str_replace('-', ' ', basename($geturl)));
        $subcategories = \App\Subcategory::where('category_id', $cat->id)->get();
        $categories = $this->_category->getAllCompanies();
        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();

        $buyselltopten_buying = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->where('date_expire','>', now())->where('product_service_types','Buy')->where('category_id', $cat->id)->whereNull('deleted_at')->orderBy('is_featured','DESC')->latest()->limit(6)->get();
        $top_6 = array_unique(\Arr::pluck($buyselltopten_buying,'id'));
        $buysell_buying = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->whereNotIn('id',$top_6)->where('date_expire','>', now())->where('product_service_types','Buy')->where('category_id', $cat->id)->whereNull('deleted_at')->get();

        $topcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->limit(2)->latest()->get();

//        $company_ids = Product::where('category_id', $cat->id)->distinct('company_id')->get()->pluck('company_id');
//        $companies = \App\CompanyProfile::whereIn('id',$company_ids)->get();
        $companies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->get();
        $textile_partners = \App\TextilePartner::all();
        return view('front_site.view-all.view-all-one-time-buying-deals',$data, compact('textile_partners','companies','topcompanies','cats','buyselltopten_buying', 'buysell_buying', 'subcategories', 'urlslug', 'categories'));
    }

    public function product_supplier_list_by_subcategory($category, $subcategory)
    {
        $cat = \App\Category::where('slug', $category)->where('type', 'Business')->first();
        $prod_city_search = DB::table('products')->where('product_service_types', 'Sell')
            ->select('city', DB::raw('count(*) as total'))
            ->whereNull('deleted_at')
            ->groupBy('city')->orderBy('total','desc')->limit(8)
            ->get();

        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();

        $data['category'] = $data['sub_category']->category;

        $country = new Countries();
        $data['countries'] = $country->all();

        $products = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types', 'Sell')->where('subcategory_id', $subcatid)->with('product_image')->whereNull('deleted_at')->latest()->get();
        $viewCount = count($products);

        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();

        $buysell_selling = \DB::table('buy_sells')->where('product_service_types','Buy')->where('subcategory_id', $subcatid)->whereNull('deleted_at')->latest()->get();

        $topcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->limit(2)->latest()->get();

        return view('front_site.product-by-subcategories.product-list-by-subcategory-supplier',$data, compact('prod_city_search','topcompanies','category', 'viewCount', 'subcategory', 'products', 'cats','buysell_selling'));
    }

    public function product_buyer_list_by_subcategory($category, $subcategory)
    {
        $cat = \App\Category::where('slug', $category)->where('type', 'Business')->first();
        $prod_city_search = DB::table('products')->where('product_service_types', 'Buy')
            ->select('city', DB::raw('count(*) as total'))
            ->whereNull('deleted_at')
            ->groupBy('city')->orderBy('total','desc')->limit(8)
            ->get();
        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();
        $data['category'] = $data['sub_category']->category;

        $country = new Countries();
        $data['countries'] = $country->all();

        $products = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types', 'Buy')->where('subcategory_id', $subcatid)->with('product_image')->whereNull('deleted_at')->latest()->get();
        $viewCount = count($products);

        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();

        $buysell_buying = \DB::table('buy_sells')->where('product_service_types','Sell')->where('subcategory_id', $subcatid)->whereNull('deleted_at')->latest()->get();

        $topcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->limit(2)->latest()->get();
        return view('front_site.product-by-subcategories.product-list-by-subcategory-buyer',$data, compact('prod_city_search','topcompanies','category', 'viewCount', 'subcategory', 'products', 'cats','buysell_buying'));
    }

    public function one_time_seller($category, $subcategory)
    {
        $cat = \App\Category::where('slug', $category)->where('type', 'Business')->first();
        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();

        $prod_city_search = DB::table('buy_sells')->where('subcategory_id',$subcatid)->where('date_expire','>', now())->where('product_service_types','Sell')
            ->select('city', DB::raw('count(*) as total'))
            ->whereNull('deleted_at')
            ->groupBy('city')->orderBy('total','desc')->limit(8)
            ->get();

        $data['category'] = $data['sub_category']->category;

        $country = new Countries();
        $data['countries'] = $country->all();

        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();

        $buysell_selling = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->where('date_expire','>', now())->where('product_service_types','Sell')->where('subcategory_id', $subcatid)->whereNull('deleted_at')->latest()->get();
        $viewCount = count($buysell_selling);
        $topcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->limit(2)->latest()->get();
        return view('front_site.product-by-subcategories.one-time-seller',$data, compact('prod_city_search','topcompanies','category', 'subcategory','viewCount', 'cats','buysell_selling'));
    }

    public function one_time_buyer($category, $subcategory)
    {
        $cat = \App\Category::where('slug', $category)->where('type', 'Business')->first();
        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();

        $prod_city_search = DB::table('buy_sells')->where('subcategory_id',$subcatid)->where('date_expire','>', now())->where('product_service_types','Buy')
            ->select('city', DB::raw('count(*) as total'))
            ->whereNull('deleted_at')
            ->groupBy('city')->orderBy('total','desc')->limit(8)
            ->get();

        $data['category'] = $data['sub_category']->category;

        $country = new Countries();
        $data['countries'] = $country->all();

        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();

        $buysell_buying = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->where('date_expire','>=', now())->where('product_service_types','Buy')->where('subcategory_id', $subcatid)->whereNull('deleted_at')->latest()->get();
        $viewCount = count($buysell_buying);
        $topcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->limit(2)->latest()->get();
        return view('front_site.product-by-subcategories.one-time-buyer',$data, compact('prod_city_search','topcompanies','category', 'subcategory', 'viewCount', 'cats','buysell_buying'));
    }

    public function search_supplier(Request $request,$category, $subcategory)
    {
        $subcatid = \App\Subcategory::where('slug', $subcategory)->pluck('id');
        $catid = \App\Subcategory::where('slug', $subcategory)->pluck('category_id');
        $category = \App\Category::where('id', $catid)->first();

        $prod_city_search = DB::table('products')->where('product_service_types', 'Sell')->where('subcategory_id',$subcatid)
            ->select('city', DB::raw('count(*) as total'))
            ->whereNull('deleted_at')
            ->groupBy('city')->orderBy('total','desc')->limit(8)
            ->get();

        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();

        $country = new Countries();
        $data['countries'] = $country->all();

        $products = \App\Product::select('products.*', 'products.created_at as creation_date')
            ->where('product_service_types', 'Sell')->where('subcategory_id', $subcatid)
            ->whereNull('deleted_at')
            ->where('city',$request->city)->get();
        $viewCount = count($products);
        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();
        return view('front_site.product.product-search-supplier', $data,compact('viewCount','prod_city_search', 'category', 'subcategory', 'products', 'cats'));
    }

    public function search_buyer(Request $request, $category, $subcategory)
    {
        $subcatid = \App\Subcategory::where('slug', $subcategory)->pluck('id');
        $catid = \App\Subcategory::where('slug', $subcategory)->pluck('category_id');
        $category = \App\Category::where('id', $catid)->first();

        $prod_city_search = DB::table('products')->where('product_service_types', 'Buy')->where('subcategory_id',$subcatid)
            ->select('city', DB::raw('count(*) as total'))
            ->whereNull('deleted_at')
            ->groupBy('city')->orderBy('total','desc')->limit(8)
            ->get();

        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();

        $country = new Countries();
        $data['countries'] = $country->all();

        $products = \App\Product::select('products.*', 'products.created_at as creation_date')
            ->where('product_service_types', 'Buy')->where('subcategory_id', $subcatid)
            ->whereNull('deleted_at')
            ->where('city',$request->city)->get();

        $viewCount = count($products);
        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();
        return view('front_site.product.product-search-buyer', $data,compact('viewCount','prod_city_search', 'category', 'subcategory', 'products', 'cats'));
    }

    public function one_time_search_supplier(Request $request,$category, $subcategory)
    {
        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();

        $country = new Countries();
        $data['countries'] = $country->all();

        $prod_city_search = DB::table('buy_sells')->where('product_service_types', 'Sell')->where('subcategory_id',$subcatid)->where('date_expire','>', now())
            ->select('city', DB::raw('count(*) as total'))
            ->whereNull('deleted_at')
            ->groupBy('city')->orderBy('total','desc')->limit(8)
            ->get();

        $subcatid = \App\Subcategory::where('slug', $subcategory)->pluck('id');
        $catid = \App\Subcategory::where('slug', $subcategory)->pluck('category_id');
        $category = \App\Category::where('id', $catid)->first();
        $products = \App\BuySell::select('buy_sells.*', 'buy_sells.created_at as creation_date')
            ->where('product_service_types', 'Sell')->where('subcategory_id', $subcatid)->where('date_expire','>', now())
            ->where('city',$request->city)->whereNull('deleted_at')->get();
        $viewCount = count($products);
        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();
        return view('front_site.product.product-search-one-time-supplier', $data, compact('viewCount', 'prod_city_search','category', 'subcategory', 'products', 'cats'));
    }

    public function one_time_search_buyer(Request $request, $category, $subcategory)
    {
        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();

        $country = new Countries();
        $data['countries'] = $country->all();

        $prod_city_search = DB::table('buy_sells')->where('product_service_types', 'Buy')->where('subcategory_id',$subcatid)->where('date_expire','>', now())
            ->select('city', DB::raw('count(*) as total'))
            ->whereNull('deleted_at')
            ->groupBy('city')->orderBy('total','desc')->limit(8)
            ->get();

        $subcatid = \App\Subcategory::where('slug', $subcategory)->pluck('id');
        $catid = \App\Subcategory::where('slug', $subcategory)->pluck('category_id');
        $category = \App\Category::where('id', $catid)->first();
        $products = \App\BuySell::select('buy_sells.*', 'buy_sells.created_at as creation_date')
            ->where('product_service_types', 'Buy')->where('subcategory_id', $subcatid)->where('date_expire','>', now())
            ->where('city',$request->city)->whereNull('deleted_at')->get();

        $viewCount = count($products);
        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();
        return view('front_site.product.product-search-one-time-buyer', $data,compact('viewCount', 'prod_city_search','category', 'subcategory', 'products', 'cats'));
    }

    public function other_product_from_this_supplier($subcategory, $id)
    {
        $subcatid = \App\Subcategory::where('slug', $subcategory)->pluck('id');

        $category_id = \App\Subcategory::where('slug', $subcategory)->pluck('category_id');
        $category = \App\Category::where('id', $category_id)->first();

        $products = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types', 'Sell')->where('company_id', $id)->with('product_image')->whereNull('deleted_at')->latest()->paginate(6);
        $viewCount = count($products);

        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();

        return view('front_site.product.other-product-supplier', compact('category', 'viewCount', 'subcategory', 'products', 'cats'));
    }
    public function similar_product_from_this_supplier($category, $subcategory, $comp_id)
    {

        $subcatid = \App\Subcategory::where('slug', $subcategory)->pluck('id');

        $category_id = \App\Subcategory::where('slug', $subcategory)->pluck('category_id');
        $category = \App\Category::where('id', $category_id)->first();

        $data['sub_category'] =\App\Subcategory::where('slug', $subcategory)->first();

        $country = new Countries();
        $data['countries'] = $country->all();

        $products = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types', 'Sell')->where('subcategory_id',$subcatid)->where('company_id', $comp_id)->with('product_image')->whereNull('deleted_at')->latest()->paginate(6);
        $viewCount = count($products);

        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();

        return view('front_site.product.similar-product-supplier',$data, compact('category', 'viewCount', 'subcategory', 'products', 'cats'));
    }

    public function similar_product_buyer_from_this_supplier($category, $subcategory, $comp_id)
    {
        $subcatid = \App\Subcategory::where('slug', $subcategory)->pluck('id');

        $category_id = \App\Subcategory::where('slug', $subcategory)->pluck('category_id');
        $category = \App\Category::where('id', $category_id)->first();
        $data['sub_category'] =\App\Subcategory::where('slug', $subcategory)->first();

        $country = new Countries();
        $data['countries'] = $country->all();

        $products = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types', 'Buy')->where('subcategory_id',$subcatid)->where('company_id', $comp_id)->with('product_image')->whereNull('deleted_at')->latest()->paginate(6);
        $viewCount = count($products);

        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();

        return view('front_site.product.similar-product-buyer', $data, compact('category', 'viewCount', 'subcategory', 'products', 'cats'));
    }

    public function compareProducts($category)
    {
        $reference = DB::table('compares')->get()->pluck('reference_no');
        $viewproduct = \App\Product::select('products.*', 'products.created_at as creation_date')->whereIn('reference_no',$reference)->with('product_image')->whereNull('deleted_at')->latest()->take(3)->get();
        $country = new Countries();
        $countries = $country->all();
        $viewbuysell = \App\BuySell::select('buy_sells.*', 'buy_sells.created_at as creation_date')->whereIn('reference_no',$reference)->whereNull('deleted_at')->latest()->where('date_expire','>', now())->take(3)->get();
        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();
        return view('front_site.product.compare-products', compact('cats', 'viewproduct','viewbuysell','countries','category'));
    }

    public function add_to_compare(Request $request)
    {

        DB::table('compares')->delete();
        if(sizeof(request('ref')) <=3){
            foreach(request('ref') as $reference_no) {
                $compare = new \App\Compare();
                $compare->reference_no = $reference_no;
                if(auth()->check()){
                    $compare->user_id = auth()->id();
                }
                $compare->save();
            }
            $response = 'success';
            return response()->json(['response' => $response, 'status' => 'success']);
        }else{
            $response = 'error';
            return response()->json(['response' => $response, 'status' => 'error']);
        }
    }

    public function delete_compare($reference_no)
    {

        DB::delete('delete from compares where reference_no = ?', [$reference_no]);

        return response()->json(['response' => 'success', 'status' => 'success']);
    }

    public function delete_all_compare()
    {
        DB::table('compares')->delete();

        return response()->json(['response' => 'success', 'status' => 'success']);
    }

    public function getSpecificCategoryProduct($id)
    {
        $name = $this->_category->getCategoryName($id);
        $products = $this->_product->getSpecificCategoryProduct($name);
        dd($products);
    }

    public function getSpecificSubCategoryProduct($id)
    {

        $name = $this->_subcategory->getSubCategoryName($id);
        $products = $this->_product->getSpecificSubCategoryProduct($name);
        dd($products);
    }

    public function productDetail($category, $subcategory ,$slug)
    {
        # code...
        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();
        $data['category'] = $data['sub_category']->category;

        // $product = $this->_product->getProduct($id)->with('product_image');
        $product = \App\Product::where('slug', $slug)->with('product_image')->with('product_manufacturer')->withTrashed()->first();

        $view = new View();
        $view->prod_id= $product->id;
        $view->type = 'Lead';
        $view->ip= \Request::getClientIp();
        $view->save();

        $country = new Countries();
        $data['countries'] = $country->all();

        $osdts = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types', 'Sell')->where('company_id', $product->company_id)->with('product_image')->whereNull('deleted_at')->where('id','!=',$product->id)->latest()->paginate(15);

        $ssdos = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types', 'Sell')->where('subcategory_id',$product->subcategory_id)->where('company_id', '!=', $product->company_id)->with('product_image')->whereNull('deleted_at')->where('id','!=',$product->id)->latest()->paginate(15);

        $sdfc = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types', 'Sell')->where('subcategory_id',$product->subcategory_id)->where('origin', $product->origin)->with('product_image')->whereNull('deleted_at')->where('id','!=',$product->id)->latest()->paginate(15);

        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();
        $ads = \App\Banner::where('dimension', 'width 295 * height 295')->where('description','1st row right sidebar')->where('page','Textile Business Detail')->where('status', 1)->limit(1)->get();
        $ads1 = \App\Banner::where('dimension', 'width 295 * height 295')->where('description','2nd row right sidebar')->where('page','Textile Business Detail')->where('status', 1)->limit(1)->get();
        return view('front_site.product.product-detail',$data, compact('category','subcategory','slug','cats', 'product', 'osdts', 'ssdos','sdfc','ads','ads1'));
    }

    public function buysellDetail($category, $subcategory ,$slug)
    {

        # code...
        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();
        $data['category'] = $data['sub_category']->category;
        // $product = $this->_product->getProduct($id)->with('product_image');
        $product = \App\BuySell::where('slug', $slug)->first();
        $view = new View();
        $view->buysell_id= $product->id;
        $view->type = 'Deal';
        $view->ip= \Request::getClientIp();
        $view->save();

        $country = new Countries();
        $data['countries'] = $country->all();

        $osdts = \App\BuySell::select('buy_sells.*', 'buy_sells.created_at as creation_date')->where('product_service_types', 'Sell')->where('date_expire','>', now())->where('user_id', $product->user_id)->whereNull('deleted_at')->where('id','!=',$product->id)->latest()->paginate(15);

        $ssdos = \App\BuySell::select('buy_sells.*', 'buy_sells.created_at as creation_date')->where('product_service_types', 'Sell')->where('date_expire','>', now())->where('subcategory_id',$product->subcategory_id)->where('user_id', '!=', $product->user_id)->whereNull('deleted_at')->where('id','!=',$product->id)->latest()->paginate(15);

        $sdfc = \App\BuySell::select('buy_sells.*', 'buy_sells.created_at as creation_date')->where('product_service_types', 'Sell')->where('date_expire','>', now())->where('subcategory_id',$product->subcategory_id)->where('origin', $product->origin)->latest()->whereNull('deleted_at')->where('id','!=',$product->id)->paginate(15);

        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();
        $ads = \App\Banner::where('dimension', 'width 295 * height 295')->where('description','1st row right sidebar')->where('page','Textile Business Detail')->where('status', 1)->limit(1)->get();
        $ads1 = \App\Banner::where('dimension', 'width 295 * height 295')->where('description','2nd row right sidebar')->where('page','Textile Business Detail')->where('status', 1)->limit(1)->get();
        return view('front_site.product.buysell-detail',$data, compact('category','subcategory','slug','cats', 'product', 'osdts', 'ssdos','sdfc','ads','ads1'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->all());

        $rules = [
            'product_service_types' => 'required', 'category' => 'required', 'sub_category' => 'required',
            'subject' => 'required',
            'product_service_name' => 'required',
        ];
        $messages = [
            'product_service_types.required' => 'Please select product and service type',
            'category.required' => 'Please select a category',
            'sub_category.required' => 'Please select a sub-category',
            'sub_sub_category.required' => 'Please select a child-sub-category',
            'subject.required' => 'Subject is required',
            'product_service_name.required' => 'Name is required',
        ];
        if ($request->product_service_types != null) {
            if (count($request->product_service_types) == 1) {
                if (in_array("Service", $request->product_service_types)) {
//                    $rules['service_types'] = 'required';
//                    $rules['textile_service_types'] = 'required';
                    $rules['service_durations'] = 'required';
                    $rules['suitable_currencies'] = 'required';
                    $rules['payment_terms'] = 'required';
//                    $messages['service_types.required'] = 'Please select service types';
//                    $messages['textile_service_types.required'] = 'Please select textile service types';
                    $messages['service_durations.required'] = 'Please select service durations';
                    $messages['suitable_currencies.required'] = 'Please select suitable currencies';
                    $messages['payment_terms.required'] = 'Please select payment terms';
                    if ($request->dealing_as != null && in_array("Other", $request->dealing_as)) {
                        $rules['other_dealing_as'] = 'required';
                        $messages['other_dealing_as.required'] = 'Please select dealing type';
                    }
                } else if (!in_array("Buy", $request->product_service_types)) {
                    $rules['dealing_as'] = 'required';
                    $rules['focused_selling_countries'] = 'required';
                    $rules['suitable_currencies'] = 'required';
                    $rules['payment_terms'] = 'required';
                    $messages['dealing_as.required'] = 'Please select dealing type';
                    $messages['focused_selling_countries.required'] = 'Please select focused selling countries';
                    $messages['suitable_currencies.required'] = 'Please select suitable currencies';
                    $messages['payment_terms.required'] = 'Please select payment terms';
                    if ($request->dealing_as != null && in_array("Other", $request->dealing_as)) {
                        $rules['other_dealing_as'] = 'required';
                        $messages['other_dealing_as.required'] = 'Please select dealing type';
                    }
                }
                if (!in_array('Service', $request->product_service_types)) {
                    $rules['sub_sub_category'] = 'required';
                }
            } else {
                $rules['dealing_as'] = 'required';
                $rules['focused_selling_countries'] = 'required';
                $rules['suitable_currencies'] = 'required';
                $rules['payment_terms'] = 'required';
                $messages['dealing_as.required'] = 'Please select dealing type';
                $messages['focused_selling_countries.required'] = 'Please select focused selling countries';
                $messages['suitable_currencies.required'] = 'Please select suitable currencies';
                $messages['payment_terms.required'] = 'Please select payment terms';
                if ($request->dealing_as != null && in_array("Other", $request->dealing_as)) {
                    $rules['other_dealing_as'] = 'required';
                    $messages['other_dealing_as.required'] = 'Please select dealing type';
                }
            }
            if (in_array("Sell", $request->product_service_types)) {
                $rules['sub_sub_category'] = 'required';
                $rules['product_availability'] = 'required';
                $rules['manufacturer_name'] = 'required';
                $rules['origin'] = 'required';
                $messages['product_availability.required'] = 'Please select product availability';
                $messages['manufacturer_name.required'] = 'Manufacturer name is required';
                $messages['origin.required'] = 'Please select origin';
            }
        }
        $new_category = '';
        $new_sub_category = '';
        if ($request->category) {
            $new_category = \App\Category::find($request->category)->name;
        }
        if ($request->sub_category) {
            $new_sub_category = \App\Subcategory::find($request->sub_category)->name;
        }
        if ($new_category == "Fibers & Materials") {
            if ($request->product_service_types != null && count($request->product_service_types) == 1) {
                if (!in_array("Buy", $request->product_service_types)) {
                    if ($request->after_sales_service == "Yes") {
                        $rules['service_type'] = 'required';
                        $messages['service_type.required'] = 'Type of service is required';
                    }
                    if ($request->warranty == "Yes") {
                        $rules['warranty_period'] = 'required';
                        $messages['warranty_period.required'] = 'Warranty period is required';
                    }
                    if ($request->certification == "Yes") {
                        $rules['certification_details'] = 'required';
                        $messages['certification_details.required'] = 'Certification details is required';
                    }
                }
            } else {
                if ($request->after_sales_service == "Yes") {
                    $rules['service_type'] = 'required';
                    $messages['service_type.required'] = 'Type of service is required';
                }
                if ($request->warranty == "Yes") {
                    $rules['warranty_period'] = 'required';
                    $messages['warranty_period.required'] = 'Warranty period is required';
                }
                if ($request->certification == "Yes") {
                    $rules['certification_details'] = 'required';
                    $messages['certification_details.required'] = 'Certification details is required';
                }
            }
        }
        if ($new_category == "Fibers & Materials" && $new_sub_category == "Knitted Fabric" && $request->product_service_types != null) {
            if (count($request->product_service_types) == 1) {
                if (!in_array("Buy", $request->product_service_types)) {
                    $rules['knitted_fabric_types'] = 'required';
                    $rules['knitted_knitting_types'] = 'required';
                    $rules['knitted_fabric_construction'] = 'required';
                    $rules['knitted_gsm_thickness'] = 'required';
                    $rules['knitted_width_from'] = 'required';
                    $rules['knitted_width_to'] = 'required';
                    $rules['knitted_manufact'] = 'required';
                    $rules['knitted_yarn'] = 'required';
                    $rules['knitted_features'] = 'required';
                    $rules['knitted_use'] = 'required';
                    $messages['knitted_fabric_types.required'] = 'Please select knitted fabrictype';
                    $messages['knitted_knitting_types.required'] = 'Please select knitted knitting type';
                    $messages['knitted_fabric_construction.required'] = 'Please select knitted fabric construction';
                    $messages['knitted_gsm_thickness.required'] = 'Please select knitted gsm thickness';
                    $messages['knitted_width_from.required'] = 'Knitted width is required';
                    $messages['knitted_width_to.required'] = 'Knitted width is rquired';
                    $messages['knitted_manufact.required'] = 'Please select knitted manufact';
                    $messages['knitted_yarn.required'] = 'Please select knitted yarn';
                    $messages['knitted_features.required'] = 'Please select knitted feature';
                    $messages['knitted_use.required'] = 'Please knitted use';
                    if ($request->knitted_fabric_types == "Other"){
                        $rules['other_knitted_fabric_type'] = 'required';
                        $messages['other_knitted_fabric_type.required'] = 'Other knitted fabric type is required';
                    }
                    if ($request->knitted_knitting_types == "Other") {
                        $rules['other_knitted_knitting_type'] = 'required';
                        $messages['other_knitted_knitting_type.required'] = 'Other knitted knitting type is required';
                    }
                    if ($request->knitted_features != null && in_array("Other", $request->knitted_features)) {
                        $rules['other_knitted_features'] = 'required';
                        $messages['other_knitted_features.required'] = 'Other knitted feature is required';
                    }
                    if ($request->knitted_use != null && in_array("Other", $request->knitted_use)) {
                        $rules['other_knitted_use'] = 'required';
                        $messages['other_knitted_use.required'] = 'Other knitted use is required';
                    }
                }
            } else {
                $rules['knitted_fabric_types'] = 'required';
                $rules['knitted_knitting_types'] = 'required';
                $rules['knitted_fabric_construction'] = 'required';
                $rules['knitted_gsm_thickness'] = 'required';
                $rules['knitted_width_from'] = 'required';
                $rules['knitted_width_to'] = 'required';
                $rules['knitted_manufact'] = 'required';
                $rules['knitted_yarn'] = 'required';
                $rules['knitted_features'] = 'required';
                $rules['knitted_use'] = 'required';
                $messages['knitted_fabric_types.required'] = 'Please select knitted fabrictype';
                $messages['knitted_knitting_types.required'] = 'Please select knitted knitting type';
                $messages['knitted_fabric_construction.required'] = 'Please select knitted fabric construction';
                $messages['knitted_gsm_thickness.required'] = 'Please select knitted gsm thickness';
                $messages['knitted_width_from.required'] = 'Knitted width is required';
                $messages['knitted_width_to.required'] = 'Knitted width is rquired';
                $messages['knitted_manufact.required'] = 'Please select knitted manufact';
                $messages['knitted_yarn.required'] = 'Please select knitted yarn';
                $messages['knitted_features.required'] = 'Please select knitted feature';
                $messages['knitted_use.required'] = 'Please knitted use';
                if ($request->knitted_fabric_types == "Other"){
                    $rules['other_knitted_fabric_type'] = 'required';
                    $messages['other_knitted_fabric_type.required'] = 'Other knitted fabric type is required';
                }
                if ($request->knitted_knitting_types == "Other") {
                    $rules['other_knitted_knitting_type'] = 'required';
                    $messages['other_knitted_knitting_type.required'] = 'Other knitted knitting type is required';
                }
                if ($request->knitted_features != null && in_array("Other", $request->knitted_features)) {
                    $rules['other_knitted_features'] = 'required';
                    $messages['other_knitted_features.required'] = 'Other knitted feature is required';
                }
                if ($request->knitted_use != null && in_array("Other", $request->knitted_use)) {
                    $rules['other_knitted_use'] = 'required';
                    $messages['other_knitted_use.required'] = 'Other knitted use is required';
                }
            }
        }
        if ($new_category == "Fibers & Materials" && $new_sub_category == "Woven Fabric" && $request->product_service_types != null) {
            if (count($request->product_service_types) == 1) {
                if (!in_array("Buy", $request->product_service_types)) {
                    $rules['woven_fabric_types'] = 'required';
                    $rules['woven_weave_types'] = 'required';
                    $rules['woven_fabric_construction'] = 'required';
                    $rules['woven_gsm_thickness'] = 'required';
                    $rules['woven_width_from'] = 'required';
                    $rules['woven_width_to'] = 'required';
                    $rules['woven_manufact'] = 'required';
                    $rules['woven_yarn'] = 'required';
                    $rules['woven_features'] = 'required';
                    $rules['woven_use'] = 'required';
                    $messages['woven_fabric_types.required'] = 'Please select woven fabric type';
                    $messages['woven_weave_types.required'] = 'Please select woven weave type';
                    $messages['woven_fabric_construction.required'] = 'Please select woven fabric construction';
                    $messages['woven_gsm_thickness.required'] = 'Please select woven gsm thickness';
                    $messages['woven_width_from.required'] = 'Woven width is required';
                    $messages['woven_width_to.required'] = 'Woven width is required';
                    $messages['woven_manufact.required'] = 'Please select woven manufact';
                    $messages['woven_yarn.required'] = 'Please select woven yarn';
                    $messages['woven_features.required'] = 'Please select woven feature';
                    $messages['woven_use.required'] = 'Please select woven use';
                    if ($request->woven_fabric_types == "Other"){
                        $rules['other_woven_fabric_type'] = 'required';
                        $messages['other_woven_fabric_type.required'] = 'Other woven fabric type is required';
                    }
                    if ($request->woven_weave_types == "Other") {
                        $rules['other_woven_weave_type'] = 'required';
                        $messages['other_woven_weave_type.required'] = 'Other woven weave type is required';
                    }
                    if ($request->woven_features != null && in_array("Other", $request->woven_features)) {
                        $rules['other_woven_features'] = 'required';
                        $messages['other_woven_features.required'] = 'Other woven feature is required';
                    }
                    if ($request->woven_use != null && in_array("Other", $request->woven_use)) {
                        $rules['other_woven_use'] = 'required';
                        $messages['other_woven_use.required'] = 'Other woven use is required';
                    }
                }
            } else {
                $rules['woven_fabric_types'] = 'required';
                $rules['woven_weave_types'] = 'required';
                $rules['woven_fabric_construction'] = 'required';
                $rules['woven_gsm_thickness'] = 'required';
                $rules['woven_width_from'] = 'required';
                $rules['woven_width_to'] = 'required';
                $rules['woven_manufact'] = 'required';
                $rules['woven_yarn'] = 'required';
                $rules['woven_features'] = 'required';
                $rules['woven_use'] = 'required';
                $messages['woven_fabric_types.required'] = 'Please select woven fabric type';
                $messages['woven_weave_types.required'] = 'Please select woven weave type';
                $messages['woven_fabric_construction.required'] = 'Please select woven fabric construction';
                $messages['woven_gsm_thickness.required'] = 'Please select woven gsm thickness';
                $messages['woven_width_from.required'] = 'Woven width is required';
                $messages['woven_width_to.required'] = 'Woven width is required';
                $messages['woven_manufact.required'] = 'Please select woven manufact';
                $messages['woven_yarn.required'] = 'Please select woven yarn';
                $messages['woven_features.required'] = 'Please select woven feature';
                $messages['woven_use.required'] = 'Please select woven use';
                if ($request->woven_fabric_types == "Other"){
                    $rules['other_woven_fabric_type'] = 'required';
                    $messages['other_woven_fabric_type.required'] = 'Other woven fabric type is required';
                }
                if ($request->woven_weave_types == "Other") {
                    $rules['other_woven_weave_type'] = 'required';
                    $messages['other_woven_weave_type.required'] = 'Other woven weave type is required';
                }
                if ($request->woven_features != null && in_array("Other", $request->woven_features)) {
                    $rules['other_woven_features'] = 'required';
                    $messages['other_woven_features.required'] = 'Other woven feature is required';
                }
                if ($request->woven_use != null && in_array("Other", $request->woven_use)) {
                    $rules['other_woven_use'] = 'required';
                    $messages['other_woven_use.required'] = 'Other woven use is required';
                }
            }
        }
        if ($new_category == "Fibers & Materials" && $new_sub_category == "Nonwoven Fabric" && $request->product_service_types != null) {
            if (count($request->product_service_types) == 1) {
                if (!in_array("Buy", $request->product_service_types)) {
                    $rules['non_woven_fabric_types'] = 'required';
                    $rules['non_woven_types'] = 'required';
                    $rules['non_woven_fabric_construction'] = 'required';
                    $rules['non_woven_gsm_thickness'] = 'required';
                    $rules['non_woven_width_from'] = 'required';
                    $rules['non_woven_width_to'] = 'required';
                    $rules['non_woven_manufact'] = 'required';
                    $rules['non_woven_yarn'] = 'required';
                    $rules['non_woven_features'] = 'required';
                    $rules['non_woven_use'] = 'required';
                    $messages['non_woven_fabric_types.required'] = 'Please select non woven fabric type';
                    $messages['non_woven_types.required'] = 'Please select non woven type';
                    $messages['non_woven_fabric_construction.required'] = 'Please select non woven fabric construction';
                    $messages['non_woven_gsm_thickness.required'] = 'Please select non woven gsm thickness';
                    $messages['non_woven_width_from.required'] = 'Non woven width is required';
                    $messages['non_woven_width_to.required'] = 'Non woven width is required';
                    $messages['non_woven_manufact.required'] = 'Please select non woven manufact';
                    $messages['non_woven_yarn.required'] = 'Please select non woven yarn';
                    $messages['non_woven_features.required'] = 'Please select non woven feature';
                    $messages['non_woven_use.required'] = 'Please select non woven use';
                    if ($request->non_woven_fabric_types == "Other"){
                        $rules['other_non_woven_fabric_type'] = 'required';
                        $messages['other_non_woven_fabric_type.required'] = 'Other non woven fabric type is required';
                    }
                    if ($request->non_woven_types == "Other") {
                        $rules['other_non_woven_type'] = 'required';
                        $messages['other_non_woven_type.required'] = 'Other non woven type is required';
                    }
                    if ($request->non_woven_features != null && in_array("Other", $request->non_woven_features)) {
                        $rules['other_non_woven_features'] = 'required';
                        $messages['other_non_woven_features.required'] = 'Other non woven feature is required';
                    }
                    if ($request->non_woven_use != null && in_array("Other", $request->non_woven_use)) {
                        $rules['other_non_woven_use'] = 'required';
                        $messages['other_non_woven_use.required'] = 'Other non woven use is required';
                    }
                }
            } else {
                $rules['non_woven_fabric_types'] = 'required';
                $rules['non_woven_types'] = 'required';
                $rules['non_woven_fabric_construction'] = 'required';
                $rules['non_woven_gsm_thickness'] = 'required';
                $rules['non_woven_width_from'] = 'required';
                $rules['non_woven_width_to'] = 'required';
                $rules['non_woven_manufact'] = 'required';
                $rules['non_woven_yarn'] = 'required';
                $rules['non_woven_features'] = 'required';
                $rules['non_woven_use'] = 'required';
                $messages['non_woven_fabric_types.required'] = 'Please select non woven fabric type';
                $messages['non_woven_types.required'] = 'Please select non woven type';
                $messages['non_woven_fabric_construction.required'] = 'Please select non woven fabric construction';
                $messages['non_woven_gsm_thickness.required'] = 'Please select non woven gsm thickness';
                $messages['non_woven_width_from.required'] = 'Non woven width is required';
                $messages['non_woven_width_to.required'] = 'Non woven width is required';
                $messages['non_woven_manufact.required'] = 'Please select non woven manufact';
                $messages['non_woven_yarn.required'] = 'Please select non woven yarn';
                $messages['non_woven_features.required'] = 'Please select non woven feature';
                $messages['non_woven_use.required'] = 'Please select non woven use';
                if ($request->non_woven_fabric_types == "Other"){
                    $rules['other_non_woven_fabric_type'] = 'required';
                    $messages['other_non_woven_fabric_type.required'] = 'Other non woven fabric type is required';
                }
                if ($request->non_woven_types == "Other") {
                    $rules['other_non_woven_type'] = 'required';
                    $messages['other_non_woven_type.required'] = 'Other non woven type is required';
                }
                if ($request->non_woven_features != null && in_array("Other", $request->non_woven_features)) {
                    $rules['other_non_woven_features'] = 'required';
                    $messages['other_non_woven_features.required'] = 'Other non woven feature is required';
                }
                if ($request->non_woven_use != null && in_array("Other", $request->non_woven_use)) {
                    $rules['other_non_woven_use'] = 'required';
                    $messages['other_non_woven_use.required'] = 'Other non woven use is required';
                }
            }
        }
        if ($new_category == "Fibers & Materials" && $new_sub_category == "Natural Yarn" || $new_sub_category == "Synthetic Yarn" || $new_sub_category == "Blended Yarn" || $new_sub_category == "Speciality Yarn" && $request->product_service_types != null) {
            if (count($request->product_service_types) == 1) {
                if (!in_array("Buy", $request->product_service_types)) {
                    $rules['yarn_count'] = 'required';
                    $rules['yarn_count_unit'] = 'required';
                    $rules['yarn_attribute'] = 'required';
                    $rules['yarn_technology'] = 'required';
                    $rules['yarn_grade'] = 'required';
                    $rules['count_type'] = 'required';
                    $rules['yarn_specialty'] = 'required';
                    $rules['usage_type'] = 'required';
                    $messages['yarn_count.required'] = 'Please select yarn count';
                    $messages['yarn_count_unit.required'] = 'Please select yarn count unit';
                    $messages['yarn_attribute.required'] = 'Please select attribute';
                    $messages['yarn_technology.required'] = 'Please select technology';
                    $messages['yarn_grade.required'] = 'Please select grade';
                    $messages['count_type.required'] = 'Please select count type';
                    $messages['yarn_specialty.required'] = 'Please select speciality';
                    $messages['usage_type.required'] = 'Please select usage type';
                    if ($request->yarn_count_unit == "Other"){
                        $rules['other_yarn_count_unit'] = 'required';
                        $messages['other_yarn_count_unit.required'] = 'Other count unit is required';
                    }
                    if ($request->yarn_attribute == "Other"){
                        $rules['other_yarn_attribute'] = 'required';
                        $messages['other_yarn_attribute.required'] = 'Other attribute is required';
                    }
                    if ($request->yarn_technology == "Other"){
                        $rules['other_yarn_technology'] = 'required';
                        $messages['other_yarn_technology.required'] = 'Other technology is required';
                    }

                    if ($request->count_type == "Other"){
                        $rules['other_count_type'] = 'required';
                        $messages['other_count_type.required'] = 'Other count type is required';
                    }
                    if ($request->yarn_specialty == "Other"){
                        $rules['other_yarn_speciality'] = 'required';
                        $messages['other_yarn_speciality.required'] = 'Other speciality is required';
                    }
                    if ($request->usage_type == "Other"){
                        $rules['other_usage_type'] = 'required';
                        $messages['other_usage_type.required'] = 'Other usage type is required';
                    }
                }
            } else {
                $rules['yarn_count'] = 'required';
                $rules['yarn_count_unit'] = 'required';
                $rules['yarn_attribute'] = 'required';
                $rules['yarn_technology'] = 'required';
                $rules['yarn_grade'] = 'required';
                $rules['count_type'] = 'required';
                $rules['yarn_specialty'] = 'required';
                $rules['usage_type'] = 'required';
                $messages['yarn_count.required'] = 'Please select yarn count';
                $messages['yarn_count_unit.required'] = 'Please select yarn count unit';
                $messages['yarn_attribute.required'] = 'Please select attribute';
                $messages['yarn_technology.required'] = 'Please select technology';
                $messages['yarn_grade.required'] = 'Please select grade';
                $messages['count_type.required'] = 'Please select count type';
                $messages['yarn_specialty.required'] = 'Please select speciality';
                $messages['usage_type.required'] = 'Please select usage type';
                if ($request->yarn_count_unit == "Other"){
                    $rules['other_yarn_count_unit'] = 'required';
                    $messages['other_yarn_count_unit.required'] = 'Other count unit is required';
                }
                if ($request->yarn_attribute == "Other"){
                    $rules['other_yarn_attribute'] = 'required';
                    $messages['other_yarn_attribute.required'] = 'Other attribute is required';
                }
                if ($request->yarn_technology == "Other"){
                    $rules['other_yarn_technology'] = 'required';
                    $messages['other_yarn_technology.required'] = 'Other technology is required';
                }

                if ($request->count_type == "Other"){
                    $rules['other_count_type'] = 'required';
                    $messages['other_count_type.required'] = 'Other count type is required';
                }
                if ($request->yarn_specialty == "Other"){
                    $rules['other_yarn_speciality'] = 'required';
                    $messages['other_yarn_speciality.required'] = 'Other speciality is required';
                }
                if ($request->usage_type == "Other"){
                    $rules['other_usage_type'] = 'required';
                    $messages['other_usage_type.required'] = 'Other usage type is required';
                }
            }
        }
        if ($new_category == "Fibers & Materials" && $new_sub_category == "Natural Fibre" || $new_sub_category == "Manmade Fibre"  && $request->product_service_types != null) {
            if (count($request->product_service_types) == 1) {
                if (!in_array("Buy", $request->product_service_types)) {
                    $rules['purpose'] = 'required';
                    $rules['size'] = 'required';
                    $messages['purpose.required'] = 'Please select fiber type';
                    $messages['size.required'] = 'Please select fiber size';

                    if ($request->purpose == "Other"){
                        $rules['other_purpose'] = 'required';
                        $messages['other_purpose.required'] = 'Other fiber type is required';
                    }
                }
            } else {
                $rules['purpose'] = 'required';
                $rules['size'] = 'required';
                $messages['purpose.required'] = 'Please select fiber type';
                $messages['size.required'] = 'Please select fiber size';

                if ($request->purpose == "Other"){
                    $rules['other_purpose'] = 'required';
                    $messages['other_purpose.required'] = 'Other fiber type is required';
                }
            }
        }
        if ($new_category == "PPE & Institutional" && $request->product_service_types != null) {
            if (count($request->product_service_types) == 1) {
                if (!in_array("Buy", $request->product_service_types)) {
                    $rules['material'] = 'required';
                    $rules['composition'] = 'required';
                    $rules['size_age_group'] = 'required';
                    $rules['colour'] = 'required';
                    $messages['material.required'] = 'Please select material type';
                    $messages['composition.required'] = 'Please select composition';
                    $messages['size_age_group.required'] = 'Please select size';
                    $messages['colour.required'] = 'Please select color';

                }
            } else {
                $rules['material'] = 'required';
                $rules['composition'] = 'required';
                $rules['size_age_group'] = 'required';
                $rules['colour'] = 'required';
                $messages['material.required'] = 'Please select material type';
                $messages['composition.required'] = 'Please select composition';
                $messages['size_age_group.required'] = 'Please select size';
                $messages['colour.required'] = 'Please select color';
            }
        }
        if ($new_category == "Garments & Accessories" && $request->product_service_types != null) {
            if (count($request->product_service_types) == 1) {
                if (!in_array("Buy", $request->product_service_types)) {
                    $rules['material_type'] = 'required';
                    $rules['construction'] = 'required';
                    $rules['size_age'] = 'required';
                    $rules['color'] = 'required';
                    $messages['material_type.required'] = 'Please select material type';
                    $messages['construction.required'] = 'Please select construction';
                    $messages['size_age.required'] = 'Please select age';
                    $messages['color.required'] = 'Please select color';

                }
            } else {
                $rules['material_type'] = 'required';
                $rules['construction'] = 'required';
                $rules['size_age'] = 'required';
                $rules['color'] = 'required';
                $messages['material_type.required'] = 'Please select material type';
                $messages['construction.required'] = 'Please select construction';
                $messages['size_age.required'] = 'Please select age';
                $messages['color.required'] = 'Please select color';
            }
        }
        if ($new_category == "Dyes & Chemicals" && $request->product_service_types != null) {
            if (count($request->product_service_types) == 1) {
                if (!in_array("Buy", $request->product_service_types)) {
                    $rules['manufacturer_name'] = '';
                    $rules['origin'] = '';
                    for ($i = 1; $i <= $request->company_counter; $i++) {
                        /*                        $rules['manufacturer_company_name' . $i] = 'required';
                                                $rules['origin' . $i] = 'required';*/
                        /*                        $rules['chemicals_listed' . $i] = 'required';
                                                $rules['supply_type' . $i] = 'required';*/
                        $messages['manufacturer_company_name' . $i . '.required'] = 'Manufacturer company name is required';
                        $messages['origin' . $i . '.required'] = 'Origin is required';
                        $messages['chemicals_listed' . $i . '.required'] = 'Chemicals listed is required';
                        $messages['supply_type' . $i . '.required'] = 'Please select supply type';
                    }
                }
            } else {
                $rules['manufacturer_name'] = '';
                $rules['origin'] = '';
                for ($i = 1; $i <= $request->company_counter; $i++) {
                    /*$rules['manufacturer_company_name' . $i] = 'required';
                    $rules['origin' . $i] = 'required';*/
                    /*                    $rules['chemicals_listed' . $i] = 'required';
                                        $rules['supply_type' . $i] = 'required';*/
                    $messages['manufacturer_company_name' . $i . '.required'] = 'Manufacturer company name is required';
                    $messages['origin' . $i . '.required'] = 'Origin is required';
                    $messages['chemicals_listed' . $i . '.required'] = 'Chemicals listed is required';
                    $messages['supply_type' . $i . '.required'] = 'Please select supply type';
                }
            }
        }

        $validator = \Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            // return $validator->errors()->getMessages();
            return json_encode(['feedback' => 'validation_error', 'errors' => $validator->errors()->getMessages(),]);
        }
        $product = new \App\Product();
        $product->company_id = session()->get('company_id');
        $product->product_service_types = implode(',', $request->product_service_types);
        $product->category_id = $request->category;
        $product->product_certification = $request->product_certification;

        $product->subcategory_id = $request->sub_category;

        $product->childsubcategory_id = $request->sub_sub_category;
        $product->add_sub_sub_category = $request->add_sub_sub_category;

        $product->reference_no = mt_rand(100000,4900000);
        $product->slug = Str::slug($request->product_service_name) . "-" . $product->reference_no;

        $product->subject = $request->subject;

        $product->keyword1 = $request->keyword1;
        $product->keyword2 = $request->keyword2;
        $product->keyword3 = $request->keyword3;

        $product->product_service_name = $request->product_service_name;
        $product->product_availability = $request->product_availability;
        $product->origin = $request->origin;
        $product->details = $request->details;

        $product->city = auth()->user()->city;
        $product->country = auth()->user()->country;
        $product->is_certified = 0;
        $product->is_featured = 0;
        $product->phone = auth()->user()->registration_phone_no;
        $product->createdBy = Auth::user()->id;
        $product->updated_at = null;
        $product->save();
        $images =  [$request->avatar1_url,$request->avatar2_url,$request->avatar3_url,$request->avatar4_url,$request->avatar5_url,$request->avatar6_url,$request->avatar7_url,$request->avatar8_url,$request->avatar9_url,$request->avatar10_url,$request->avatar11_url,$request->avatar12_url,$request->avatar13_url,$request->avatar14_url,$request->avatar15_url];
        foreach ($images as $image) {
            if ($image) {
                \App\ProductImage::create(['product_id' => $product->id, 'image' => $image]);
            }
        }

        $sheets =  [$request->sheet16_url,$request->sheet17_url,$request->sheet18_url,$request->sheet19_url,$request->sheet20_url,$request->sheet21_url,$request->sheet22_url,$request->sheet23_url,$request->sheet24_url,$request->sheet25_url,$request->sheet26_url,$request->sheet27_url,$request->sheet28_url,$request->sheet29_url,$request->sheet30_url];
        foreach ($sheets as $sheet){
            if ($sheet) {
                \App\ProductSpecification::create([
                    'product_id' => $product->id,
                    'sheet' => $sheet
                ]);
            }
        }


        if (in_array("Service", $request->product_service_types)) {
            $product->dealing_as = "Service Provider";
        } else {
            $product->delivery = $request->delivery;
            if ($request->dealing_as != null) {
                $product->dealing_as = implode(',', $request->dealing_as);
                if (in_array("Other", $request->dealing_as)) {
                    $product->other_dealing_as = $request->other_dealing_as;
                }
            }
        }
        if ($request->focused_selling_countries != null) {
            $product->focused_selling_countries = implode(',', $request->focused_selling_countries);
        }
        $product->focused_selling_region = $request->focused_selling_region;
        $product->production_capacity = $request->production_capacity;
        $product->min_order_quantity = $request->min_order_quantity;
        if ($request->min_order_quantity) {
//            $product->min_order_quantity_unit = $request->min_order_quantity_unit;
            $product->min_order_quantity_unit = '';
        }
        if ($request->is_sampling == '1') {
            $product->is_sampling = $request->is_sampling;
            $product->sampling_type = $request->sampling_type;
            if ($request->sampling_type == 'Paid') {
                $product->paid_sampling_price = $request->paid_sampling_price;
            }
        }
//        if ($request->service_types != null) {
//            $product->service_types = implode(',', $request->service_types);
//        }
//        if ($request->textile_service_types != null) {
//            $product->textile_service_types = implode(',', $request->textile_service_types);
//        }
        if ($request->service_durations != null) {
            $product->service_durations = implode(',', $request->service_durations);
            if (in_array("Other", $request->service_durations)) {
                $product->other_service_duration = $request->other_service_duration;
            }
        }

        if (in_array("Sell", $request->product_service_types)) {
            $product->unit_price_from = $request->unit_price_from;
            $product->unit_price_to = $request->unit_price_to;
            $product->unit_price_unit = $request->unit_price_unit;
            if ($request->unit_price_unit != null && $request->unit_price_unit == 'Other') {
                $product->other_unit_price_unit = $request->other_unit_price_unit;
            }
        }

        if (in_array("Service", $request->product_service_types)) {
            $product->unit_price_from = $request->unit_price_from;
            $product->unit_price_to = $request->unit_price_to;
            $product->unit_price_unit = 'Other';
            $product->other_unit_price_unit = $request->other_unit_price_unitt;
        }

        if (in_array("Buy", $request->product_service_types)) {
            $product->target_price_from = $request->target_price_from;
            $product->target_price_to = $request->target_price_to;
            $product->target_price_unit = $request->target_price_unit;
            if ($request->target_price_unit != null && $request->target_price_unit == 'Other') {
                $product->other_target_price_unit = $request->other_target_price_unit;
            }
        }

        $product->suitable_currencies = $request->suitable_currencies;
        if ($request->suitable_currencies == "Other") {
            $product->other_suitable_currency = $request->other_suitable_currency;
        }

        if ($request->payment_terms) {
            $product->payment_terms = $request->payment_terms;
        }
        if ($request->payment_terms == "Other") {
            $product->other_payment_term = $request->other_payment_term;
        }
        $product->delivery_time = $request->delivery_time;
//        dd($product);
        $product->variation = null;
        if ($product->save()) {
            if (in_array("Sell", $request->product_service_types) || in_array("Buy", $request->product_service_types)) {
                if ($request->manufacturer_name != null) {
                    $product_manufacturer = new \App\ProductManufacturer();
                    $product_manufacturer->user_id = \Auth()->user()->id;
                    $product_manufacturer->product_id = $product->id;
                    $product_manufacturer->manufacturer_name = $request->manufacturer_name;
                    $product->product_manufacturer()->save($product_manufacturer);
                }
            }
            if ($new_category == "Machinery & Parts") {
                $machinery_product_info = new \App\MachineryProductInfo();
                $machinery_product_info->product_id = $product->id;
                $machinery_product_info->product_type = $request->product_type;
                $machinery_product_info->machinery_condition = $request->machinery_condition;
                $machinery_product_info->after_sales_service = $request->after_sales_service;
                if ($request->after_sales_service == "Yes") {
                    $machinery_product_info->service_type = $request->service_type;
                }
                $machinery_product_info->warranty = $request->warranty;
                if ($request->warranty == "Yes") {
                    $machinery_product_info->warranty_period = $request->warranty_period;
                }
                $machinery_product_info->certification = $request->certification;
                if ($request->certification == "Yes") {
                    $machinery_product_info->certification_details = $request->certification_details;
                }
                $machinery_product_info->additional_trade_notes = $request->additional_trade_notes;
                $machinery_product_info->product_related_certifications = $request->product_related_certifications;
                $product->machinery_product_info()->save($machinery_product_info);
                $product->variation = $new_category;
                $product->updated_at = null;
                $product->save();
            } else if ($new_category == "Fibers & Materials" && $new_sub_category == "Knitted Fabric") {
                $fabric_product_info = new \App\FabricProductInfo();
                $fabric_product_info->product_id = $product->id;

                $fabric_product_info->fabric_types = $request->knitted_fabric_types;
                if ($request->knitted_fabric_types == "Other") {
                    $fabric_product_info->other_fabric_type = $request->other_knitted_fabric_type;
                }

                $fabric_product_info->knitting_type = $request->knitted_knitting_types;
                if ($request->knitted_knitting_types == "Other") {
                    $fabric_product_info->other_knitting_type = $request->other_knitted_knitting_type;
                }
                $fabric_product_info->fabric_construction = $request->knitted_fabric_construction;
                $fabric_product_info->gsm_thickness = $request->knitted_gsm_thickness;
                $fabric_product_info->fabric_composition = $request->knitted_fabric_composition;

                $fabric_product_info->width_from = $request->knitted_width_from;
                $fabric_product_info->width_to = $request->knitted_width_to;

                $fabric_product_info->manufacturing_technique = $request->knitted_manufact;
                if ($fabric_product_info->manufacturing_technique == 'Other') {
                    $fabric_product_info->other_manufacturing_technique = $request->other_knitted_manufact;
                }

                $fabric_product_info->yarn_type = $request->knitted_yarn;
                if ($fabric_product_info->yarn_type == 'Other') {
                    $fabric_product_info->other_yarn_type = $request->other_knitted_yarn_type;
                }
                $fabric_product_info->features = implode(',', $request->knitted_features);
                if (in_array("Other", $request->knitted_features)) {
                    $fabric_product_info->other_feature = $request->other_knitted_features;
                }
                $fabric_product_info->uses = implode(',', $request->knitted_use);
                if (in_array("Other", $request->knitted_use)) {
                    $fabric_product_info->other_use = $request->other_knitted_use;
                }
                $product->fabric_product_info()->save($fabric_product_info);
                $product->variation = $new_sub_category;
                $product->updated_at = null;
                $product->save();
            } else if ($new_category == "Fibers & Materials" && $new_sub_category == "Woven Fabric") {
                $fabric_product_info = new \App\FabricProductInfo();
                $fabric_product_info->product_id = $product->id;

                $fabric_product_info->fabric_types = $request->woven_fabric_types;
                if ($request->woven_fabric_types == "Other") {
                    $fabric_product_info->other_fabric_type = $request->other_woven_fabric_type;
                }

                $fabric_product_info->weave_types = $request->woven_weave_types;
                if ($request->woven_weave_types == "Other") {
                    $fabric_product_info->other_weave_type = $request->other_woven_weave_type;
                }
                $fabric_product_info->fabric_construction = $request->woven_fabric_construction;
                $fabric_product_info->gsm_thickness = $request->woven_gsm_thickness;
                $fabric_product_info->fabric_composition = $request->woven_fabric_composition;

                $fabric_product_info->width_from = $request->woven_width_from;
                $fabric_product_info->width_to = $request->woven_width_to;

                $fabric_product_info->manufacturing_technique = $request->woven_manufact;
                if ($fabric_product_info->manufacturing_technique == 'Other') {
                    $fabric_product_info->other_manufacturing_technique = $request->other_woven_manufact;
                }

                $fabric_product_info->yarn_type = $request->woven_yarn;
                if ($fabric_product_info->yarn_type == 'Other') {
                    $fabric_product_info->other_yarn_type = $request->other_woven_yarn;
                }
                $fabric_product_info->features = implode(',', $request->woven_features);
                if (in_array("Other", $request->woven_features)) {
                    $fabric_product_info->other_feature = $request->other_woven_features;
                }
                $fabric_product_info->uses = implode(',', $request->woven_use);
                if (in_array("Other", $request->woven_use)) {
                    $fabric_product_info->other_use = $request->other_woven_use;
                }
                $product->fabric_product_info()->save($fabric_product_info);
                $product->variation = $new_sub_category;
                $product->updated_at = null;
                $product->save();
            } else if ($new_category == "Fibers & Materials" && $new_sub_category == "Nonwoven Fabric") {
                $fabric_product_info = new \App\FabricProductInfo();
                $fabric_product_info->product_id = $product->id;

                $fabric_product_info->fabric_types = $request->non_woven_fabric_types;
                if ($request->non_woven_fabric_types == "Other") {
                    $fabric_product_info->other_fabric_type = $request->other_non_woven_fabric_type;
                }

                $fabric_product_info->non_woven_types = $request->non_woven_types;
                if ($request->non_woven_types == "Other") {
                    $fabric_product_info->other_non_woven_type = $request->other_non_woven_type;
                }
                $fabric_product_info->fabric_construction = $request->non_woven_fabric_construction;
                $fabric_product_info->gsm_thickness = $request->non_woven_gsm_thickness;
                $fabric_product_info->fabric_composition = $request->non_woven_fabric_composition;

                $fabric_product_info->width_from = $request->non_woven_width_from;
                $fabric_product_info->width_to = $request->non_woven_width_to;

                $fabric_product_info->manufacturing_technique = $request->non_woven_manufact;
                if ($fabric_product_info->manufacturing_technique == 'Other') {
                    $fabric_product_info->other_manufacturing_technique = $request->other_non_woven_manufact;
                }

                $fabric_product_info->yarn_type = $request->non_woven_yarn;
                if ($fabric_product_info->yarn_type == 'Other') {
                    $fabric_product_info->other_yarn_type = $request->other_non_woven_yarn;
                }
                $fabric_product_info->features = implode(',', $request->non_woven_features);
                if (in_array("Other", $request->non_woven_features)) {
                    $fabric_product_info->other_feature = $request->other_non_woven_features;
                }
                $fabric_product_info->uses = implode(',', $request->non_woven_use);
                if (in_array("Other", $request->non_woven_use)) {
                    $fabric_product_info->other_use = $request->other_non_woven_use;
                }
                $product->fabric_product_info()->save($fabric_product_info);
                $product->variation = $new_sub_category;
                $product->updated_at = null;
                $product->save();
            } else if ($new_category == "Fibers & Materials" && $new_sub_category == "Natural Yarn" || $new_sub_category == "Synthetic Yarn" || $new_sub_category == "Blended Yarn" || $new_sub_category == "Speciality Yarn") {
                $yarn_product_info = new \App\YarnProductInfo();
                $yarn_product_info->product_id = $product->id;
                $yarn_product_info->count = $request->yarn_count;

                $yarn_product_info->count_unit = $request->yarn_count_unit;
                if ($request->yarn_count_unit == "Other") {
                    $yarn_product_info->other_count_unit = $request->other_yarn_count_unit;
                }
                $yarn_product_info->attribute = $request->yarn_attribute;
                if ($request->yarn_attribute == "Other") {
                    $yarn_product_info->other_attribute = $request->other_yarn_attribute;
                }
                $yarn_product_info->technology = $request->yarn_technology;
                if ($request->yarn_technology == "Other") {
                    $yarn_product_info->other_technology = $request->other_yarn_technology;
                }

                $yarn_product_info->grade = $request->yarn_grade;
                $yarn_product_info->tpi = $request->tpi;
                $yarn_product_info->tenacity = $request->tenacity;

                $yarn_product_info->count_type = $request->count_type;
                if ($yarn_product_info->count_type == 'Other') {
                    $yarn_product_info->other_count_type = $request->other_count_type;
                }

                $yarn_product_info->yarn_specialty = $request->yarn_specialty;
                if ($yarn_product_info->yarn_specialty == 'Other') {
                    $yarn_product_info->other_speciality = $request->other_yarn_speciality;
                }
                $yarn_product_info->end_use = $request->usage_type;
                if ($yarn_product_info->end_use == 'Other') {
                    $yarn_product_info->other_end_use = $request->other_usage_type;
                }

                $product->yarn_product_info()->save($yarn_product_info);
                $product->variation = $new_sub_category;
                $product->updated_at = null;
                $product->save();
            } else if ($new_category == "Fibers & Materials" && $new_sub_category == "Natural Fibre" || $new_sub_category == "Manmade Fibre") {
                $fiber_product_info = new \App\FiberProductInfo();

                $fiber_product_info->product_id = $product->id;

                $fiber_product_info->fiber_type = $request->purpose;
                if ($fiber_product_info->fiber_type == 'Other') {
                    $fiber_product_info->other_fiber_type = $request->other_purpose;
                }

                $fiber_product_info->size = $request->size;
                $fiber_product_info->strength = $request->strength;
                $fiber_product_info->end_use = $request->end_app;

                $product->fiber_product_info()->save($fiber_product_info);
                $product->variation = $new_sub_category;
                $product->updated_at = null;
                $product->save();
            } else if ($new_category == "PPE & Institutional") {
                $institutional_product_info = new \App\InstitutionalProductInfo();

                $institutional_product_info->product_id = $product->id;

                $institutional_product_info->material = $request->material;
                $institutional_product_info->composition = $request->composition;
                $institutional_product_info->size_age = $request->size_age_group;
                $institutional_product_info->color = $request->colour;
                $institutional_product_info->gender = $request->gender;
                $institutional_product_info->thickness = $request->thickness;
                $institutional_product_info->brand = $request->brand;
                $institutional_product_info->design = $request->design;
                $institutional_product_info->season = $request->season;
                $institutional_product_info->end_use = $request->use_end;

                $product->institutional_product_info()->save($institutional_product_info);
                $product->variation = $new_category;
                $product->updated_at = null;
                $product->save();

            } else if ($new_category == "Garments & Accessories") {
                $garments_product_info = new \App\GarmentsProductInfo();

                $garments_product_info->product_id = $product->id;
                $garments_product_info->material = $request->material_type;
                $garments_product_info->composition = $request->construction;
                $garments_product_info->size_age = $request->size_age;
                $garments_product_info->color = $request->color;
                $garments_product_info->gender = $request->garments_gender;
                $garments_product_info->thickness = $request->thickness_gsm_width;
                $garments_product_info->brand = $request->garments_brand;
                $garments_product_info->design = $request->design_style;
                $garments_product_info->season = $request->garments_season;
                $garments_product_info->end_use = $request->end_use_app;

                $product->garments_product_info()->save($garments_product_info);
                $product->variation = $new_category;
                $product->updated_at = null;
                $product->save();
            } else if ($new_category == "Dyes & Chemicals") {
                for ($i = 1; $i <= $request->company_counter; $i++) {
                    $chemicals_product_infos = new \App\ChemicalsProductInfo();
                    $chemicals_product_infos->manufacturer_company_name = request('manufacturer_company_name' . $i);
                    $chemicals_product_infos->origin = request('origin' . $i);
                    $chemicals_product_infos->chemicals_listed = request('chemicals_listed' . $i);
                    $chemicals_product_infos->supply_type = request('supply_type' . $i);
                    $chemicals_product_infos->company_additional_info = request('company_additional_info' . $i);
                    $product->chemicals_product_infos()->save($chemicals_product_infos);
                }
                $product->variation = $new_category;
                $product->updated_at = null;
                $product->save();
            }
            return json_encode([
                'feedback' => 'created', 'url' => route('products.index'), 'product_id' => $product->id,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $user = \Auth()->user();
        return view('front_site.bizoffice.products.edit', compact('user', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
//        dd($product);

        $rules = [
            'product_service_types' => 'required', 'category' => 'required', 'sub_category' => 'required',
            'subject' => 'required',
            'product_service_name' => 'required',
        ];
        $messages = [
            'product_service_types.required' => 'Please select product and service type',
            'category.required' => 'Please select a category',
            'sub_category.required' => 'Please select a sub-category',
            'sub_sub_category.required' => 'Please select a child-sub-category',
            'subject.required' => 'Subject is required',
            'product_service_name.required' => 'Name is required',
        ];
        if ($request->product_service_types != null) {
            if (count($request->product_service_types) == 1) {
                if (in_array("Service", $request->product_service_types)) {
//                    $rules['service_types'] = 'required';
//                    $rules['textile_service_types'] = 'required';
                    $rules['service_durations'] = 'required';
                    $rules['suitable_currencies'] = 'required';
                    $rules['payment_terms'] = 'required';
//                    $messages['service_types.required'] = 'Please select service types';
//                    $messages['textile_service_types.required'] = 'Please select textile service types';
                    $messages['service_durations.required'] = 'Please select service durations';
                    $messages['suitable_currencies.required'] = 'Please select suitable currencies';
                    $messages['payment_terms.required'] = 'Please select payment terms';
                    if ($request->dealing_as != null && in_array("Other", $request->dealing_as)) {
                        $rules['other_dealing_as'] = 'required';
                        $messages['other_dealing_as.required'] = 'Please select dealing type';
                    }
                } else if (!in_array("Buy", $request->product_service_types)) {
                    $rules['dealing_as'] = 'required';
                    $rules['focused_selling_countries'] = 'required';
                    $rules['suitable_currencies'] = 'required';
                    $rules['payment_terms'] = 'required';
                    $messages['dealing_as.required'] = 'Please select dealing type';
                    $messages['focused_selling_countries.required'] = 'Please select focused selling countries';
                    $messages['suitable_currencies.required'] = 'Please select suitable currencies';
                    $messages['payment_terms.required'] = 'Please select payment terms';
                    if ($request->dealing_as != null && in_array("Other", $request->dealing_as)) {
                        $rules['other_dealing_as'] = 'required';
                        $messages['other_dealing_as.required'] = 'Please select dealing type';
                    }
                }
                if (!in_array('Service', $request->product_service_types)) {
                    $rules['sub_sub_category'] = 'required';
                }
            } else {
                $rules['dealing_as'] = 'required';
                $rules['focused_selling_countries'] = 'required';
                $rules['suitable_currencies'] = 'required';
                $rules['payment_terms'] = 'required';
                $messages['dealing_as.required'] = 'Please select dealing type';
                $messages['focused_selling_countries.required'] = 'Please select focused selling countries';
                $messages['suitable_currencies.required'] = 'Please select suitable currencies';
                $messages['payment_terms.required'] = 'Please select payment terms';
                if ($request->dealing_as != null && in_array("Other", $request->dealing_as)) {
                    $rules['other_dealing_as'] = 'required';
                    $messages['other_dealing_as.required'] = 'Please select dealing type';
                }
            }
            if (in_array("Sell", $request->product_service_types)) {
                $rules['sub_sub_category'] = 'required';
                $rules['product_availability'] = 'required';
                $rules['manufacturer_name'] = 'required';
                $rules['origin'] = 'required';
                $messages['product_availability.required'] = 'Please select product availability';
                $messages['manufacturer_name.required'] = 'Manufacturer name is required';
                $messages['origin.required'] = 'Please select origin';
            }
        }
        $new_category = '';
        $new_sub_category = '';
        if ($request->category) {
            $new_category = \App\Category::find($request->category)->name;
        }
        if ($request->sub_category) {
            $new_sub_category = \App\Subcategory::find($request->sub_category)->name;
        }
        if ($new_category == "Fibers & Materials") {
            if ($request->product_service_types != null && count($request->product_service_types) == 1) {
                if (!in_array("Buy", $request->product_service_types)) {
                    if ($request->after_sales_service == "Yes") {
                        $rules['service_type'] = 'required';
                        $messages['service_type.required'] = 'Type of service is required';
                    }
                    if ($request->warranty == "Yes") {
                        $rules['warranty_period'] = 'required';
                        $messages['warranty_period.required'] = 'Warranty period is required';
                    }
                    if ($request->certification == "Yes") {
                        $rules['certification_details'] = 'required';
                        $messages['certification_details.required'] = 'Certification details is required';
                    }
                }
            } else {
                if ($request->after_sales_service == "Yes") {
                    $rules['service_type'] = 'required';
                    $messages['service_type.required'] = 'Type of service is required';
                }
                if ($request->warranty == "Yes") {
                    $rules['warranty_period'] = 'required';
                    $messages['warranty_period.required'] = 'Warranty period is required';
                }
                if ($request->certification == "Yes") {
                    $rules['certification_details'] = 'required';
                    $messages['certification_details.required'] = 'Certification details is required';
                }
            }
        }
        if ($new_category == "Fibers & Materials" && $new_sub_category == "Knitted Fabric" && $request->product_service_types != null) {
            if (count($request->product_service_types) == 1) {
                if (!in_array("Buy", $request->product_service_types)) {
                    $rules['knitted_fabric_types'] = 'required';
                    $rules['knitted_knitting_types'] = 'required';
                    $rules['knitted_fabric_construction'] = 'required';
                    $rules['knitted_gsm_thickness'] = 'required';
                    $rules['knitted_width_from'] = 'required';
                    $rules['knitted_width_to'] = 'required';
                    $rules['knitted_manufact'] = 'required';
                    $rules['knitted_yarn'] = 'required';
                    $rules['knitted_features'] = 'required';
                    $rules['knitted_use'] = 'required';
                    $messages['knitted_fabric_types.required'] = 'Please select knitted fabrictype';
                    $messages['knitted_knitting_types.required'] = 'Please select knitted knitting type';
                    $messages['knitted_fabric_construction.required'] = 'Please select knitted fabric construction';
                    $messages['knitted_gsm_thickness.required'] = 'Please select knitted gsm thickness';
                    $messages['knitted_width_from.required'] = 'Knitted width is required';
                    $messages['knitted_width_to.required'] = 'Knitted width is rquired';
                    $messages['knitted_manufact.required'] = 'Please select knitted manufact';
                    $messages['knitted_yarn.required'] = 'Please select knitted yarn';
                    $messages['knitted_features.required'] = 'Please select knitted feature';
                    $messages['knitted_use.required'] = 'Please knitted use';
                    if ($request->knitted_fabric_types == "Other"){
                        $rules['other_knitted_fabric_type'] = 'required';
                        $messages['other_knitted_fabric_type.required'] = 'Other knitted fabric type is required';
                    }
                    if ($request->knitted_knitting_types == "Other") {
                        $rules['other_knitted_knitting_type'] = 'required';
                        $messages['other_knitted_knitting_type.required'] = 'Other knitted knitting type is required';
                    }
                    if ($request->knitted_features != null && in_array("Other", $request->knitted_features)) {
                        $rules['other_knitted_features'] = 'required';
                        $messages['other_knitted_features.required'] = 'Other knitted feature is required';
                    }
                    if ($request->knitted_use != null && in_array("Other", $request->knitted_use)) {
                        $rules['other_knitted_use'] = 'required';
                        $messages['other_knitted_use.required'] = 'Other knitted use is required';
                    }
                }
            } else {
                $rules['knitted_fabric_types'] = 'required';
                $rules['knitted_knitting_types'] = 'required';
                $rules['knitted_fabric_construction'] = 'required';
                $rules['knitted_gsm_thickness'] = 'required';
                $rules['knitted_width_from'] = 'required';
                $rules['knitted_width_to'] = 'required';
                $rules['knitted_manufact'] = 'required';
                $rules['knitted_yarn'] = 'required';
                $rules['knitted_features'] = 'required';
                $rules['knitted_use'] = 'required';
                $messages['knitted_fabric_types.required'] = 'Please select knitted fabrictype';
                $messages['knitted_knitting_types.required'] = 'Please select knitted knitting type';
                $messages['knitted_fabric_construction.required'] = 'Please select knitted fabric construction';
                $messages['knitted_gsm_thickness.required'] = 'Please select knitted gsm thickness';
                $messages['knitted_width_from.required'] = 'Knitted width is required';
                $messages['knitted_width_to.required'] = 'Knitted width is rquired';
                $messages['knitted_manufact.required'] = 'Please select knitted manufact';
                $messages['knitted_yarn.required'] = 'Please select knitted yarn';
                $messages['knitted_features.required'] = 'Please select knitted feature';
                $messages['knitted_use.required'] = 'Please knitted use';
                if ($request->knitted_fabric_types == "Other"){
                    $rules['other_knitted_fabric_type'] = 'required';
                    $messages['other_knitted_fabric_type.required'] = 'Other knitted fabric type is required';
                }
                if ($request->knitted_knitting_types == "Other") {
                    $rules['other_knitted_knitting_type'] = 'required';
                    $messages['other_knitted_knitting_type.required'] = 'Other knitted knitting type is required';
                }
                if ($request->knitted_features != null && in_array("Other", $request->knitted_features)) {
                    $rules['other_knitted_features'] = 'required';
                    $messages['other_knitted_features.required'] = 'Other knitted feature is required';
                }
                if ($request->knitted_use != null && in_array("Other", $request->knitted_use)) {
                    $rules['other_knitted_use'] = 'required';
                    $messages['other_knitted_use.required'] = 'Other knitted use is required';
                }
            }
        }
        if ($new_category == "Fibers & Materials" && $new_sub_category == "Woven Fabric" && $request->product_service_types != null) {
            if (count($request->product_service_types) == 1) {
                if (!in_array("Buy", $request->product_service_types)) {
                    $rules['woven_fabric_types'] = 'required';
                    $rules['woven_weave_types'] = 'required';
                    $rules['woven_fabric_construction'] = 'required';
                    $rules['woven_gsm_thickness'] = 'required';
                    $rules['woven_width_from'] = 'required';
                    $rules['woven_width_to'] = 'required';
                    $rules['woven_manufact'] = 'required';
                    $rules['woven_yarn'] = 'required';
                    $rules['woven_features'] = 'required';
                    $rules['woven_use'] = 'required';
                    $messages['woven_fabric_types.required'] = 'Please select woven fabric type';
                    $messages['woven_weave_types.required'] = 'Please select woven weave type';
                    $messages['woven_fabric_construction.required'] = 'Please select woven fabric construction';
                    $messages['woven_gsm_thickness.required'] = 'Please select woven gsm thickness';
                    $messages['woven_width_from.required'] = 'Woven width is required';
                    $messages['woven_width_to.required'] = 'Woven width is required';
                    $messages['woven_manufact.required'] = 'Please select woven manufact';
                    $messages['woven_yarn.required'] = 'Please select woven yarn';
                    $messages['woven_features.required'] = 'Please select woven feature';
                    $messages['woven_use.required'] = 'Please select woven use';
                    if ($request->woven_fabric_types == "Other"){
                        $rules['other_woven_fabric_type'] = 'required';
                        $messages['other_woven_fabric_type.required'] = 'Other woven fabric type is required';
                    }
                    if ($request->woven_weave_types == "Other") {
                        $rules['other_woven_weave_type'] = 'required';
                        $messages['other_woven_weave_type.required'] = 'Other woven weave type is required';
                    }
                    if ($request->woven_features != null && in_array("Other", $request->woven_features)) {
                        $rules['other_woven_features'] = 'required';
                        $messages['other_woven_features.required'] = 'Other woven feature is required';
                    }
                    if ($request->woven_use != null && in_array("Other", $request->woven_use)) {
                        $rules['other_woven_use'] = 'required';
                        $messages['other_woven_use.required'] = 'Other woven use is required';
                    }
                }
            } else {
                $rules['woven_fabric_types'] = 'required';
                $rules['woven_weave_types'] = 'required';
                $rules['woven_fabric_construction'] = 'required';
                $rules['woven_gsm_thickness'] = 'required';
                $rules['woven_width_from'] = 'required';
                $rules['woven_width_to'] = 'required';
                $rules['woven_manufact'] = 'required';
                $rules['woven_yarn'] = 'required';
                $rules['woven_features'] = 'required';
                $rules['woven_use'] = 'required';
                $messages['woven_fabric_types.required'] = 'Please select woven fabric type';
                $messages['woven_weave_types.required'] = 'Please select woven weave type';
                $messages['woven_fabric_construction.required'] = 'Please select woven fabric construction';
                $messages['woven_gsm_thickness.required'] = 'Please select woven gsm thickness';
                $messages['woven_width_from.required'] = 'Woven width is required';
                $messages['woven_width_to.required'] = 'Woven width is required';
                $messages['woven_manufact.required'] = 'Please select woven manufact';
                $messages['woven_yarn.required'] = 'Please select woven yarn';
                $messages['woven_features.required'] = 'Please select woven feature';
                $messages['woven_use.required'] = 'Please select woven use';
                if ($request->woven_fabric_types == "Other"){
                    $rules['other_woven_fabric_type'] = 'required';
                    $messages['other_woven_fabric_type.required'] = 'Other woven fabric type is required';
                }
                if ($request->woven_weave_types == "Other") {
                    $rules['other_woven_weave_type'] = 'required';
                    $messages['other_woven_weave_type.required'] = 'Other woven weave type is required';
                }
                if ($request->woven_features != null && in_array("Other", $request->woven_features)) {
                    $rules['other_woven_features'] = 'required';
                    $messages['other_woven_features.required'] = 'Other woven feature is required';
                }
                if ($request->woven_use != null && in_array("Other", $request->woven_use)) {
                    $rules['other_woven_use'] = 'required';
                    $messages['other_woven_use.required'] = 'Other woven use is required';
                }
            }
        }
        if ($new_category == "Fibers & Materials" && $new_sub_category == "Nonwoven Fabric" && $request->product_service_types != null) {
            if (count($request->product_service_types) == 1) {
                if (!in_array("Buy", $request->product_service_types)) {
                    $rules['non_woven_fabric_types'] = 'required';
                    $rules['non_woven_types'] = 'required';
                    $rules['non_woven_fabric_construction'] = 'required';
                    $rules['non_woven_gsm_thickness'] = 'required';
                    $rules['non_woven_width_from'] = 'required';
                    $rules['non_woven_width_to'] = 'required';
                    $rules['non_woven_manufact'] = 'required';
                    $rules['non_woven_yarn'] = 'required';
                    $rules['non_woven_features'] = 'required';
                    $rules['non_woven_use'] = 'required';
                    $messages['non_woven_fabric_types.required'] = 'Please select non woven fabric type';
                    $messages['non_woven_types.required'] = 'Please select non woven type';
                    $messages['non_woven_fabric_construction.required'] = 'Please select non woven fabric construction';
                    $messages['non_woven_gsm_thickness.required'] = 'Please select non woven gsm thickness';
                    $messages['non_woven_width_from.required'] = 'Non woven width is required';
                    $messages['non_woven_width_to.required'] = 'Non woven width is required';
                    $messages['non_woven_manufact.required'] = 'Please select non woven manufact';
                    $messages['non_woven_yarn.required'] = 'Please select non woven yarn';
                    $messages['non_woven_features.required'] = 'Please select non woven feature';
                    $messages['non_woven_use.required'] = 'Please select non woven use';
                    if ($request->non_woven_fabric_types == "Other"){
                        $rules['other_non_woven_fabric_type'] = 'required';
                        $messages['other_non_woven_fabric_type.required'] = 'Other non woven fabric type is required';
                    }
                    if ($request->non_woven_types == "Other") {
                        $rules['other_non_woven_type'] = 'required';
                        $messages['other_non_woven_type.required'] = 'Other non woven type is required';
                    }
                    if ($request->non_woven_features != null && in_array("Other", $request->non_woven_features)) {
                        $rules['other_non_woven_features'] = 'required';
                        $messages['other_non_woven_features.required'] = 'Other non woven feature is required';
                    }
                    if ($request->non_woven_use != null && in_array("Other", $request->non_woven_use)) {
                        $rules['other_non_woven_use'] = 'required';
                        $messages['other_non_woven_use.required'] = 'Other non woven use is required';
                    }
                }
            } else {
                $rules['non_woven_fabric_types'] = 'required';
                $rules['non_woven_types'] = 'required';
                $rules['non_woven_fabric_construction'] = 'required';
                $rules['non_woven_gsm_thickness'] = 'required';
                $rules['non_woven_width_from'] = 'required';
                $rules['non_woven_width_to'] = 'required';
                $rules['non_woven_manufact'] = 'required';
                $rules['non_woven_yarn'] = 'required';
                $rules['non_woven_features'] = 'required';
                $rules['non_woven_use'] = 'required';
                $messages['non_woven_fabric_types.required'] = 'Please select non woven fabric type';
                $messages['non_woven_types.required'] = 'Please select non woven type';
                $messages['non_woven_fabric_construction.required'] = 'Please select non woven fabric construction';
                $messages['non_woven_gsm_thickness.required'] = 'Please select non woven gsm thickness';
                $messages['non_woven_width_from.required'] = 'Non woven width is required';
                $messages['non_woven_width_to.required'] = 'Non woven width is required';
                $messages['non_woven_manufact.required'] = 'Please select non woven manufact';
                $messages['non_woven_yarn.required'] = 'Please select non woven yarn';
                $messages['non_woven_features.required'] = 'Please select non woven feature';
                $messages['non_woven_use.required'] = 'Please select non woven use';
                if ($request->non_woven_fabric_types == "Other"){
                    $rules['other_non_woven_fabric_type'] = 'required';
                    $messages['other_non_woven_fabric_type.required'] = 'Other non woven fabric type is required';
                }
                if ($request->non_woven_types == "Other") {
                    $rules['other_non_woven_type'] = 'required';
                    $messages['other_non_woven_type.required'] = 'Other non woven type is required';
                }
                if ($request->non_woven_features != null && in_array("Other", $request->non_woven_features)) {
                    $rules['other_non_woven_features'] = 'required';
                    $messages['other_non_woven_features.required'] = 'Other non woven feature is required';
                }
                if ($request->non_woven_use != null && in_array("Other", $request->non_woven_use)) {
                    $rules['other_non_woven_use'] = 'required';
                    $messages['other_non_woven_use.required'] = 'Other non woven use is required';
                }
            }
        }
        if ($new_category == "Fibers & Materials" && $new_sub_category == "Natural Yarn" || $new_sub_category == "Synthetic Yarn" || $new_sub_category == "Blended Yarn" || $new_sub_category == "Speciality Yarn" && $request->product_service_types != null) {
            if (count($request->product_service_types) == 1) {
                if (!in_array("Buy", $request->product_service_types)) {
                    $rules['yarn_count'] = 'required';
                    $rules['yarn_count_unit'] = 'required';
                    $rules['yarn_attribute'] = 'required';
                    $rules['yarn_technology'] = 'required';
                    $rules['yarn_grade'] = 'required';
                    $rules['count_type'] = 'required';
                    $rules['yarn_specialty'] = 'required';
                    $rules['usage_type'] = 'required';
                    $messages['yarn_count.required'] = 'Please select yarn count';
                    $messages['yarn_count_unit.required'] = 'Please select yarn count unit';
                    $messages['yarn_attribute.required'] = 'Please select attribute';
                    $messages['yarn_technology.required'] = 'Please select technology';
                    $messages['yarn_grade.required'] = 'Please select grade';
                    $messages['count_type.required'] = 'Please select count type';
                    $messages['yarn_specialty.required'] = 'Please select speciality';
                    $messages['usage_type.required'] = 'Please select usage type';
                    if ($request->yarn_count_unit == "Other"){
                        $rules['other_yarn_count_unit'] = 'required';
                        $messages['other_yarn_count_unit.required'] = 'Other count unit is required';
                    }
                    if ($request->yarn_attribute == "Other"){
                        $rules['other_yarn_attribute'] = 'required';
                        $messages['other_yarn_attribute.required'] = 'Other attribute is required';
                    }
                    if ($request->yarn_technology == "Other"){
                        $rules['other_yarn_technology'] = 'required';
                        $messages['other_yarn_technology.required'] = 'Other technology is required';
                    }

                    if ($request->count_type == "Other"){
                        $rules['other_count_type'] = 'required';
                        $messages['other_count_type.required'] = 'Other count type is required';
                    }
                    if ($request->yarn_specialty == "Other"){
                        $rules['other_yarn_speciality'] = 'required';
                        $messages['other_yarn_speciality.required'] = 'Other speciality is required';
                    }
                    if ($request->usage_type == "Other"){
                        $rules['other_usage_type'] = 'required';
                        $messages['other_usage_type.required'] = 'Other usage type is required';
                    }
                }
            } else {
                $rules['yarn_count'] = 'required';
                $rules['yarn_count_unit'] = 'required';
                $rules['yarn_attribute'] = 'required';
                $rules['yarn_technology'] = 'required';
                $rules['yarn_grade'] = 'required';
                $rules['count_type'] = 'required';
                $rules['yarn_specialty'] = 'required';
                $rules['usage_type'] = 'required';
                $messages['yarn_count.required'] = 'Please select yarn count';
                $messages['yarn_count_unit.required'] = 'Please select yarn count unit';
                $messages['yarn_attribute.required'] = 'Please select attribute';
                $messages['yarn_technology.required'] = 'Please select technology';
                $messages['yarn_grade.required'] = 'Please select grade';
                $messages['count_type.required'] = 'Please select count type';
                $messages['yarn_specialty.required'] = 'Please select speciality';
                $messages['usage_type.required'] = 'Please select usage type';
                if ($request->yarn_count_unit == "Other"){
                    $rules['other_yarn_count_unit'] = 'required';
                    $messages['other_yarn_count_unit.required'] = 'Other count unit is required';
                }
                if ($request->yarn_attribute == "Other"){
                    $rules['other_yarn_attribute'] = 'required';
                    $messages['other_yarn_attribute.required'] = 'Other attribute is required';
                }
                if ($request->yarn_technology == "Other"){
                    $rules['other_yarn_technology'] = 'required';
                    $messages['other_yarn_technology.required'] = 'Other technology is required';
                }

                if ($request->count_type == "Other"){
                    $rules['other_count_type'] = 'required';
                    $messages['other_count_type.required'] = 'Other count type is required';
                }
                if ($request->yarn_specialty == "Other"){
                    $rules['other_yarn_speciality'] = 'required';
                    $messages['other_yarn_speciality.required'] = 'Other speciality is required';
                }
                if ($request->usage_type == "Other"){
                    $rules['other_usage_type'] = 'required';
                    $messages['other_usage_type.required'] = 'Other usage type is required';
                }
            }
        }
        if ($new_category == "Fibers & Materials" && $new_sub_category == "Natural Fibre" || $new_sub_category == "Manmade Fibre"  && $request->product_service_types != null) {
            if (count($request->product_service_types) == 1) {
                if (!in_array("Buy", $request->product_service_types)) {
                    $rules['purpose'] = 'required';
                    $rules['size'] = 'required';
                    $messages['purpose.required'] = 'Please select fiber type';
                    $messages['size.required'] = 'Please select fiber size';

                    if ($request->purpose == "Other"){
                        $rules['other_purpose'] = 'required';
                        $messages['other_purpose.required'] = 'Other fiber type is required';
                    }
                }
            } else {
                $rules['purpose'] = 'required';
                $rules['size'] = 'required';
                $messages['purpose.required'] = 'Please select fiber type';
                $messages['size.required'] = 'Please select fiber size';

                if ($request->purpose == "Other"){
                    $rules['other_purpose'] = 'required';
                    $messages['other_purpose.required'] = 'Other fiber type is required';
                }
            }
        }
        if ($new_category == "PPE & Institutional" && $request->product_service_types != null) {
            if (count($request->product_service_types) == 1) {
                if (!in_array("Buy", $request->product_service_types)) {
                    $rules['material'] = 'required';
                    $rules['composition'] = 'required';
                    $rules['size_age_group'] = 'required';
                    $rules['colour'] = 'required';
                    $messages['material.required'] = 'Please select material type';
                    $messages['composition.required'] = 'Please select composition';
                    $messages['size_age_group.required'] = 'Please select size';
                    $messages['colour.required'] = 'Please select color';

                }
            } else {
                $rules['material'] = 'required';
                $rules['composition'] = 'required';
                $rules['size_age_group'] = 'required';
                $rules['colour'] = 'required';
                $messages['material.required'] = 'Please select material type';
                $messages['composition.required'] = 'Please select composition';
                $messages['size_age_group.required'] = 'Please select size';
                $messages['colour.required'] = 'Please select color';
            }
        }
        if ($new_category == "Garments & Accessories" && $request->product_service_types != null) {
            if (count($request->product_service_types) == 1) {
                if (!in_array("Buy", $request->product_service_types)) {
                    $rules['material_type'] = 'required';
                    $rules['construction'] = 'required';
                    $rules['size_age'] = 'required';
                    $rules['color'] = 'required';
                    $messages['material_type.required'] = 'Please select material type';
                    $messages['construction.required'] = 'Please select construction';
                    $messages['size_age.required'] = 'Please select age';
                    $messages['color.required'] = 'Please select color';

                }
            } else {
                $rules['material_type'] = 'required';
                $rules['construction'] = 'required';
                $rules['size_age'] = 'required';
                $rules['color'] = 'required';
                $messages['material_type.required'] = 'Please select material type';
                $messages['construction.required'] = 'Please select construction';
                $messages['size_age.required'] = 'Please select age';
                $messages['color.required'] = 'Please select color';
            }
        }
        if ($new_category == "Dyes & Chemicals" && $request->product_service_types != null) {
            if (count($request->product_service_types) == 1) {
                if (!in_array("Buy", $request->product_service_types)) {
                    $rules['manufacturer_name'] = '';
                    $rules['origin'] = '';
                    for ($i = 1; $i <= $request->company_counter; $i++) {
                        /*$rules['manufacturer_company_name' . $i] = 'required';
                        $rules['origin' . $i] = 'required';*/
                        /*                        $rules['chemicals_listed' . $i] = 'required';
                                                $rules['supply_type' . $i] = 'required';*/
                        $messages['manufacturer_company_name' . $i . '.required'] = 'Manufacturer company name is required';
                        $messages['origin' . $i . '.required'] = 'Origin is required';
                        $messages['chemicals_listed' . $i . '.required'] = 'Chemicals listed is required';
                        $messages['supply_type' . $i . '.required'] = 'Please select supply type';
                    }
                }
            } else {
                $rules['manufacturer_name'] = '';
                $rules['origin'] = '';
                for ($i = 1; $i <= $request->company_counter; $i++) {
                    /*$rules['manufacturer_company_name' . $i] = 'required';
                    $rules['origin' . $i] = 'required';*/
                    /*                    $rules['chemicals_listed' . $i] = 'required';
                                        $rules['supply_type' . $i] = 'required';*/
                    $messages['manufacturer_company_name' . $i . '.required'] = 'Manufacturer company name is required';
                    $messages['origin' . $i . '.required'] = 'Origin is required';
                    $messages['chemicals_listed' . $i . '.required'] = 'Chemicals listed is required';
                    $messages['supply_type' . $i . '.required'] = 'Please select supply type';
                }
            }
        }

        $validator = \Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            // return $validator->errors()->getMessages();
            return json_encode(['feedback' => 'validation_error', 'errors' => $validator->errors()->getMessages(),]);
        }
        if ($product->product_manufacturer) {
            $product->product_manufacturer()->delete();
        }
//        if ($product->product_images) {
//            $product->product_images()->delete();
//        }
//        if ($product->product_specifications) {
//            $product->product_specifications()->delete();
//        }
        if ($product->machinery_product_info) {
            $product->machinery_product_info()->delete();
        }
        if ($product->fabric_product_info) {
            $product->fabric_product_info()->delete();
        }
        if ($product->yarn_product_info) {
            $product->yarn_product_info()->delete();
        }
        if ($product->fiber_product_info) {
            $product->fiber_product_info()->delete();
        }
        if ($product->institutional_product_info) {
            $product->institutional_product_info()->delete();
        }
        if ($product->garments_product_info) {
            $product->garments_product_info()->delete();
        }
        if ($product->chemicals_product_infos) {
            $product->chemicals_product_infos()->delete();
        }
        if ($product->variation != null) {
            if ($product->variation == "Machinery & Parts") {
                $product->machinery_product_info()->delete();
            } else if ($product->variation == "PPE & Institutional") {
                $product->institutional_product_info()->delete();
            } else if ($product->variation == "Garments & Accessories") {
                $product->garments_product_info()->delete();
            } else if ($product->variation == "Knitted Fabric" || $product->variation == "Woven Fabric" || $product->variation == "Nonwoven Fabric") {
                $product->fabric_product_info()->delete();
            } else if ($product->variation == "Natural Yarn" || $product->variation == "Synthetic Yarn" || $product->variation == "Blended Yarn" || $product->variation == "Speciality Yarn") {
                $product->yarn_product_info()->delete();
            } else if ($product->variation == "Natural Fibre" || $product->variation == "Manmade Fibre") {
                $product->fiber_product_info()->delete();
            } else {
                $product->chemicals_product_infos()->delete();
            }
        }
        $product->company_id = session()->get('company_id');
        $product->product_service_types = implode(',', $request->product_service_types);
        $product->category_id = $request->category;
        $product->product_certification = $request->product_certification;

        $product->subcategory_id = $request->sub_category;

        $product->childsubcategory_id = $request->sub_sub_category;
        $product->add_sub_sub_category = $request->add_sub_sub_category;

        $product->subject = $request->subject;
        $product->keyword1 = $request->keyword1;
        $product->keyword2 = $request->keyword2;
        $product->keyword3 = $request->keyword3;
        $product->product_service_name = $request->product_service_name;
        $product->product_availability = $request->product_availability;
        $product->origin = $request->origin;
        $product->details = $request->details;
        $product->updatedBy = Auth::user()->id;
        if (in_array("Service", $request->product_service_types)) {
            $product->dealing_as = "Service Provider";
        } else {
            $product->delivery = $request->delivery;
            if ($request->dealing_as != null) {
                $product->dealing_as = implode(',', $request->dealing_as);
                if (in_array("Other", $request->dealing_as)) {
                    $product->other_dealing_as = $request->other_dealing_as;
                }
            }
        }
        if ($request->focused_selling_countries != null) {
            $product->focused_selling_countries = implode(',', $request->focused_selling_countries);
        }
        $product->focused_selling_region = $request->focused_selling_region;
        $product->production_capacity = $request->production_capacity;
        $product->min_order_quantity = $request->min_order_quantity;
        if ($request->min_order_quantity) {
//            $product->min_order_quantity_unit = $request->min_order_quantity_unit;
            $product->min_order_quantity_unit = '';
        }
        if ($request->is_sampling == '1') {
            $product->is_sampling = $request->is_sampling;
            $product->sampling_type = $request->sampling_type;
            if ($request->sampling_type == 'Paid') {
                $product->paid_sampling_price = $request->paid_sampling_price;
            }
        }else{
            $product->is_sampling = null;
            $product->sampling_type = $request->sampling_type;
            if ($request->sampling_type == 'Paid') {
                $product->paid_sampling_price = null;
            }
            if ($request->sampling_type == 'Free') {
                $product->paid_sampling_price = null;
            }
        }
        if ($request->service_durations != null) {
            $product->service_durations = implode(',', $request->service_durations);
            if (in_array("Other", $request->service_durations)) {
                $product->other_service_duration = $request->other_service_duration;
            }
        }

        if (in_array("Sell", $request->product_service_types)) {
            $product->unit_price_from = $request->unit_price_from;
            $product->unit_price_to = $request->unit_price_to;
            $product->unit_price_unit = $request->unit_price_unit;
            if ($request->unit_price_unit != null && $request->unit_price_unit == 'Other') {
                $product->other_unit_price_unit = $request->other_unit_price_unit;
            }
        }
        if (in_array("Service", $request->product_service_types)) {
            $product->unit_price_from = $request->unit_price_from;
            $product->unit_price_to = $request->unit_price_to;
            $product->unit_price_unit = 'Other';
            $product->other_unit_price_unit = $request->other_unit_price_unitt;

        }
        if (in_array("Buy", $request->product_service_types)) {
            $product->target_price_from = $request->target_price_from;
            $product->target_price_to = $request->target_price_to;
            $product->target_price_unit = $request->target_price_unit;
            if ($request->target_price_unit != null && $request->target_price_unit == 'Other') {
                $product->other_target_price_unit = $request->other_target_price_unit;
            }
        }

        $product->suitable_currencies = $request->suitable_currencies;
        if ($request->suitable_currencies == "Other") {
            $product->other_suitable_currency = $request->other_suitable_currency;
        }

        $product->payment_terms = $request->payment_terms;
        if ($request->payment_terms == "Other") {
            $product->other_payment_term = $request->other_payment_term;
        }
        $product->delivery_time = $request->delivery_time;
//        dd($product);
        $product->variation = null;

        $images =  [$request->avatar1_url,$request->avatar2_url,$request->avatar3_url,$request->avatar4_url,$request->avatar5_url,$request->avatar6_url,$request->avatar7_url,$request->avatar8_url,$request->avatar9_url,$request->avatar10_url,$request->avatar11_url,$request->avatar12_url,$request->avatar13_url,$request->avatar14_url,$request->avatar15_url];
        foreach ($images as $image) {
            if ($image) {
                \App\ProductImage::create(['product_id' => $product->id, 'image' => $image]);
            }
        }

        $sheets =  [$request->sheet16_url,$request->sheet17_url,$request->sheet18_url,$request->sheet19_url,$request->sheet20_url,$request->sheet21_url,$request->sheet22_url,$request->sheet23_url,$request->sheet24_url,$request->sheet25_url,$request->sheet26_url,$request->sheet27_url,$request->sheet28_url,$request->sheet29_url,$request->sheet30_url];
        foreach ($sheets as $sheet){
            if ($sheet) {
                \App\ProductSpecification::create([
                    'product_id' => $product->id,
                    'sheet' => $sheet
                ]);
            }
        }

        if ($product->save()) {
            if (in_array("Sell", $request->product_service_types) || in_array("Buy", $request->product_service_types)) {
                if ($request->manufacturer_name != null) {
                    $product_manufacturer = new \App\ProductManufacturer();
                    $product_manufacturer->user_id = \Auth()->user()->id;
                    $product_manufacturer->product_id = $product->id;
                    $product_manufacturer->manufacturer_name = $request->manufacturer_name;
                    $product->product_manufacturer()->save($product_manufacturer);
                }
            }
            if ($new_category == "Machinery & Parts") {
                $machinery_product_info = new \App\MachineryProductInfo();
                $machinery_product_info->product_id = $product->id;
                $machinery_product_info->product_type = $request->product_type;
                $machinery_product_info->machinery_condition = $request->machinery_condition;
                $machinery_product_info->after_sales_service = $request->after_sales_service;
                if ($request->after_sales_service == "Yes") {
                    $machinery_product_info->service_type = $request->service_type;
                }
                $machinery_product_info->warranty = $request->warranty;
                if ($request->warranty == "Yes") {
                    $machinery_product_info->warranty_period = $request->warranty_period;
                }
                $machinery_product_info->certification = $request->certification;
                if ($request->certification == "Yes") {
                    $machinery_product_info->certification_details = $request->certification_details;
                }
                $machinery_product_info->additional_trade_notes = $request->additional_trade_notes;
                $machinery_product_info->product_related_certifications = $request->product_related_certifications;
                $product->machinery_product_info()->save($machinery_product_info);
                $product->variation = $new_category;
                $product->save();
            } else if ($new_category == "Fibers & Materials" && $new_sub_category == "Knitted Fabric") {
                $fabric_product_info = new \App\FabricProductInfo();
                $fabric_product_info->product_id = $product->id;

                $fabric_product_info->fabric_types = $request->knitted_fabric_types;
                if ($request->knitted_fabric_types == "Other") {
                    $fabric_product_info->other_fabric_type = $request->other_knitted_fabric_type;
                }

                $fabric_product_info->knitting_type = $request->knitted_knitting_types;
                if ($request->knitted_knitting_types == "Other") {
                    $fabric_product_info->other_knitting_type = $request->other_knitted_knitting_type;
                }
                $fabric_product_info->fabric_construction = $request->knitted_fabric_construction;
                $fabric_product_info->gsm_thickness = $request->knitted_gsm_thickness;
                $fabric_product_info->fabric_composition = $request->knitted_fabric_composition;

                $fabric_product_info->width_from = $request->knitted_width_from;
                $fabric_product_info->width_to = $request->knitted_width_to;

                $fabric_product_info->manufacturing_technique = $request->knitted_manufact;
                if ($fabric_product_info->manufacturing_technique == 'Other') {
                    $fabric_product_info->other_manufacturing_technique = $request->other_knitted_manufact;
                }

                $fabric_product_info->yarn_type = $request->knitted_yarn;
                if ($fabric_product_info->yarn_type == 'Other') {
                    $fabric_product_info->other_yarn_type = $request->other_knitted_yarn_type;
                }
                $fabric_product_info->features = implode(',', $request->knitted_features);
                if (in_array("Other", $request->knitted_features)) {
                    $fabric_product_info->other_feature = $request->other_knitted_features;
                }
                $fabric_product_info->uses = implode(',', $request->knitted_use);
                if (in_array("Other", $request->knitted_use)) {
                    $fabric_product_info->other_use = $request->other_knitted_use;
                }
                $product->fabric_product_info()->save($fabric_product_info);
                $product->variation = $new_sub_category;
                $product->save();
            } else if ($new_category == "Fibers & Materials" && $new_sub_category == "Nonwoven Fabric") {
                $fabric_product_info = new \App\FabricProductInfo();
                $fabric_product_info->product_id = $product->id;

                $fabric_product_info->fabric_types = $request->non_woven_fabric_types;
                if ($request->non_woven_fabric_types == "Other") {
                    $fabric_product_info->other_fabric_type = $request->other_non_woven_fabric_type;
                }

                $fabric_product_info->non_woven_types = $request->non_woven_types;
                if ($request->non_woven_types == "Other") {
                    $fabric_product_info->other_non_woven_type = $request->other_non_woven_type;
                }
                $fabric_product_info->fabric_construction = $request->non_woven_fabric_construction;
                $fabric_product_info->gsm_thickness = $request->non_woven_gsm_thickness;
                $fabric_product_info->fabric_composition = $request->non_woven_fabric_composition;

                $fabric_product_info->width_from = $request->non_woven_width_from;
                $fabric_product_info->width_to = $request->non_woven_width_to;

                $fabric_product_info->manufacturing_technique = $request->non_woven_manufact;
                if ($fabric_product_info->manufacturing_technique == 'Other') {
                    $fabric_product_info->other_manufacturing_technique = $request->other_non_woven_manufact;
                }

                $fabric_product_info->yarn_type = $request->non_woven_yarn;
                if ($fabric_product_info->yarn_type == 'Other') {
                    $fabric_product_info->other_yarn_type = $request->other_non_woven_yarn;
                }
                $fabric_product_info->features = implode(',', $request->non_woven_features);
                if (in_array("Other", $request->non_woven_features)) {
                    $fabric_product_info->other_feature = $request->other_non_woven_features;
                }
                $fabric_product_info->uses = implode(',', $request->non_woven_use);
                if (in_array("Other", $request->non_woven_use)) {
                    $fabric_product_info->other_use = $request->other_non_woven_use;
                }
                $product->fabric_product_info()->save($fabric_product_info);
                $product->variation = $new_sub_category;
                $product->save();
            } else if ($new_category == "Fibers & Materials" && $new_sub_category == "Woven Fabric") {
                $fabric_product_info = new \App\FabricProductInfo();
                $fabric_product_info->product_id = $product->id;

                $fabric_product_info->fabric_types = $request->woven_fabric_types;
                if ($request->woven_fabric_types == "Other") {
                    $fabric_product_info->other_fabric_type = $request->other_woven_fabric_type;
                }

                $fabric_product_info->weave_types = $request->woven_weave_types;
                if ($request->woven_weave_types == "Other") {
                    $fabric_product_info->other_weave_type = $request->other_woven_weave_type;
                }
                $fabric_product_info->fabric_construction = $request->woven_fabric_construction;
                $fabric_product_info->gsm_thickness = $request->woven_gsm_thickness;
                $fabric_product_info->fabric_composition = $request->woven_fabric_composition;

                $fabric_product_info->width_from = $request->woven_width_from;
                $fabric_product_info->width_to = $request->woven_width_to;

                $fabric_product_info->manufacturing_technique = $request->woven_manufact;
                if ($fabric_product_info->manufacturing_technique == 'Other') {
                    $fabric_product_info->other_manufacturing_technique = $request->other_woven_manufact;
                }

                $fabric_product_info->yarn_type = $request->woven_yarn;
                if ($fabric_product_info->yarn_type == 'Other') {
                    $fabric_product_info->other_yarn_type = $request->other_woven_yarn;
                }
                $fabric_product_info->features = implode(',', $request->woven_features);
                if (in_array("Other", $request->woven_features)) {
                    $fabric_product_info->other_feature = $request->other_woven_features;
                }
                $fabric_product_info->uses = implode(',', $request->woven_use);
                if (in_array("Other", $request->woven_use)) {
                    $fabric_product_info->other_use = $request->other_woven_use;
                }
                $product->fabric_product_info()->save($fabric_product_info);
                $product->variation = $new_sub_category;
                $product->save();
            } else if ($new_category == "Fibers & Materials" && $new_sub_category == "Natural Yarn" || $new_sub_category == "Synthetic Yarn" || $new_sub_category == "Blended Yarn" || $new_sub_category == "Speciality Yarn") {
                $yarn_product_info = new \App\YarnProductInfo();
                $yarn_product_info->product_id = $product->id;
                $yarn_product_info->count = $request->yarn_count;

                $yarn_product_info->count_unit = $request->yarn_count_unit;
                if ($request->yarn_count_unit == "Other") {
                    $yarn_product_info->other_count_unit = $request->other_yarn_count_unit;
                }
                $yarn_product_info->attribute = $request->yarn_attribute;
                if ($request->yarn_attribute == "Other") {
                    $yarn_product_info->other_attribute = $request->other_yarn_attribute;
                }
                $yarn_product_info->technology = $request->yarn_technology;
                if ($request->yarn_technology == "Other") {
                    $yarn_product_info->other_technology = $request->other_yarn_technology;
                }

                $yarn_product_info->grade = $request->yarn_grade;
                $yarn_product_info->tpi = $request->tpi;
                $yarn_product_info->tenacity = $request->tenacity;

                $yarn_product_info->count_type = $request->count_type;
                if ($yarn_product_info->count_type == 'Other') {
                    $yarn_product_info->other_count_type = $request->other_count_type;
                }

                $yarn_product_info->yarn_specialty = $request->yarn_specialty;
                if ($yarn_product_info->yarn_specialty == 'Other') {
                    $yarn_product_info->other_speciality = $request->other_yarn_speciality;
                }
                $yarn_product_info->end_use = $request->usage_type;
                if ($yarn_product_info->end_use == 'Other') {
                    $yarn_product_info->other_end_use = $request->other_usage_type;
                }

                $product->yarn_product_info()->save($yarn_product_info);
                $product->variation = $new_sub_category;
                $product->save();
            } else if ($new_category == "Fibers & Materials" && $new_sub_category == "Natural Fibre" || $new_sub_category == "Manmade Fibre") {
                $fiber_product_info = new \App\FiberProductInfo();

                $fiber_product_info->product_id = $product->id;

                $fiber_product_info->fiber_type = $request->purpose;
                if ($fiber_product_info->fiber_type == 'Other') {
                    $fiber_product_info->other_fiber_type = $request->other_purpose;
                }

                $fiber_product_info->size = $request->size;
                $fiber_product_info->strength = $request->strength;
                $fiber_product_info->end_use = $request->end_app;

                $product->fiber_product_info()->save($fiber_product_info);
                $product->variation = $new_sub_category;
                $product->save();
            } else if ($new_category == "PPE & Institutional") {
                $institutional_product_info = new \App\InstitutionalProductInfo();

                $institutional_product_info->product_id = $product->id;

                $institutional_product_info->material = $request->material;
                $institutional_product_info->composition = $request->composition;
                $institutional_product_info->size_age = $request->size_age_group;
                $institutional_product_info->color = $request->colour;
                $institutional_product_info->gender = $request->gender;
                $institutional_product_info->thickness = $request->thickness;
                $institutional_product_info->brand = $request->brand;
                $institutional_product_info->design = $request->design;
                $institutional_product_info->season = $request->season;
                $institutional_product_info->end_use = $request->use_end;

                $product->institutional_product_info()->save($institutional_product_info);
                $product->variation = $new_category;
                $product->save();

            } else if ($new_category == "Garments & Accessories") {
                $garments_product_info = new \App\GarmentsProductInfo();

                $garments_product_info->product_id = $product->id;
                $garments_product_info->material = $request->material_type;
                $garments_product_info->composition = $request->construction;
                $garments_product_info->size_age = $request->size_age;
                $garments_product_info->color = $request->color;
                $garments_product_info->gender = $request->garments_gender;
                $garments_product_info->thickness = $request->thickness_gsm_width;
                $garments_product_info->brand = $request->garments_brand;
                $garments_product_info->design = $request->design_style;
                $garments_product_info->season = $request->garments_season;
                $garments_product_info->end_use = $request->end_use_app;

                $product->garments_product_info()->save($garments_product_info);
                $product->variation = $new_category;
                $product->save();
            } else if ($new_category == "Dyes & Chemicals") {
                for ($i = 1; $i <= $request->company_counter; $i++) {
                    $chemicals_product_infos = new \App\ChemicalsProductInfo();
                    $chemicals_product_infos->manufacturer_company_name = request('manufacturer_company_name' . $i);
                    $chemicals_product_infos->origin = request('origin' . $i);
                    $chemicals_product_infos->chemicals_listed = request('chemicals_listed' . $i);
                    $chemicals_product_infos->supply_type = request('supply_type' . $i);
                    $chemicals_product_infos->company_additional_info = request('company_additional_info' . $i);
                    $product->chemicals_product_infos()->save($chemicals_product_infos);
                }
                $product->variation = $new_category;
                $product->save();
            }
            return json_encode([
                'feedback' => 'updated', 'url' => route('products.edit', $product), 'product_id' => $product->id,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->product_manufacturer) {
            $product->product_manufacturer()->delete();
        }
        if ($product->product_images) {
            $product->product_images()->delete();
        }
        if ($product->product_specifications) {
            $product->product_specifications()->delete();
        }
        if ($product->variation != null) {
            if ($product->variation == "Textile Machinery") {
                $product->machinery_product_info()->delete();
            } else if ($product->variation == "Fabric") {
                $product->fabric_product_info()->delete();
            } else if ($product->variation == "Yarn") {
                $product->yarn_product_info()->delete();
            } else {
                $product->chemicals_product_infos()->delete();
            }
        }
        if ($product->delete()) {
            json_encode(['feedback' => 'success', 'msg' => 'Product has been removed successfully',]);
        }
        return Redirect::back();

    }

    public function get_sub_categories(Request $request)
    {
        $output = "";
        if ($request->category_type == "sub") {
            $output = "<option value='' selected disabled> ---- Select Sub-Category --- </option>";
            foreach (\App\Subcategory::where('category_id', \App\Category::where('id', $request->category)->first()->id)->get() as $category) {
                $output .= '<option value="' . $category->id . '" cat-val="' . $category->name . '">' . $category->name . '</option>';
            }
        } else {
            $output = "<option value='' selected disabled> ---- Select Sub-Sub-Category --- </option>";
            foreach (\App\Childsubcategory::where('subcategory_id', \App\Subcategory::where('id', $request->sub_category)->first()->id)->orderBy('created_at')->get() as $category) {
                $output .= '<option value="' . $category->id . '" cat-val="' . $category->name . '">' . $category->name . '</option>';
            }
        }
        return json_encode(['feedback' => 'success', 'output' => $output,]);
    }

    public function upload_sheet(Request $request)
    {
        if($request->hasFile('sheet')){

            $sheet = $request->file('sheet');
            $sheet_name = rand(1000, 9999999) . time() . '.' . $sheet->getClientOriginalExtension();
            $sheet->storeAs('leads/sheets/',$sheet_name,'s3');
            $path = 'leads/sheets'.'/'.$sheet_name;
            $url = Storage::disk('s3')->url($path);
            return response()->json(['url'=>$url]);
        }
//        if($request->file){
//            $sheet = $request->file('file');
//            $sheet_name = rand(1000, 999999) . time() . '.' . $sheet->getClientOriginalExtension();
//            $sheet->storeAs('leads/sheets/',$sheet_name,'s3');
//            $path = 'leads/sheets'.'/'.$sheet_name;
//            $url = Storage::disk('s3')->url($path);
//            \App\ProductSpecification::create(['sheet' => $url, 'product_id' => $request->productId,]);
//        }
    }

    public function upload_image(Request $request)
    {

        if($request->hasFile('avatar')){

            $image = $request->file('avatar');
            $image_name = rand(1000, 9999999) . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('leads/images/',$image_name,'s3');
            $path = 'leads/images'.'/'.$image_name;
            $url = Storage::disk('s3')->url($path);
            return response()->json(['url'=>$url]);
//
//            $image = request()->file('avatar');
//            $imageName = rand(1000, 999999) . time() . '.' . $image->getClientOriginalExtension();
//            $img = Image::make($image);
//            $img->resize(379, 295, function ($constraint) {
//                $constraint->aspectRatio();
//            });
//            //detach method is the key! Hours to find it... :/
//            $resource = $img->stream()->detach();
//            \Illuminate\Support\Facades\Storage::disk('s3')->put('leads/images/' . $imageName, $resource);
//            $url = Storage::disk('s3')->url('leads/images'.'/'.$imageName);
//            return response()->json(['url'=>$url]);
        }
    }

    public function sheetRemove($id)
    {
        $image = \App\ProductSpecification::find($id);;
        if (\File::delete(Storage::disk('s3')->url($image->image))) {
            $image->delete();
            return json_encode(['msg' => true]);
        }
    }

    public function imageRemove($id)
    {
        $image = \App\ProductImage::find($id);;
        if (\File::delete(Storage::disk('s3')->url($image->image))) {
            $image->delete();
            return json_encode(['msg' => true]);
        }
    }


    public function delete(Product $product)
    {
//        dd($product->id);

        $this->_product->deleteProduct($product->id);
        $res = $product->delete();
//        dd($res);
//        Session::flash('message', 'Product delete successfully');
        return Redirect::back();

    }

    public function remove_product_image()
    {
        try {
            $img_id = decrypt(request('img_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        $prodId =\App\ProductImage::where('id',$img_id)->first();
        $prodImage =\App\ProductImage::where('product_id',$prodId->product_id)->count();
        if ($prodImage>1) {

            DB::delete('delete from product_images where id = ?', [$img_id]);
            $data['feedback'] = 'true';
            $data['msg'] = 'Product Image has been removed successfully';
        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Sorry you cannot delete last image';
        }

        return json_encode($data);

    }

    public function remove_product_sheet()
    {
        try {
            $sheet_id = decrypt(request('sheet_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($sheet_id) {

            DB::delete('delete from product_specifications where id = ?', [$sheet_id]);
            $data['feedback'] = 'true';
            $data['msg'] = 'Product specification has been removed successfully';
        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);

    }

    public function archive_product(Request $request)
    {
        try {
            $product_id = decrypt(request('product_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($product_id) {
            $product = \App\Product::withTrashed()->find($product_id);
            if ($product) {
                if ($product->trashed()) {
                    if ($product->product_manufacturer) {
                        $product->product_manufacturer()->delete();
                    }
                    if ($product->product_images) {
                        $product->product_images()->delete();
                    }
                    if ($product->product_specifications) {
                        $product->product_specifications()->delete();
                    }
                    if ($product->variation != null) {
                        if ($product->variation == "Textile Machinery") {
                            $product->machinery_product_info()->delete();
                        } else if ($product->variation == "Fabric") {
                            $product->fabric_product_info()->delete();
                        } else if ($product->variation == "Yarn") {
                            $product->yarn_product_info()->delete();
                        } else {
                            $product->chemicals_product_infos()->delete();
                        }
                    }
                    $product->forceDelete();
                } else {
                    $product->updatedBy = \Auth()->user()->id;
                    $product->save();
                    $product->delete();
                }
                $data['feedback'] = 'true';
                $data['msg'] = 'Product has been archived successfully';
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

    public function restore_product(Request $request)
    {
        try {
            $product_id = decrypt(request('product_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($product_id) {
            $product = \App\Product::onlyTrashed()->find($product_id);
            if ($product) {
                $product->updatedBy = \Auth()->user()->id;
                $product->save();
                $product->restore();
                $data['feedback'] = 'true';
                $data['msg'] = 'Product has been restored successfully';
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

}

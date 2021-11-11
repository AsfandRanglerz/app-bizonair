<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Subcategory;
use App\View;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;

class ServiceController extends Controller
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

    public function service_list_by_category($slug)
    {
        $cat = \App\Category::where('slug', $slug)->where('type', 'Services')->first();
        $subcategories = \App\Subcategory::where('category_id',$cat->id)->get();

        $topbizleadservice = \App\Product::select('products.*', 'products.created_at as creation_date')->where('category_id', $cat->id)->where('product_service_types', 'Service')->with('product_image')->whereNull('deleted_at')->orderBy('is_featured','DESC')->latest()->limit(6)->get();


        $topbuysellservice = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->where('date_expire','>', now())->where('product_service_types','Service')->where('category_id', $cat->id)->whereNull('deleted_at')->orderBy('is_featured','DESC')->latest()->limit(10)->get();

        $categories = $this->_category->getAllCompanies();

        $geturl = url()->current();
        $urlslug = ucwords(str_replace('-', ' ', basename($geturl)));

        $topcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->limit(2)->latest()->get();

//        $company_ids = Product::where('product_service_types', 'Service')->where('category_id', $cat->id)->distinct('company_id')->get()->pluck('company_id');
//        $companies = \App\CompanyProfile::whereIn('id',$company_ids)->get();
        $companies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->get();

        $ads = \App\Banner::where('dimension', 'width 1146 * height 161')->where('description','1st image')->where('page','Textile Service')->where('status', 1)->limit(1)->get();
        $textile_partners = \App\TextilePartner::all();
        return view('front_site.product.service-listing', compact('topcompanies','companies','topbizleadservice','topbuysellservice', 'subcategories','urlslug','categories','ads','textile_partners'));
    }


    public function serviceDetail($category, $subcategory ,$slug)
    {
        # code...
        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();
        $data['category'] = $data['sub_category']->category;

        // $product = $this->_product->getProduct($id)->with('product_image');
        $product = \App\Product::where('slug', $slug)->with('product_image')->with('product_manufacturer')->first();
        if($product){
            $view = new View();
            $view->prod_id= $product->id;
            $view->type = 'Lead';
            $view->ip= \Request::getClientIp();
            $view->save();

            $country = new Countries();
            $data['countries'] = $country->all();

            $osdts = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types', 'Service')->where('company_id', $product->company_id)->with('product_image')->whereNull('deleted_at')->where('id','!=',$product->id)->latest()->paginate(15);

            $ssdos = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types', 'Service')->where('subcategory_id',$product->subcategory_id)->where('company_id', '!=', $product->company_id)->with('product_image')->whereNull('deleted_at')->where('id','!=',$product->id)->latest()->paginate(15);

            $sdfc = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types', 'Service')->where('subcategory_id',$product->subcategory_id)->where('origin', $product->origin)->with('product_image')->whereNull('deleted_at')->where('id','!=',$product->id)->latest()->paginate(15);
            $cats = \App\Category::where('type', 'Services')->get();

            $ads = \App\Banner::where('dimension', 'width 295 * height 295')->where('description','1st row right sidebar')->where('page','Textile Services Detail')->where('status', 1)->limit(1)->get();
            $ads1 = \App\Banner::where('dimension', 'width 295 * height 295')->where('description','2nd row right sidebar')->where('page','Textile Services Detail')->where('status', 1)->limit(1)->get();
            return view('front_site.product.service-regular-detail', $data, compact('category','subcategory','slug','cats', 'product', 'osdts', 'ssdos','sdfc','ads','ads1'));

        }else{
            $product = \DB::table('buy_sells')->where('slug', $slug)->first();

            $view = new View();
            $view->buysell_id= $product->id;
            $view->type = 'Deal';
            $view->ip= \Request::getClientIp();
            $view->save();

            $country = new Countries();
            $data['countries'] = $country->all();

            $osdts = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->where('date_expire','>', now())->where('product_service_types', 'Service')->where('user_id', $product->user_id)->whereNull('deleted_at')->where('id','!=',$product->id)->latest()->paginate(15);

            $ssdos = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->where('date_expire','>', now())->where('product_service_types', 'Service')->where('subcategory_id',$product->subcategory_id)->where('user_id', '!=', $product->user_id)->whereNull('deleted_at')->where('id','!=',$product->id)->latest()->paginate(15);

            $sdfc = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->where('date_expire','>', now())->where('product_service_types', 'Service')->where('subcategory_id',$product->subcategory_id)->where('origin', $product->origin)->whereNull('deleted_at')->where('id','!=',$product->id)->latest()->paginate(15);
            $cats = \App\Category::where('type', 'Services')->get();
            $ads = \App\Banner::where('dimension', 'width 295 * height 295')->where('description','1st row right sidebar')->where('page','Textile Services Detail')->where('status', 1)->limit(1)->get();
            $ads1 = \App\Banner::where('dimension', 'width 295 * height 295')->where('description','2nd row right sidebar')->where('page','Textile Services Detail')->where('status', 1)->limit(1)->get();
            return view('front_site.product.service-onetime-detail', $data, compact('category','subcategory','slug','cats', 'product', 'osdts', 'ssdos','sdfc','ads','ads1'));

        }


    }

    public function service_list_by_subcategory_regular_service($category, $subcategory)
    {
        $cat = \App\Category::where('slug', $category)->where('type', 'Services')->first();
        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();
        $data['category'] = $data['sub_category']->category;

        $country = new Countries();
        $data['countries'] = $country->all();

        $products = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types', 'Service')->where('subcategory_id', $subcatid)->with('product_image')->whereNull('deleted_at')->latest()->get();
        $viewCount = count($products);

        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();
        $topcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->limit(2)->latest()->get();
        return view('front_site.product.service-list-by-subcategory-regular', $data,compact('topcompanies','category', 'viewCount', 'subcategory', 'products', 'cats'));

    }

    public function service_list_by_subcategory_one_time_service($category, $subcategory)
    {
        $cat = \App\Category::where('slug', $category)->where('type', 'Services')->first();
        $sub_category = \App\Subcategory::where('slug', $subcategory);
        $subcatid = $sub_category->pluck('id');
        $data['sub_category'] = $sub_category->with('category')->first();
        $data['category'] = $data['sub_category']->category;

        $country = new Countries();
        $data['countries'] = $country->all();

        $products = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->where('date_expire','>', now())->where('product_service_types','Service')->where('subcategory_id', $subcatid)->whereNull('deleted_at')->latest()->get();
        $viewCount = count($products);

        $cats = \App\Category::where('type', 'Business')->orderBy('priority')->get();
        $topcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->limit(2)->latest()->get();
        return view('front_site.product.service-list-by-subcategory-one-time', $data,compact('topcompanies','category', 'viewCount', 'subcategory', 'products', 'cats'));

    }

    public function view_all_regular_service($slug)
    {

        $cat = \App\Category::where('slug', $slug)->where('type', 'Services')->first();

        $geturl = url()->current();
        $urlslug = ucwords(str_replace('-', ' ', basename($geturl)));

        $subcategories = \App\Subcategory::where('category_id', $cat->id)->get();

        $categories = $this->_category->getAllCompanies();
        $cats = \App\Category::where('type', 'Services')->orderBy('priority')->get();

        if(str_contains(url()->full(), '?status=all')){
            $toptensellproduct = \App\Product::select('products.*', 'products.created_at as creation_date')->where('product_service_types', 'Service')->with('product_image')->whereNull('deleted_at')->orderBy('is_featured','DESC')->latest()->limit(6)->get();
            $top_6 = array_unique(\Arr::pluck($toptensellproduct,'id'));
            $topsellproduct = \App\Product::select('products.*', 'products.created_at as creation_date')->whereNotIn('id',$top_6)->where('product_service_types', 'Service')->with('product_image')->whereNull('deleted_at')->get();
        }else{
            $toptensellproduct = \App\Product::select('products.*', 'products.created_at as creation_date')->where('category_id', $cat->id)->where('product_service_types', 'Service')->with('product_image')->whereNull('deleted_at')->orderBy('is_featured','DESC')->latest()->limit(6)->get();
            $top_6 = array_unique(\Arr::pluck($toptensellproduct,'id'));
            $topsellproduct = \App\Product::select('products.*', 'products.created_at as creation_date')->where('category_id', $cat->id)->whereNotIn('id',$top_6)->where('product_service_types', 'Service')->with('product_image')->whereNull('deleted_at')->get();
        }
        $topcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->limit(2)->latest()->get();

//        $company_ids = Product::where('product_service_types', 'Service')->where('category_id', $cat->id)->distinct('company_id')->get()->pluck('company_id');
//        $companies = \App\CompanyProfile::whereIn('id',$company_ids)->get();
        $companies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->get();
        $textile_partners = \App\TextilePartner::all();
        return view('front_site.view-all.view-all-regular-service', compact('textile_partners','companies','topcompanies','cats',  'topsellproduct', 'toptensellproduct', 'subcategories', 'urlslug', 'categories'));
    }

    public function view_all_service_deals($slug)
    {

        $cat = \App\Category::where('slug', $slug)->where('type', 'Services')->first();

        $geturl = url()->current();
        $urlslug = ucwords(str_replace('-', ' ', basename($geturl)));
        $subcategories = \App\Subcategory::where('category_id', $cat->id)->get();
        $categories = $this->_category->getAllCompanies();
        $cats = \App\Category::where('type', 'Services')->orderBy('priority')->get();

        $buyselltopten_selling = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->where('date_expire','>', now())->where('product_service_types','Service')->where('category_id', $cat->id)->whereNull('deleted_at')->orderBy('is_featured','DESC')->latest()->limit(6)->get();
        $top_6 = array_unique(\Arr::pluck($buyselltopten_selling,'id'));
        $buysell_selling = \DB::table('buy_sells')->select('buy_sells.*', 'buy_sells.created_at as creation_date')->whereNotIn('id',$top_6)->where('date_expire','>', now())->where('product_service_types','Service')->where('category_id', $cat->id)->whereNull('deleted_at')->get();

        $topcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->limit(2)->latest()->get();

//        $company_ids = Product::where('product_service_types', 'Service')->where('category_id', $cat->id)->distinct('company_id')->get()->pluck('company_id');
//        $companies = \App\CompanyProfile::whereIn('id',$company_ids)->get();
        $companies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->get();
        $textile_partners = \App\TextilePartner::all();
        return view('front_site.view-all.view-all-service-deals', compact('textile_partners','topcompanies','companies','cats','buyselltopten_selling', 'buysell_selling', 'subcategories', 'urlslug', 'categories'));
    }

    public function view_all_companies($slug)
    {
        $cat = \App\Category::where('slug', $slug)->first();
        $allcompanies = \App\CompanyProfile::whereHas('industry',function ($q) use($cat){
            $q->where('categories.id',$cat->id);
        })->latest()->get();
        return view('front_site.view-all.view-all-companies', compact('allcompanies'));
    }

}

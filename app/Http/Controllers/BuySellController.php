<?php

namespace App\Http\Controllers;
use App\BuySell;
use App\Http\Middleware\User;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Subcategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use PragmaRX\Countries\Package\Countries;

class BuySellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $_category;
    private $_subcategory;
    private $_buysell;

    function __construct(Category $category, Subcategory $subcategory, BuySell $buysell)
    {

        $this->_category = $category;
        $this->buysell = $buysell;
        $this->_subcategory = $subcategory;
    }

    public function index(Request $request)
    {
        $user = Auth()->user();
        if ($request->case && $request->case == 'archive') {
            $buysells = \App\BuySell::onlyTrashed()->where('user_id', $user->id)->orderBy('id', 'desc')->get();
        } else {
            $buysells = \App\BuySell::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        }
        return view('front_site.buy-sell.index', compact('user', 'buysells', 'request'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()){
            $user = Auth()->user();
            $country = new Countries();
            $countries = $country->all();
            return view('front_site.buy-sell.create', compact('user', 'countries'));
        }else{
            return \redirect()->route('log-in-pre');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());


        $rules = [
            'product_service_types' => 'required', 'category' => 'required', 'sub_category' => 'required',
            'subject' => 'required','expiry_date' => 'required',
            'product_service_name' => 'required',
        ];
        $messages = [
            'product_service_types.required' => 'Please select product and service type',
            'category.required' => 'Please select a category',
            'sub_category.required' => 'Please select a sub-category',
            'sub_sub_category.required' => 'Please select a child-sub-category',
            'subject.required' => 'Subject is required',
            'expiry_date.required' => 'Expiry date is required',
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
                    $rules['suitable_currencies'] = 'required';
                    $rules['payment_terms'] = 'required';
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
                $rules['suitable_currencies'] = 'required';
                $rules['payment_terms'] = 'required';
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

        $validator = \Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            // return $validator->errors()->getMessages();
            return json_encode(['feedback' => 'validation_error', 'errors' => $validator->errors()->getMessages(),]);
        }
        $buysell = new \App\BuySell();
        $buysell->user_id = \Auth::user()->id;
        $buysell->product_service_types = implode(',', $request->product_service_types);
        $buysell->category_id = $request->category;
        $buysell->product_certification = $request->product_certification;

        $buysell->subcategory_id = $request->sub_category;

        $buysell->childsubcategory_id = $request->sub_sub_category;
        $buysell->add_sub_sub_category = $request->add_sub_sub_category;

        $buysell->reference_no = mt_rand(5000000,10000000);
        $buysell->slug = Str::slug($request->product_service_name) . "-" . $buysell->reference_no;

        $buysell->subject = $request->subject;

        $buysell->keyword1 = $request->keyword1;
        $buysell->keyword2 = $request->keyword2;
        $buysell->keyword3 = $request->keyword3;
        $buysell->product_service_name = $request->product_service_name;
        $buysell->product_availability = $request->product_availability;
        $buysell->expiry_data = $request->expiry_date;
        $bdate = now()->addDays($request->expiry_date);
        $buysell->date_expire = $bdate;

        $buysell->available_unit = $request->available_unit;
        if ($request->available_unit != null && $request->available_unit == 'Other') {
            $buysell->other_available_unit = $request->other_available_unit;
        }
//        $buysell->price = $request->price;
        $buysell->origin = $request->origin;
        $buysell->details = $request->details;

        $buysell->city = auth()->user()->city;
        $buysell->country = auth()->user()->country;
        $buysell->is_certified = 0;
        $buysell->is_featured = 0;
        $buysell->createdBy = Auth::user()->id;
        $buysell->updated_at = null;
        $buysell->save();

        $images =  [$request->bavatar1_url,$request->bavatar2_url,$request->bavatar3_url,$request->bavatar4_url,$request->bavatar5_url,$request->bavatar6_url,$request->bavatar7_url,$request->bavatar8_url,$request->bavatar9_url,$request->bavatar10_url,$request->bavatar11_url,$request->bavatar12_url,$request->bavatar13_url,$request->bavatar14_url,$request->bavatar15_url];
        foreach ($images as $image) {
            if ($image) {
                \App\BuysellImage::create(['buy_sell_id' => $buysell->id, 'image' => $image]);
            }
        }

        $sheets =  [$request->bsheet16_url,$request->bsheet17_url,$request->bsheet18_url,$request->bsheet19_url,$request->bsheet20_url,$request->bsheet21_url,$request->bsheet22_url,$request->bsheet23_url,$request->bsheet24_url,$request->bsheet25_url,$request->bsheet26_url,$request->bsheet27_url,$request->bsheet28_url,$request->bsheet29_url,$request->bsheet30_url];
        foreach ($sheets as $sheet){
            if ($sheet) {
                \App\BuySellSpecification::create([
                    'buy_sell_id' => $buysell->id,
                    'sheet' => $sheet
                ]);
            }
        }

        if (in_array("Service", $request->product_service_types)) {
            $buysell->dealing_as = "Service Provider";
        } else {
            $buysell->delivery = $request->delivery;
            if ($request->dealing_as != null) {
                $buysell->dealing_as = implode(',', $request->dealing_as);
                if (in_array("Other", $request->dealing_as)) {
                    $buysell->other_dealing_as = $request->other_dealing_as;
                }
            }
        }
        if ($request->focused_selling_countries != null) {
            $buysell->focused_selling_countries = implode(',', $request->focused_selling_countries);
        }
        $buysell->focused_selling_region = $request->focused_selling_region;
        $buysell->production_capacity = $request->production_capacity;
        $buysell->min_order_quantity = $request->min_order_quantity;
//        if ($request->min_order_quantity) {
////            $buysell->min_order_quantity_unit = $request->min_order_quantity_unit;
//            $buysell->min_order_quantity_unit = '';
//        }
        if ($request->is_sampling == '1') {
            $buysell->is_sampling = $request->is_sampling;
            $buysell->sampling_type = $request->sampling_type;
            if ($request->sampling_type == 'Paid') {
                $buysell->paid_sampling_price = $request->paid_sampling_price;
            }
        }
        if ($request->service_durations != null) {
            $buysell->service_durations = implode(',', $request->service_durations);
            if (in_array("Other", $request->service_durations)) {
                $buysell->other_service_duration = $request->other_service_duration;
            }
        }

        if (in_array("Sell", $request->product_service_types)) {
            $buysell->unit_price_from = $request->unit_price_from;
            $buysell->unit_price_to = $request->unit_price_to;
            $buysell->unit_price_unit = $request->unit_price_unit;
            if ($request->unit_price_unit != null && $request->unit_price_unit == 'Other') {
                $buysell->other_unit_price_unit = $request->other_unit_price_unit;
            }
        }

        if (in_array("Service", $request->product_service_types)) {
            $buysell->unit_price_from = $request->unit_price_from;
            $buysell->unit_price_to = $request->unit_price_to;
            $buysell->unit_price_unit = $request->price_unit;
        }

        if (in_array("Buy", $request->product_service_types)) {
            $buysell->target_price_from = $request->target_price_from;
            $buysell->target_price_to = $request->target_price_to;
            $buysell->target_price_unit = $request->target_price_unit;
            if ($request->target_price_unit != null && $request->target_price_unit == 'Other') {
                $buysell->other_target_price_unit = $request->other_target_price_unit;
            }
        }

        $buysell->suitable_currencies = $request->suitable_currencies;
        if ($request->suitable_currencies == "Other") {
            $buysell->other_suitable_currency = $request->other_suitable_currency;
        }
        if ($request->payment_terms) {
            $buysell->payment_terms = $request->payment_terms;
        }
        if ($request->payment_terms =="Other") {
            $buysell->other_payment_term = $request->other_payment_term;
        }
        $buysell->delivery_time = $request->delivery_time;

        $buysell->variation = null;
        if ($buysell->save()) {
            if ($new_category == "Machinery & Parts") {
                $machinery_buy_sell_infos = new \App\MachineryBuySellInfo();
                $machinery_buy_sell_infos->buy_sell_id = $buysell->id;
                $machinery_buy_sell_infos->brand_name = $request->brand_name;
                $machinery_buy_sell_infos->model_no = $request->model_number;
                $machinery_buy_sell_infos->year_manufacture = $request->year_manufacturing;
                $machinery_buy_sell_infos->after_sales_service = $request->after_sales_service;
                if ($request->after_sales_service == "Yes") {
                    $machinery_buy_sell_infos->service_type = $request->service_type;
                }
                $machinery_buy_sell_infos->warranty = $request->warranty;
                if ($request->warranty == "Yes") {
                    $machinery_buy_sell_infos->warranty_period = $request->warranty_period;
                }
                $machinery_buy_sell_infos->certification = $request->certification;
                if ($request->certification == "Yes") {
                    $machinery_buy_sell_infos->certification_details = $request->certification_details;
                }
                $machinery_buy_sell_infos->additional_trade_notes = $request->additional_trade_notes;
                $machinery_buy_sell_infos->product_related_certifications = $request->product_related_certifications;
                $buysell->machineryBuySellInfo()->save($machinery_buy_sell_infos);
                $buysell->variation = $new_category;
                $buysell->updated_at = null;
                $buysell->save();
            }

            return json_encode([
                'feedback' => 'created', 'url' => route('buy-sell.index'), 'buysell_id' => $buysell->id,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \Auth()->user();
        $buysell = \App\BuySell::where('id',$id)->first();
        $country = new Countries();
        $countries = $country->all();
        return view('front_site.buy-sell.edit', compact('user', 'buysell','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'product_service_types' => 'required', 'category' => 'required', 'sub_category' => 'required',
            'subject' => 'required','expiry_date' => 'required',
            'product_service_name' => 'required',
        ];
        $messages = [
            'product_service_types.required' => 'Please select product and service type',
            'category.required' => 'Please select a category',
            'sub_category.required' => 'Please select a sub-category',
            'sub_sub_category.required' => 'Please select a child-sub-category',
            'subject.required' => 'Subject is required',
            'expiry_date.required' => 'Expiry date is required',
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
                    $rules['suitable_currencies'] = 'required';
                    $rules['payment_terms'] = 'required';
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
                $rules['suitable_currencies'] = 'required';
                $rules['payment_terms'] = 'required';
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

        $validator = \Validator::make(request()->all(), $rules, $messages);
        if ($validator->fails()) {
            // return $validator->errors()->getMessages();
            return json_encode(['feedback' => 'validation_error', 'errors' => $validator->errors()->getMessages(),]);
        }
        $buysell = \App\BuySell::find($id);
//        dd($buysell);
//        if ($buysell->buysell_images) {
//            $buysell->buysell_images()->delete();
//        }
//        if ($buysell->buysell_specifications) {
//            $buysell->buysell_specifications()->delete();
//        }
        if ($buysell->machineryBuySellInfo) {
            $buysell->machineryBuySellInfo()->delete();
        }
        if ($buysell->variation != null) {
            if ($buysell->variation == "Machinery & Parts") {
                $buysell->machineryBuySellInfo()->delete();
            }
        }

        $buysell->user_id = \Auth::user()->id;
        $buysell->product_service_types = implode(',', $request->product_service_types);
        $buysell->category_id = $request->category;
        $buysell->product_certification = $request->product_certification;

        $buysell->subcategory_id = $request->sub_category;

        $buysell->childsubcategory_id = $request->sub_sub_category;
        $buysell->add_sub_sub_category = $request->add_sub_sub_category;

        $buysell->subject = $request->subject;
        $buysell->keyword1 = $request->keyword1;
        $buysell->keyword2 = $request->keyword2;
        $buysell->keyword3 = $request->keyword3;

        $buysell->product_service_name = $request->product_service_name;
        $buysell->product_availability = $request->product_availability;
        $buysell->expiry_data = $request->expiry_date;
        $bdate = now()->addDays($request->expiry_date);
        $buysell->date_expire = $bdate;
        $buysell->available_unit = $request->available_unit;
        $buysell->other_available_unit = $request->other_available_unit;
        $buysell->available_unit = $request->available_unit;
        if ($request->available_unit != null && $request->available_unit == 'Other') {
            $buysell->other_available_unit = $request->other_available_unit;
        }
//        $buysell->price = $request->price;
        $buysell->origin = $request->origin;
        $buysell->details = $request->details;
        $buysell->updatedBy = Auth::user()->id;
        if (in_array("Service", $request->product_service_types)) {
            $buysell->dealing_as = "Service Provider";
        } else {
            $buysell->delivery = $request->delivery;
            if ($request->dealing_as != null) {
                $buysell->dealing_as = implode(',', $request->dealing_as);
                if (in_array("Other", $request->dealing_as)) {
                    $buysell->other_dealing_as = $request->other_dealing_as;
                }
            }
        }
        if ($request->focused_selling_countries != null) {
            $buysell->focused_selling_countries = implode(',', $request->focused_selling_countries);
        }
        $buysell->focused_selling_region = $request->focused_selling_region;
        $buysell->production_capacity = $request->production_capacity;
        $buysell->min_order_quantity = $request->min_order_quantity;
        if ($request->min_order_quantity) {
//            $buysell->min_order_quantity_unit = $request->min_order_quantity_unit;
            $buysell->min_order_quantity_unit = '';
        }
        if ($request->is_sampling == '1') {
            $buysell->is_sampling = $request->is_sampling;
            $buysell->sampling_type = $request->sampling_type;
            if ($request->sampling_type == 'Paid') {
                $buysell->paid_sampling_price = $request->paid_sampling_price;
            }
        }
        if ($request->service_durations != null) {
            $buysell->service_durations = implode(',', $request->service_durations);
            if (in_array("Other", $request->service_durations)) {
                $buysell->other_service_duration = $request->other_service_duration;
            }
        }

        if (in_array("Sell", $request->product_service_types)) {
            $buysell->unit_price_from = $request->unit_price_from;
            $buysell->unit_price_to = $request->unit_price_to;
            $buysell->unit_price_unit = $request->unit_price_unit;
            if ($request->unit_price_unit != null && $request->unit_price_unit == 'Other') {
                $buysell->other_unit_price_unit = $request->other_unit_price_unit;
            }
        }
        if (in_array("Service", $request->product_service_types)) {
            $buysell->unit_price_from = $request->unit_price_from;
            $buysell->unit_price_to = $request->unit_price_to;
            $buysell->unit_price_unit = $request->price_unit;

        }
        if (in_array("Buy", $request->product_service_types)) {
            $buysell->target_price_from = $request->target_price_from;
            $buysell->target_price_to = $request->target_price_to;
            $buysell->target_price_unit = $request->target_price_unit;
            if ($request->target_price_unit != null && $request->target_price_unit == 'Other') {
                $buysell->other_target_price_unit = $request->other_target_price_unit;
            }
        }

        $buysell->suitable_currencies = $request->suitable_currencies;
        if ($request->suitable_currencies == "Other") {
            $buysell->other_suitable_currency = $request->other_suitable_currency;
        }
        $buysell->payment_terms = $request->payment_terms;
        if ($request->payment_terms == "Other") {
            $buysell->other_payment_term = $request->other_payment_term;
        }
        $buysell->delivery_time = $request->delivery_time;
//        dd($buysell);
        $buysell->variation = null;
        $images =  [$request->bavatar1_url,$request->bavatar2_url,$request->bavatar3_url,$request->bavatar4_url,$request->bavatar5_url,$request->bavatar6_url,$request->bavatar7_url,$request->bavatar8_url,$request->bavatar9_url,$request->bavatar10_url,$request->bavatar11_url,$request->bavatar12_url,$request->bavatar13_url,$request->bavatar14_url,$request->bavatar15_url];
        foreach ($images as $image) {
            if ($image) {
                \App\BuysellImage::create(['buy_sell_id' => $buysell->id, 'image' => $image]);
            }
        }

        $sheets =  [$request->bsheet16_url,$request->bsheet17_url,$request->bsheet18_url,$request->bsheet19_url,$request->bsheet20_url,$request->bsheet21_url,$request->bsheet22_url,$request->bsheet23_url,$request->bsheet24_url,$request->bsheet25_url,$request->bsheet26_url,$request->bsheet27_url,$request->bsheet28_url,$request->bsheet29_url,$request->bsheet30_url];
        foreach ($sheets as $sheet){
            if ($sheet) {
                \App\BuySellSpecification::create([
                    'buy_sell_id' => $buysell->id,
                    'sheet' => $sheet
                ]);
            }
        }
        $buysell->save();
        if ($buysell->save()) {
            if ($new_category == "Machinery & Parts") {
                $machinery_buy_sell_infos = new \App\MachineryBuySellInfo();
                $machinery_buy_sell_infos->buy_sell_id = $buysell->id;
                $machinery_buy_sell_infos->brand_name = $request->brand_name;
                $machinery_buy_sell_infos->model_no = $request->model_number;
                $machinery_buy_sell_infos->year_manufacture = $request->year_manufacturing;
                $machinery_buy_sell_infos->after_sales_service = $request->after_sales_service;
                if ($request->after_sales_service == "Yes") {
                    $machinery_buy_sell_infos->service_type = $request->service_type;
                }
                $machinery_buy_sell_infos->warranty = $request->warranty;
                if ($request->warranty == "Yes") {
                    $machinery_buy_sell_infos->warranty_period = $request->warranty_period;
                }
                $machinery_buy_sell_infos->certification = $request->certification;
                if ($request->certification == "Yes") {
                    $machinery_buy_sell_infos->certification_details = $request->certification_details;
                }
                $machinery_buy_sell_infos->additional_trade_notes = $request->additional_trade_notes;
                $machinery_buy_sell_infos->product_related_certifications = $request->product_related_certifications;

                $buysell->machineryBuySellInfo()->save($machinery_buy_sell_infos);
                $buysell->variation = $new_category;
                $buysell->updated_at = null;
                $buysell->save();
            }

            return json_encode([
                'feedback' => 'updated', 'url' => route('buy-sell.edit', $buysell), 'buysell_id' => $buysell->id,
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BuySell $buysell)
    {
//        if ($buysell->product_manufacturer) {
//            $buysell->product_manufacturer()->delete();
//        }
        if ($buysell->product_images) {
            $buysell->buysell_images()->delete();
        }
        if ($buysell->product_specifications) {
            $buysell->product_specifications()->delete();
        }
//        if ($buysell->variation != null) {
//            if ($buysell->variation == "Textile Machinery") {
//                $buysell->machinery_product_info()->delete();
//            } else if ($buysell->variation == "Fabric") {
//                $buysell->fabric_product_info()->delete();
//            } else if ($buysell->variation == "Yarn") {
//                $buysell->yarn_product_info()->delete();
//            } else {
//                $buysell->chemicals_product_infos()->delete();
//            }
//        }
        if ($buysell->delete()) {
            json_encode(['feedback' => 'success', 'msg' => 'Buy Sell has been removed successfully',]);
        }
        return Redirect::back();

    }

    public function upload_sheet_buysell(Request $request)
    {
        if($request->hasFile('sheet')){
//            $sheet = $request->file('file');
//            $sheet_name = rand(1000, 999999) . time() . '.' . $sheet->getClientOriginalExtension();
//            $sheet->storeAs('deals/sheets/',$sheet_name,'s3');
//            $path = 'deals/sheets'.'/'.$sheet_name;
//            $url = Storage::disk('s3')->url($path);
//            \App\BuySellSpecification::create(['sheet' => $url, 'buy_sell_id' => $request->buysellId,]);


            $sheet = request()->file('sheet');
            $sheet_name = rand(1000, 9999999) . time() . '.' . $sheet->getClientOriginalExtension();
            $sheet->storeAs('deals/sheets/',$sheet_name,'s3');
            $path = 'deals/sheets'.'/'.$sheet_name;
            $url = Storage::disk('s3')->url($path);
            return response()->json(['url'=>$url]);
        }

    }

    public function upload_image_buysell(Request $request)
    {
        if($request->hasFile('avatar')){
            $image = request()->file('avatar');
            $imageName = rand(1000, 999999) . time() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image);
            $img->resize(379, 295, function ($constraint) {
                $constraint->aspectRatio();
            });
            //detach method is the key! Hours to find it... :/
            $resource = $img->stream()->detach();
            Storage::disk('s3')->put('deals/images/' . $imageName, $resource);
            $url = Storage::disk('s3')->url('deals/images'.'/'.$imageName);
            return response()->json(['url'=>$url]);


//            $image = request()->file('file');
//            $imageName = rand(1000, 999999) . time() . '.' . $image->getClientOriginalExtension();
//            $img = Image::make($image);
//            $img->resize(379, 295, function ($constraint) {
//                $constraint->aspectRatio();
//            });
//            //detach method is the key! Hours to find it... :/
//            $resource = $img->stream()->detach();
//            Storage::disk('s3')->put('deals/images/' . $imageName, $resource);
//            $url = Storage::disk('s3')->url('deals/images'.'/'.$imageName);
//            \App\BuysellImage::create(['image' => $url, 'buy_sell_id' => $request->buysellId,]);
        }

    }

    public function remove_buysell_sheet()
    {
        try {
            $sheet_id = decrypt(request('sheet_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($sheet_id) {

            DB::delete('delete from buy_sell_specifications where id = ?', [$sheet_id]);
            $data['feedback'] = 'true';
            $data['msg'] = 'Buysell specification has been removed successfully';
        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }

        return json_encode($data);
    }

    public function remove_buysell_image()
    {
        try {
            $img_id = decrypt(request('img_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        $prodId =\App\BuysellImage::where('id',$img_id)->first();
        $prodImage =\App\BuysellImage::where('buy_sell_id',$prodId->buy_sell_id)->count();
        if ($prodImage>1) {

            DB::delete('delete from buysell_images where id = ?', [$img_id]);
            $data['feedback'] = 'true';
            $data['msg'] = 'Buysell Image has been removed successfully';
        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Sorry you cannot delete last image';
        }

        return json_encode($data);
    }

    public function archive_buysell(Request $request)
    {
        try {
            $buysell_id = decrypt(request('buysell_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($buysell_id) {
            $buysell = \App\BuySell::withTrashed()->find($buysell_id);
            if ($buysell) {
                if ($buysell->trashed()) {
//                    if ($buysell->product_manufacturer) {
//                        $buysell->product_manufacturer()->delete();
//                    }
                    if ($buysell->product_images) {
                        $buysell->product_images()->delete();
                    }
                    if ($buysell->product_specifications) {
                        $buysell->product_specifications()->delete();
                    }
                    if ($buysell->variation != null) {
                        if ($buysell->variation == "Textile Machinery") {
                            $buysell->machinery_product_info()->delete();
                        }
                    }
                    $buysell->forceDelete();
                } else {
                    $buysell->updatedBy = \Auth()->user()->id;
                    $buysell->save();
                    $buysell->delete();
                }
                $data['feedback'] = 'true';
                $data['msg'] = 'Buy Sell has been archived successfully';
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

    public function restore_buysell(Request $request)
    {
        try {
            $buysell_id = decrypt(request('buysell_id'));
        } catch (\RuntimeException $e) {
            return json_encode(['feedback' => 'encrypt_issue', 'msg' => 'Something Went Wrong']);
        }
        if ($buysell_id) {
            $buysell = \App\BuySell::onlyTrashed()->find($buysell_id);
            if ($buysell) {
                $buysell->updatedBy = \Auth()->user()->id;
                $buysell->save();
                $buysell->restore();
                $data['feedback'] = 'true';
                $data['msg'] = 'Buy Sell has been restored successfully';
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

    public function get_subcategories(Request $request)
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

    public function repost_buysell(Request $request)
    {
        $buysell = \App\BuySell::where('id',$request->prod_id)->first();
        if ($buysell) {
            $mydate = date("d-m-Y");
            $daystosum = $buysell->expiry_data;
//                $datesum = date('d-m-Y', strtotime($mydate.' + '.$daystosum.' days'));
            $datesum = now()->addDays($daystosum);
            $unexpiredate = \App\BuySell::find($buysell->id);
            $unexpiredate->date_expire = $datesum;
            $unexpiredate->save();
            $data['feedback'] = 'true';
            $data['msg'] = 'Expiry Date has been extended successfully';
        } else {
            $data['feedback'] = 'false';
            $data['msg'] = 'Something went Wrong';
        }
        return json_encode($data);
    }
}

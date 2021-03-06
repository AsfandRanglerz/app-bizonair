<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Journal;
use App\NewsManagement;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;

class JournalController extends Controller
{
    public function journal()
    {
        $data['articles'] = \App\Journal::where('journal_type_name','Articles')->orderBy('publish_date', 'desc')->where('status',1)->limit(3)->get();
        $data['events'] = \App\Journal::where('journal_type_name','Upcomming Events')->orderBy('publish_date', 'desc')->where('status',1)->limit(3)->get();
        $data['news'] =\DB::table('news_management')->orderBy('publish_date', 'desc')->where('status',1)->get()->take(3);
        $data['sprojects'] = \App\Journal::where('journal_type_name','Student Projects')->orderBy('publish_date', 'desc')->where('status',1)->limit(3)->get();
        $data['ads'] = \App\Blog::where('id', 3)->first();
        $data['ads1'] = \App\Blog::where('id', 2)->first();
        $data['page'] = 'journals.journal';
        return view('front_site.' . $data['page'])->with($data);
    }

    public function privacy_policy()
    {
        $data = \DB::table('add_pages')
            ->where('id', '=', 2)
            ->get();
        return view('front_site.privacy.privacy-policy',compact('data'));
    }

    public function about_us()
    {
        $data = \DB::table('add_pages')
            ->where('id', '=', 4)
            ->get();
        return view('front_site.about-us.about-us',compact('data'));
    }

    public function faq()
    {
        $data = \DB::table('add_pages')
            ->where('id', '=', 3)
            ->get();
        return view('front_site.faq.faq',compact('data'));
    }

    public function articles()
    {
        $data['articles'] = \App\Journal::where('status',1)->where('journal_type_name','Articles')->orderBy('publish_date', 'desc')->where('status',1)->get();
        $data['page'] = 'journals.articles';
        return view('front_site.' . $data['page'])->with($data);
    }

    public function events()
    {
        $data['articles'] = \App\Journal::where('status',1)->where('journal_type_name','Upcomming Events')->orderBy('publish_date', 'desc')->where('status',1)->get();
        $data['page'] = 'journals.events';
        return view('front_site.' . $data['page'])->with($data);
    }

    public function projects()
    {
        $data['articles'] = \App\Journal::where('status',1)->where('journal_type_name','Student Projects')->orderBy('publish_date', 'desc')->where('status',1)->get();
        $data['page'] = 'journals.projects';
        return view('front_site.' . $data['page'])->with($data);
    }

    public function news()
    {
        $data = \DB::table('news_management')->orderBy('publish_date', 'desc')->where('status',1)->get();
        return view('front_site.journals.news',compact('data'));
    }
    public function news_detail($id)
    {
        $data = \DB::table('news_management')->where('id','=',$id)->get();
        $related = NewsManagement::where('id','<>',$data[0]->id)->where('title','Like','%'.$data[0]->title.'%')->latest()->take(3)->where('status',1)->get();
        $latest = NewsManagement::latest()->take(3)->where('status',1)->get();
        $ads = \App\Banner::where('dimension', 'width 265.75 * height 265.75')->where('description','1st row right sidebar news 1st image')->where('page','Journal')->where('status', 1)->limit(1)->get();
        return view('front_site.journals.news-detail',compact('data','related','latest','ads'));
    }

    public function blogs()
    {
        $data = \DB::table('blogs')->where('status',1)->orderBy('publish_date', 'desc')->get();
        return view('front_site.journals.blog',compact('data'));
    }

    public function blog_detail($id)
    {
        $data = \DB::table('blogs')->where('id','=',$id)->get();
        $related = Blog::where('id','<>',$data[0]->id)->where('title','Like','%'.$data[0]->title.'%')->latest()->take(3)->where('status',1)->get();
        $latest = Blog::latest()->take(3)->where('status',1)->get();
        $ads = \App\Banner::where('dimension', 'width 265.75 * height 265.75')->where('description','1st row right sidebar blogs 1st image')->where('page','Journal')->where('status', 1)->limit(1)->get();
        return view('front_site.journals.blog-detail',compact('data','related','latest','ads'));
    }

    public function journal_detail($type, $id)
    {
        $data['journal'] = \App\Journal::where('id',$id)->where('journal_type_name',$type)->where('status',1)->get();
        $data['latest'] = Journal::where('journal_type_name',$type)->latest()->take(3)->where('status',1)->get();
        $data['related'] = Journal::where('id','!=',$data['journal'][0]->id)->where('journal_type_name',$type)->where('title','Like','%'.$data['journal'][0]->title.'%')->take(3)->where('status',1)->get();

        if($type == 'Articles') {
            $data['ads'] = \App\Banner::where('dimension', 'width 265.75 * height 265.75')->where('description', '1st row right sidebar articles 1st image')->where('page', 'Journal')->where('status', 1)->limit(1)->get();
        }elseif($type == 'Upcomming Events'){
            $data['ads'] = \App\Banner::where('dimension', 'width 265.75 * height 265.75')->where('description', '1st row right sidebar upcomming events 1st image')->where('page', 'Journal')->where('status', 1)->limit(1)->get();
        }else{
            $data['ads'] = \App\Banner::where('dimension', 'width 265.75 * height 265.75')->where('description', '1st row right sidebar student projects 1st image')->where('page', 'Journal')->where('status', 1)->limit(1)->get();
        }

        $data['page'] = 'journals.journal-detail';
        return view('front_site.' . $data['page'])->with($data);
    }

    public function contact()
    {
        $country = new Countries();
        $countries = $country->all();
        return view('front_site.contact.contact',compact('countries'));
    }

    public function terms()
    {
        $data = \DB::table('add_pages')
            ->where('id', '=', 1)
            ->get();
        return view('front_site.terms.terms',compact('data'));
    }
    public function currency_rates()
    {
        $ads = \App\Banner::where('dimension', 'width 291 * height 291')->where('description','1st row right sidebar currency rates 1st image')->where('page','Journal')->where('status', 1)->limit(1)->get();
        $ads1 = \App\Banner::where('dimension', 'width 291 * height 291')->where('description','2nd row right sidebar currency rates 2nd image')->where('page','Journal')->where('status', 1)->limit(1)->get();
        return view('front_site.journals.currency-rates',compact('ads','ads1'));
    }

    public function cotton_rates()
    {
        $data = \App\Cottonrate::all();
        $ads = \App\Banner::where('dimension', 'width 291 * height 291')->where('description','1st row right sidebar cotton rates 1st image')->where('page','Journal')->where('status', 1)->limit(1)->get();
        $ads1 = \App\Banner::where('dimension', 'width 291 * height 291')->where('description','2nd row right sidebar cotton rates 2nd image')->where('page','Journal')->where('status', 1)->limit(1)->get();
        return view('front_site.journals.cotton-rates',compact('data','ads','ads1'));
    }
    public function yarn_rates()
    {
        $data = \App\Yarnrate::orderBy('priority', 'asc')->get();
        $ads = \App\Banner::where('dimension', 'width 291 * height 291')->where('description','1st row right sidebar yarn rates 1st image')->where('page','Journal')->where('status', 1)->limit(1)->get();
        $ads1 = \App\Banner::where('dimension', 'width 291 * height 291')->where('description','2nd row right sidebar yarn rates 2nd image')->where('page','Journal')->where('status', 1)->limit(1)->get();
        return view('front_site.journals.yarn-rates',compact('ads','ads1','data'));
    }

    public function calculation_formula()
    {
        $ads = \App\Banner::where('dimension', 'width 225 * height 82')->where('description','1st row left sidebar textile calculation 1st image')->where('page','Journal')->where('status', 1)->limit(1)->get();
        $ads1 = \App\Banner::where('dimension', 'width 225 * height 225')->where('description','2nd row left sidebar textile calculation 2nd image')->where('page','Journal')->where('status', 1)->limit(1)->get();
        return view('front_site.journals.calculation-formula',compact('ads','ads1'));
    }
}

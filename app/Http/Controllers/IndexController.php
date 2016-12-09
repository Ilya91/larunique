<?php

namespace App\Http\Controllers;

use App\Page;
use App\People;
use App\Portfolio;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function execute(Request $request){

        $pages = Page::all();
        $portfolio = Portfolio::get(array('name', 'filter', 'images'));
        $services = Service::where('id' , '<', 20)->get();
        $people = People::take(3)->get();

        $filters = DB::table('portfolio')->distinct()->pluck('filter');
        $menu = array();
        foreach ($pages as $page) {
            $item = array('title' => $page->name, 'alias' => $page->alias );
            array_push($menu, $item);
        }
        $item = array('title' => 'Services', 'alias' => 'service' );
        array_push($menu, $item);

        $item = array('title' => 'Portfolio', 'alias' => 'Portfolio' );
        array_push($menu, $item);

        $item = array('title' => 'Clients', 'alias' => 'clients' );
        array_push($menu, $item);

        $item = array('title' => 'Team', 'alias' => 'team' );
        array_push($menu, $item);

        $item = array('title' => 'Contact', 'alias' => 'contact' );
        array_push($menu, $item);
        //dd($filters);
        return view('site.index', [
            'menu' => $menu,
            'pages' => $pages,
            'portfolio' => $portfolio,
            'services' => $services,
            'people' => $people,
            'filters' => $filters
        ]);
    }
}

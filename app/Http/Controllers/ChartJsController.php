<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\visits;
use App\Models\ipInfos;
use DB;
use Carbon\Carbon;

class ChartJsController extends Controller
{
    public function index()
    {
      //$country = 'Canada';
      //$dataVisitors = json_encode($datasetsVisitors);
      function monthCountJson(){
        $dates = array(
          'January'   => date('Y'). '-01-01 12:00:00',
          'February'  => date('Y'). '-02-01 12:00:00',
          'March'     => date('Y'). '-03-01 12:00:00',
          'April'     => date('Y'). '-04-01 12:00:00',
          'May'       => date('Y'). '-05-01 12:00:00',
          'June'      => date('Y'). '-06-01 12:00:00',
          'July'      => date('Y'). '-07-01 12:00:00',
          'August'    => date('Y'). '-08-01 12:00:00',
          'September' => date('Y'). '-09-01 12:00:00',
          'October'   => date('Y'). '-10-01 12:00:00',
          'November'  => date('Y'). '-11-01 12:00:00',
          'December'  => date('Y'). '-12-01 12:00:00'
        );

        // db query without ralation tables ( count all )
        $dataOther = array(
          AllMonthCount($dates['January'], $dates['February']),
          AllMonthCount($dates['February'], $dates['March']),
          AllMonthCount($dates['March'], $dates['April']),
          AllMonthCount($dates['April'], $dates['May']),
          AllMonthCount($dates['May'], $dates['June']),
          AllMonthCount($dates['June'], $dates['July']),
          AllMonthCount($dates['July'], $dates['August']),
          AllMonthCount($dates['August'], $dates['September']),
          AllMonthCount($dates['September'], $dates['October']),
          AllMonthCount($dates['October'], $dates['November']),
          AllMonthCount($dates['November'], $dates['December']),
          AllMonthCount($dates['December'], (date('Y') + 1). '-01-01 12:00:00'),
        );


        return json_encode($dataOther);
        //if ($country == null) {
        //}else {
        //  return json_encode($dataOther);
        //}
      }

      function AllMonthCount($datein, $dateout){
        $date_count = visits::whereBetween('created_at', [$datein, $dateout])->count();
        return $date_count;
      }

      $datasetsVisitors = [
          [
              'label' => 'All',
              'backgroundColor' => 'rgba(125, 88, 17, 0.9)',
              'borderColor' => 'rgba(125, 88, 17, 0.9)',
              'pointRadius' => false,
              'pointColor' => '#3b8bba',
              'pointStrokeColor' => 'rgba(60,141,188,1)',
              'pointHighlightFill' => '#fff',
              'pointHighlightStroke' => 'rgba(60,141,188,1)',
              'data' => json_decode(monthCountJson())
          ]
      ];

      function group_country(){
        return DB::select("SELECT country FROM ip_infos GROUP by country");

      }

      //dd(group_country());
        $data = [
          'posts' => Post::all(),
          'user' => User::all(),
          'ip_count' => visits::all(),
          'countries' => group_country(),
          'dataVisitors' => json_encode($datasetsVisitors),
          'monthCountJson' => monthCountJson(),
          //'AllMonthCount' => AllMonthCount(),
          'months' => json_encode([
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
          ]),
        ];
        //dd($data);
    	return view('admin.chartjs')->with($data);
    }



    // /var/www/html/resources/views/admin/chartjs_country.blade.php
    public function show_country($country)
    {
      //$country = 'Canada';
      //$dataVisitors = json_encode($datasetsVisitors);
      function monthCountJson($country){

        $dates = array(
          'January'   => date('Y'). '-01-01 12:00:00',
          'February'  => date('Y'). '-02-01 12:00:00',
          'March'     => date('Y'). '-03-01 12:00:00',
          'April'     => date('Y'). '-04-01 12:00:00',
          'May'       => date('Y'). '-05-01 12:00:00',
          'June'      => date('Y'). '-06-01 12:00:00',
          'July'      => date('Y'). '-07-01 12:00:00',
          'August'    => date('Y'). '-08-01 12:00:00',
          'September' => date('Y'). '-09-01 12:00:00',
          'October'   => date('Y'). '-10-01 12:00:00',
          'November'  => date('Y'). '-11-01 12:00:00',
          'December'  => date('Y'). '-12-01 12:00:00'
        );

        // db query without ralation tables ( count all )
        $dataOther = array(
          AllMonthCount($dates['January'], $dates['February'], $country),
          AllMonthCount($dates['February'], $dates['March'], $country),
          AllMonthCount($dates['March'], $dates['April'], $country),
          AllMonthCount($dates['April'], $dates['May'], $country),
          AllMonthCount($dates['May'], $dates['June'], $country),
          AllMonthCount($dates['June'], $dates['July'], $country),
          AllMonthCount($dates['July'], $dates['August'], $country),
          AllMonthCount($dates['August'], $dates['September'], $country),
          AllMonthCount($dates['September'], $dates['October'], $country),
          AllMonthCount($dates['October'], $dates['November'], $country),
          AllMonthCount($dates['November'], $dates['December'], $country),
          AllMonthCount($dates['December'], (date('Y') + 1). '-01-01 12:00:00', $country),
        );
        //dd($dataOther);

        return json_encode($dataOther);
        //if ($country == null) {
        //}else {
        //  return json_encode($dataOther);
        //}
      }


      function AllMonthCount($datein, $dateout, $country){
        //$ip_count = visits::whereBetween('created_at', [$datein, $dateout])->where('ipStrlen', '495115323')->count();
        $ip_count = DB::table('ip_infos')
        ->join('visits', 'ip_infos.ipStrlen', '=', 'visits.ipStrlen')
        ->whereBetween('visits.created_at', [$datein, $dateout])
        ->where('ip_infos.country', $country)
        ->count();

        //dd($ip_count);


        return $ip_count;
      }

      //monthCountJson('Germany');
      function search_country($country){
        //dd($ipStr);
        //$ipStrlen = $ipStr;
        $query_db = DB::select(
          "SELECT * FROM ip_infos WHERE country = '$country' ");

        foreach ($query_db as $key => $query) {
          return $query->country;
        }
      }


      //echo search_country($ipStrlen);
      //dd(search_country($ipStrlen));
      $datasetsVisitors = [
          [
              'label' => search_country($country),
              'backgroundColor' => 'rgba(125, 88, 17, 0.9)',
              'borderColor' => 'rgba(125, 88, 17, 0.9)',
              'pointRadius' => false,
              'pointColor' => '#3b8bba',
              'pointStrokeColor' => 'rgba(60,141,188,1)',
              'pointHighlightFill' => '#fff',
              'pointHighlightStroke' => 'rgba(60,141,188,1)',
              'data' => json_decode(monthCountJson($country))
          ]
      ];
        $data = [
          'posts' => Post::all(),
          'user' => User::all(),
          'ip_count' => visits::all(),
          'dataVisitors' => json_encode($datasetsVisitors),
          'monthCountJson' => monthCountJson($country),
          'search_country' => search_country($country),
          //'AllMonthCount' => AllMonthCount(),
          'months' => json_encode([
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
          ])
        ];
        //dd($data);
      return view('admin.chartjs_country')->with($data);
    }


}

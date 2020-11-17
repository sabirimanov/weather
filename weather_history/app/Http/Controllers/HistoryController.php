<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Http\Responses\JSONResponse;
use Illuminate\Http\Request;
use DateTime;

class HistoryController extends Controller
{
    public function getByDate(array $params)
    {
        $selectedDT = DateTime::createFromFormat("Y-m-d", $params['date']);
        if($selectedDT === false || array_sum($selectedDT::getLastErrors())) {
            throw new \Exception('Invalid date. Please, set date parameter in Y-m-d format', JSONResponse::JSON_PARSE_ERROR_CODE);
        }
        
        $data = History::where('date_at', $selectedDT->format('Y-m-d'))->first();

        return $data;
    }
    
    public function getHistory(array $params)
    {
        
        $lastDays = intval($params['lastDays']);
        if ($lastDays < 1) {
            throw new \Exception('Last days parameter should be greater than zero', JSONResponse::JSON_PARSE_ERROR_CODE);
        }
        $data = History::orderBy('date_at', 'desc')->take($lastDays)->get();

        return $data;
    }
}
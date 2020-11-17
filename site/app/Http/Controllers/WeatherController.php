<?php
namespace App\Http\Controllers;

use App\Services\JSONRPCClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class WeatherController extends Controller
{
    /**
     * Client for JSON RPC communication
     * @var JSONRPCClient
     */
    protected $client;
    protected $errors;
    const daysLimit = '30';

    public function __construct(JSONRPCClient $client)
    {
        $this->client = $client;
        $this->errors = [];
    }

    /**
     * Generate dashboard page
     * @return View
     */
    public function showDashboard ()
    {
        //Get weather history
        $weatherHistory = $this->getLastDaysData();
        
        return view('index', [
            'lastDays' => $weatherHistory,
            'errors' => $this->errors
        ]);
    }

    /**
     * Show dashboard with search results
     * @param Request $request
     * @return View
     */
    public function showResult(Request $request)
    {
        //Get weather for requested date
        $getWeatherByDate = $this->getWeatherByDate(
            $request->get('date')
        );
        
        //Also get weather history
        $weatherHistory = $this->getLastDaysData();
        
        return view('index', [
            'lastDays' => $weatherHistory,
            'temp' => $getWeatherByDate,
            'errors' => $this->errors
        ]);
    }
    
    
    
    /**
     * Get weather forecast data for the last 30 days via JSON RPC request
     * @return array
     */
    public function getLastDaysData() {
        //Send request and get weather history
        $lastDaysData = $this->client->send('weather.getHistory', [
            'lastDays' => self::daysLimit
        ]);
        
        //Handle getHistory errors
        if (isset($lastDaysData['error'])) {
            $this->errors[] = $lastDaysData['error'];
            return false;
        }
        
        //return forecast data for last 30 days
        return $lastDaysData['result'];
    }
    
    
    /**
     * Get weather forecast data for specified date via JSON RPC request
     * @param FormRequest $request
     * @return int
     */
    public function getWeatherByDate($date) {
        //Send request and get weather data
        $weatherData = $this->client->send('weather.getByDate', [
            'date' => $date
        ]);

        //Handle getByDate errors
        if (isset($weatherData['error'])) {
            $this->errors[] = $weatherData['error'];
            return false;
        }
        
        if (empty($weatherData['result'])) {
            $this->errors[] = 'No forecast data for specified date';
            return false;
        }
        
        //return forecast data for requested date
        return $weatherData['result']['temp'];
    }   
}

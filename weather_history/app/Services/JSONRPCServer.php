<?php
namespace App\Services;

use App\Http\Responses\JSONResponse;
use App\Http\Controllers\HistoryController;
use Illuminate\Http\Request;

class JSONRPCServer
{
	public function handle(Request $request, HistoryController $controller)
	{
		try {
			$content = json_decode($request->getContent(), true);

			if (empty($content)) {
				throw new \Exception('JSON parse error', JSONResponse::JSON_PARSE_ERROR_CODE);
			}
			
			if (strpos($content['method'], 'weather.') !== 0) {
				throw new \Exception('Only weather related methods are allowed', JSONResponse::JSON_PARSE_ERROR_CODE);
			}
			
			//ugly solution for task compliance 
			$content['method'] = str_replace('weather.', '', $content['method']);
			
			$result = $controller->{$content['method']}(...[$content['params']]);

			return JSONResponse::success($result, $content['id']);
		} catch (\Exception $e) {
			return JSONResponse::error($e->getMessage());
		}
	}
}
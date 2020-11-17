<?php
namespace App\Http\Responses;

class JSONResponse
{
	const JSON_RPC_VERSION = '2.0';
	const JSON_PARSE_ERROR_CODE = 500;

	public static function success($result, string $id = null)
	{
		return [
			'jsonrpc' => self::JSON_RPC_VERSION,
			'result'  => $result,
			'id'      => $id,
		];
	}

	public static function error($error)
	{
		return [
			'jsonrpc' => self::JSON_RPC_VERSION,
			'error'  => $error,
			'id'      => null,
		];
	}
}
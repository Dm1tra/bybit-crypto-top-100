<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BybitService;

class CryptoController extends Controller
{
    public function index(Request $request, BybitService $bybitService)
    {
        $sortParam = $request->query('sort', 'marketCap'); 

        $cryptos = $bybitService->getTop100Cryptos($sortParam);

        return view('crypto.index', compact('cryptos'));
    }
}

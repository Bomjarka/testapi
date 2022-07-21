<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use App\Services\ShortLinkService;

class PageController extends Controller
{
    public function shortlink($short, ShortLinkService $shortLinkService)
    {
        $url = ShortLink::whereShort($short)->first();
        if ($url) {
            $shortLinkService->increment($url);
        } else {
            return abort(404);
        }
    }
}

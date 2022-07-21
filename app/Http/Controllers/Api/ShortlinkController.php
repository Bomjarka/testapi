<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ShortLink;
use App\Services\ShortLinkService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShortlinkController extends BaseApiController
{
    public function list()
    {
        return $this->sendSuccessResponse([ShortLink::all()], 'All available links');
    }

    /**
     * @param Request $request
     * @param ShortLinkService $shortLinkService
     * @return JsonResponse
     * @throws Exception
     */
    public function create(Request $request, ShortLinkService $shortLinkService): JsonResponse
    {
        $validator = Validator::make($request->all(), [
           'url' => ['required', 'url', 'unique:shortlinks'],
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->getMessageBag()->all()]);
        }

        $url = $request->get('url');

        return $this->sendSuccessResponse([$shortLinkService->createShortlink($url)], 'OK');
    }

    public function update(Request $request, ShortLinkService $shortLinkService)
    {
        $validator = Validator::make($request->all(), [
            'url' => ['required', 'url'],
        ]);

        if ($validator->fails()) {
            return response()->json(['msg' => $validator->getMessageBag()->all()]);
        }

        $url = $request->get('url');
        $shortLinkService->updateShortLink($url);

        return $this->sendSuccessResponse([$url], 'OK');
    }
}

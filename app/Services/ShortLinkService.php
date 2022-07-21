<?php

namespace App\Services;

use App\Models\ShortLink;
use Exception;

class ShortLinkService
{
    public const MIN_LENGTH = 5;

    public const MAX_LENGTH = 8;

    /**
     * @param string $url
     * @return ShortLink
     * @throws Exception
     */
    public function createShortlink(string $url): ShortLink
    {
        return ShortLink::create([
            'url' => $url,
            'short' => $this->generateShortPart($url)
        ]);
    }

    /**
     * @param string $url
     * @return void
     * @throws Exception
     */
    public function updateShortLink(string $url): void
    {
        $shortLink = ShortLink::whereUrl($url)->first();
        $shortLink->short = $this->generateShortPart($url);

        $shortLink->save();
    }

    /**
     * @param string $url
     * @return false|string
     * @return string
     * @throws Exception
     */
    public function generateShortPart(string $url): string
    {
        $shortlink = md5($url);
        $offset = random_int(1, strlen($shortlink));
        $length = random_int(self::MIN_LENGTH, self::MAX_LENGTH);

        if ($offset + $length >= strlen($shortlink)) {
            return substr($shortlink, -$offset, $length);
        }

        return substr($shortlink, $offset, $length);
    }

    /**
     * @param ShortLink $shortLink
     * @return void
     */
    public function increment(ShortLink $shortLink): void
    {
        ++$shortLink->redirects;

        $shortLink->save();
    }
}

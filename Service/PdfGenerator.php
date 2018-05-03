<?php

namespace Magelan\HtmlToPdfBundle\Service;

use GuzzleHttp\RequestOptions;

class PdfGenerator
{
    /**
     * @var string
     */
    private $entrypoint;

    /**
     * @var array
     */
    private $settings;

    /**
     * PdfGenerator constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->entrypoint = $config['entrypoint'];
        $this->settings = $config['settings'];
    }

    /**
     * @param $url
     * @param array $setting
     * @return \Psr\Http\Message\StreamInterface
     */
    public function generateFromUrl($url, $setting = [])
    {
        return $this->generateFromHtml(file_get_contents($url), $setting);
    }

    /**
     * @param $html
     * @param array|string $setting
     * @return \Psr\Http\Message\StreamInterface
     */
    public function generateFromHtml($html, $setting = [])
    {
        $json = ['settings' => is_array($setting)?$setting:$this->settings[$setting], 'html' => $html];
        $client = new \GuzzleHttp\Client();
        $response = $client->post(
            $this->entrypoint,
            [
                RequestOptions::JSON => $json,
            ]
        );

        return $response->getBody();
    }
}

<?php namespace App\Services;
      use App\Interfaces\iApiService;

class ApiService implements iApiService
{
    private $URL;

    public function __construct(string $URL)
    {
        $this->URL = $URL;
    }

    public function getApiRequest($URI)
    {
        $ch = curl_init($this->URL . $URI);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if ($e = curl_error($ch)) {
            echo $e;
        }
        curl_close($ch);

        return $response;
    }

    public function postApiRequest($URI, $postData)
    {
        $ch = curl_init($this->URL . $URI);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
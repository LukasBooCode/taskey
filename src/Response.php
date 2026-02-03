<?php

namespace Framework;

class Response
{
    public int $responseCode;
    public ?string $body;
    public string $headers;

    /**
     * @param int $responseCode
     * @param string $headers
     * @param string|null $body
     */
    public function __construct(string $headers, int $responseCode = 200, ?string $body = null)
    {
        $this->headers = $headers;
        $this->responseCode = $responseCode;
        $this->body = $body;
    }

    public function echo(): void
    {
        echo "Thank you for your request at " . $this->headers;
    }
}

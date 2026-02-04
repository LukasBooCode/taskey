<?php

namespace Framework;

class Response
{
    public int $responseCode;
    public string $body;
    public ?string $header;

    /**
     * @param int $responseCode
     * @param string|null $header
     * @param string $body
     */
    public function __construct(string $body = "", int $responseCode = 200, ?string $header = null)
    {
        $this->header = $header;
        $this->responseCode = $responseCode;
        $this->body = $body;
    }

    public function echo(): void
    {
        if ($this->header !== null) {
            header($this->header);
        }
        http_response_code($this->responseCode);
        echo $this->body;
    }
}

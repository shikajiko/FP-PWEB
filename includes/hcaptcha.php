<?php

require_once __DIR__ . '/config.php';

function hcaptchaSiteKey(): string
{
    return env('HCAPTCHA_SITEKEY', '10d2b3cc-9866-4030-9836-da5a987a2dd4');
}

function hcaptchaSecret(): string
{
    return env('HCAPTCHA_SECRET', 'REDACTED');
}

/**
 * Verify hCaptcha token against the hCaptcha API.
 */
function verifyHCaptcha(?string $token, ?string $remoteIp = null): bool
{
    if (!$token) {
        return false;
    }

    $secret = hcaptchaSecret();
    if (!$secret) {
        return false;
    }

    $body = http_build_query([
        'secret' => $secret,
        'response' => $token,
        'remoteip' => $remoteIp,
    ]);

    $options = [
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                . "Content-Length: " . strlen($body) . "\r\n",
            'content' => $body,
            'timeout' => 5,
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents('https://hcaptcha.com/siteverify', false, $context);
    if ($result === false) {
        return false;
    }

    $decoded = json_decode($result, true);
    return isset($decoded['success']) && $decoded['success'] === true;
}

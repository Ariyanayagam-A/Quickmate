<?php
return [
    'client_id' => env('AZURE_CLIENT_ID'),
    'client_secret' => env('AZURE_CLIENT_SECRET'),
    'redirect_uri' => env('AZURE_REDIRECT_URI'),
    'tenant_id' => env('AZURE_TENANT_ID'),
    'client_certificate_private_key' => env('AZURE_CLIENT_CERT_PRIVATE_KEY', null),
    'client_certificate_thumbprint' => env('AZURE_CLIENT_CERT_THUMBPRINT', null),
];

?>
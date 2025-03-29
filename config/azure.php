<?php
return [
    'client_id' => env('AZURE_CLIENT_ID',"8a9f45a5-9f93-42fc-af0b-7bf77b662514"),
    'client_secret' => env('AZURE_CLIENT_SECRET',"zpQ8Q~nKq2Wv1lwsgie6vGalEItkdPy-UJ56oc4H"),
    'redirect_uri' => env('AZURE_REDIRECT_URI',"f39871e1-5adc-4f8b-9877-27f8c552813a"),
    'tenant_id' => env('AZURE_TENANT_ID','http://localhost:5000/auth/azure/callback'),
    'client_certificate_private_key' => env('AZURE_CLIENT_CERT_PRIVATE_KEY', null),
    'client_certificate_thumbprint' => env('AZURE_CLIENT_CERT_THUMBPRINT', null),
];

?>
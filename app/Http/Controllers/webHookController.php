<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class webHookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $eventData = $request->all();

        Log::info('Received Keycloak Webhook:', $eventData);

        if (!empty($eventData['type'])) {
            switch ($eventData['type']) {
                case 'LOGIN':
                    Log::info('User Logged In: ', ['user' => $eventData['userId']]);
                    break;

                case 'REGISTER':
                    Log::info('User Registered: ', ['user' => $eventData['userId']]);
                    break;

                case 'DELETE_USER':
                    Log::info('User Deleted: ', ['user' => $eventData['userId']]);
                    break;

                case 'ASSIGN_ROLE':
                    Log::info('Role Assigned: ', ['user' => $eventData['userId'], 'role' => $eventData['role']]);
                    break;

                case 'REVOKE_ROLE':
                    Log::info('Role Revoked: ', ['user' => $eventData['userId'], 'role' => $eventData['role']]);
                    break;

                case 'UPDATE_PROFILE':
                    Log::info('User Profile Updated: ', ['user' => $eventData['userId']]);
                    break;

                case 'UPDATE_PASSWORD':
                    Log::info('User Password Updated: ', ['user' => $eventData['userId']]);
                    break;

                case 'CREATE_CLIENT':
                    Log::info('Client Created: ', ['client' => $eventData['clientId']]);
                    break;

                case 'DELETE_CLIENT':
                    Log::info('Client Deleted: ', ['client' => $eventData['clientId']]);
                    break;

                case 'UPDATE_CLIENT':
                    Log::info('Client Updated: ', ['client' => $eventData['clientId']]);
                    break;

                default:
                    Log::info('Unhandled Event Type: ', ['event' => $eventData]);
                    break;
            }
        }

        return response()->json(['status' => true,'message' => 'Webhook received successfully'], 200);
    }
}
?>
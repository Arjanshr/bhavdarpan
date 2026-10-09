<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class GitHubWebhookController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $secret = config('github.webhook_secret');
        $signature = $request->header('X-Hub-Signature-256');

        if (
            ! is_string($secret) ||
            $secret === '' ||
            ! is_string($signature) ||
            ! preg_match('/\Asha256=[a-f0-9]{64}\z/i', $signature)
        ) {
            abort(403, 'Invalid webhook signature.');
        }

        $expected = 'sha256=' . hash_hmac(
            'sha256',
            $request->getContent(),
            $secret
        );

        if (! hash_equals($expected, $signature)) {
            abort(403, 'Invalid webhook signature.');
        }

        if ($request->header('X-GitHub-Event') !== 'push') {
            return response()->json([
                'message' => 'Event ignored.',
            ], 202);
        }

        $payload = json_decode($request->getContent(), true);

        if (! is_array($payload)) {
            abort(400, 'Invalid JSON payload.');
        }

        if (($payload['ref'] ?? null) !== 'refs/heads/main') {
            return response()->json([
                'message' => 'Branch ignored.',
            ], 202);
        }

        $script = '/home8/bhavdarp/deploy-bhavdarpan.sh';

        if (! is_file($script) || ! is_executable($script)) {
            Log::error('Deployment script is missing or not executable.');

            return response()->json([
                'message' => 'Deployment is not configured.',
            ], 500);
        }

        $process = new Process([
            '/bin/bash',
            '-c',
            'nohup /bin/bash ' . escapeshellarg($script)
                . ' >> /home8/bhavdarp/deploy.log 2>&1 < /dev/null &',
        ]);

        $process->run();

        if (! $process->isSuccessful()) {
            Log::error('Could not start deployment process.');

            return response()->json([
                'message' => 'Could not start deployment.',
            ], 500);
        }

        return response()->json([
            'message' => 'Deployment started.',
        ], 202);
    }
}
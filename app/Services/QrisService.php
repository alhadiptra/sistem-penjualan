<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QrisService
{
    protected string $apiUrl;
    protected string $qrisStatic;

    public function __construct()
    {
        $this->apiUrl = 'https://qrisku.my.id/api';
        $this->qrisStatic = (string) env('QRIS_STATIC');
    }

    public function generateQris(float $amount)
    {
        try {
            $response = Http::post($this->apiUrl, [
                'amount' => (string) $amount,
                'qris_statis' => $this->qrisStatic,
            ]);

            $data = $response->json();

            if ($data['status'] == 'success' && isset($data['qris_base64'])) {
                return [
                    'success' => true,
                    'qris_base64' => $data['qris_base64'],
                    'message' => 'QRIS berhasil dihasilkan',
                ];
            }

            return [
                'success' => false,
                'message' => $data['message'] ?? 'Gagal generate QRIS',
            ];

        } catch (\Exception $e) {
            Log::error('QRIS Generation Error: ' . $e->getMessage());

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan pada server',
            ];
        }
    }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TextToSpeechService
{
    private $apiKey;
    private $apiUrl = 'http://api.voicerss.org/';

    /**
     * Construtor - Inicializa com a chave da API
     */
    public function __construct()
    {
        // Pega a chave do novo arquivo de config
        $this->apiKey = config('voicerss.api_key');
    }

    /**
     * Converte texto em áudio
     * 
     * @param string $text - O texto a ser convertido
     * @param string $language - Idioma (pt-br para português)
     * @return array - Retorna status e dados do áudio
     */
    public function convertTextToSpeech($text, $language = 'pt-br')
    {
        try {
            // Faz requisição HTTP para a API
            $response = Http::get($this->apiUrl, [
                'key' => $this->apiKey,
                'src' => $text,
                'hl' => $language,
                'c' => 'MP3',
                'f' => '44khz_16bit_stereo'
            ]);

            // Verifica se a requisição foi bem-sucedida
            if ($response->successful()) {
                // Gera nome único para o arquivo
                $fileName = 'audio_' . time() . '.mp3';
                $filePath = public_path('audios/' . $fileName);

                // Cria diretório se não existir
                if (!file_exists(public_path('audios'))) {
                    mkdir(public_path('audios'), 0777, true);
                }

                // Salva o áudio no servidor
                file_put_contents($filePath, $response->body());

                return [
                    'success' => true,
                    'audio_url' => asset('audios/' . $fileName),
                    'message' => 'Áudio gerado com sucesso!'
                ];
            }

            return [
                'success' => false,
                'message' => 'Erro ao gerar áudio: ' . $response->body()
            ];

        } catch (\Exception $e) {
            // Registra erro no log
            Log::error('Erro no TextToSpeech: ' . $e->getMessage());

            return [
                'success' => false,
                'message' => 'Erro ao processar: ' . $e->getMessage()
            ];
        }
    }
}

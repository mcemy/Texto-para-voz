<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TextToSpeechService;

class TextToSpeechController extends Controller
{
    private $ttsService;

    public function __construct(TextToSpeechService $ttsService)
    {
        $this->ttsService = $ttsService;
    }

    public function index()
    {
        return view('home');
    }

    public function convert(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string|max:1000',
            'language' => 'nullable|string'
        ]);

        $result = $this->ttsService->convertTextToSpeech(
            $validated['text'],
            $validated['language'] ?? 'pt-br'
        );

        return response()->json($result);
    }
}

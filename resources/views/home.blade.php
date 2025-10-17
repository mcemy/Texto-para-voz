@extends('layouts.app')

@section('content')
<div class="container">
    <div class="main-card">
        <div class="text-center mb-4">
            <i class="fas fa-microphone-alt fa-4x text-primary mb-3"></i>
            <h1 class="display-4">Texto para Voz</h1>
            <p class="lead text-muted">Digite um texto e ouça em áudio</p>
        </div>

        <div id="alertBox" class="alert d-none" role="alert"></div>

        <form id="ttsForm">
            @csrf
            
            <div class="mb-3">
                <label for="text" class="form-label">
                    <i class="fas fa-keyboard"></i> Digite seu texto:
                </label>
                <textarea 
                    class="form-control" 
                    id="text" 
                    name="text" 
                    rows="5" 
                    placeholder="Digite aqui o texto que deseja converter em áudio..."
                    maxlength="1000"
                    required
                ></textarea>
                <div class="form-text">
                    <span class="char-count"><span id="charCount">0</span>/1000 caracteres</span>
                </div>
            </div>

            <div class="mb-3">
                <label for="language" class="form-label">
                    <i class="fas fa-globe"></i> Idioma:
                </label>
                <select class="form-select" id="language" name="language">
                    <option value="pt-br">Português (Brasil)</option>
                    <option value="en-us">Inglês (EUA)</option>
                    <option value="es-es">Espanhol (Espanha)</option>
                    <option value="fr-fr">Francês (França)</option>
                    <option value="de-de">Alemão (Alemanha)</option>
                    <option value="it-it">Italiano (Itália)</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-convert btn-lg">
                    <i class="fas fa-volume-up"></i> Gerar Áudio
                </button>
                
                <div class="loading mt-3">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Processando...</span>
                    </div>
                    <p class="mt-2">Gerando áudio...</p>
                </div>
            </div>
        </form>

        <div id="audioPlayer" class="audio-player">
            <h5><i class="fas fa-headphones"></i> Seu áudio está pronto!</h5>
            <audio id="audioElement" controls class="w-100 mt-3">
                Seu navegador não suporta o elemento de áudio.
            </audio>
            <div class="mt-3">
                <a id="downloadLink" class="btn btn-success" download>
                    <i class="fas fa-download"></i> Baixar Áudio
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('ttsForm');
        const textArea = document.getElementById('text');
        const charCount = document.getElementById('charCount');
        const loading = document.querySelector('.loading');
        const audioPlayer = document.getElementById('audioPlayer');
        const audioElement = document.getElementById('audioElement');
        const downloadLink = document.getElementById('downloadLink');
        const alertBox = document.getElementById('alertBox');
        const btnSubmit = form.querySelector('button[type="submit"]');

        textArea.addEventListener('input', function() {
            charCount.textContent = this.value.length;
        });

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            btnSubmit.disabled = true;
            loading.style.display = 'block';
            audioPlayer.style.display = 'none';
            hideAlert();

            const formData = new FormData(form);

            fetch('{{ route("convert") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                loading.style.display = 'none';
                btnSubmit.disabled = false;

                if (data.success) {
                    audioElement.src = data.audio_url;
                    downloadLink.href = data.audio_url;
                    audioPlayer.style.display = 'block';
                    
                    showAlert('success', data.message);
                    audioElement.play();
                    audioPlayer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                } else {
                    showAlert('danger', data.message);
                }
            })
            .catch(error => {
                loading.style.display = 'none';
                btnSubmit.disabled = false;
                showAlert('danger', 'Erro ao processar requisição: ' + error.message);
            });
        });

        function showAlert(type, message) {
            alertBox.className = `alert alert-${type}`;
            alertBox.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i> ${message}`;
            alertBox.classList.remove('d-none');
            setTimeout(hideAlert, 5000);
        }

        function hideAlert() {
            alertBox.classList.add('d-none');
        }
    });
</script>
@endpush

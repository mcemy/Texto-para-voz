# 🎙️ Sistema de Conversão de Texto para Voz

Sistema web desenvolvido em **Laravel 11** que converte texto em áudio utilizando a **API VoiceRSS**.

![Laravel](https://img.shields.io/badge/Laravel-11-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2-blue?logo=php)
![License](https://img.shields.io/badge/license-MIT-green)

---

## 📋 Sobre o Projeto

Este projeto permite que usuários digitem textos e os convertam em áudio em diversos idiomas, utilizando síntese de voz de alta qualidade.

### ✨ Funcionalidades

- ✅ Conversão de texto para áudio em tempo real
- ✅ Suporte a múltiplos idiomas (Português, Inglês, Espanhol, Francês, Alemão, Italiano)
- ✅ Interface moderna e responsiva
- ✅ Player de áudio integrado
- ✅ Download dos áudios gerados
- ✅ Validação de formulários
- ✅ Contador de caracteres (limite: 1000)
- ✅ Feedback visual com loading e mensagens

---

## 🛠️ Tecnologias Utilizadas

### Backend
- **Laravel 11** - Framework PHP
- **PHP 8.2** - Linguagem de programação
- **Guzzle HTTP** - Cliente HTTP para requisições à API
- **VoiceRSS API** - Serviço de conversão texto-para-voz

### Frontend
- **Blade Templates** - Engine de templates do Laravel
- **Bootstrap 5** - Framework CSS
- **Font Awesome 6** - Ícones
- **JavaScript Vanilla** - Interatividade

---

## 📦 Pré-requisitos

- PHP >= 8.2
- Composer
- MySQL ou outro banco de dados compatível (opcional)
- Chave da API VoiceRSS (gratuita)

---

## 🚀 Instalação

### 1. Clone o repositório

```bash
git clone https://github.com/mcemy/texto-para-voz.git
cd texto-para-voz
```

### 2. Instale as dependências

```bash
composer install
```

### 3. Configure o arquivo .env

```bash
cp .env.example .env
php artisan key:generate
```

Edite o arquivo `.env` e adicione sua chave da API:

```env
VOICERSS_API_KEY=sua_chave_aqui
```

### 4. Crie a pasta de áudios

```bash
mkdir -p public/audios
chmod 755 public/audios
```

### 5. Inicie o servidor

```bash
php artisan serve
```

Acesse: **http://localhost:8000**

---

## 🔑 Obtendo a Chave da API VoiceRSS

1. Acesse: https://www.voicerss.org/
2. Clique em "Get Your Free API Key"
3. Preencha o formulário de registro
4. Confirme seu email
5. Copie a chave da API
6. Cole no arquivo `.env` na variável `VOICERSS_API_KEY`

**Plano Gratuito:**
- ✅ 350 requisições diárias
- ✅ Sem necessidade de cartão de crédito
- ✅ Múltiplos idiomas e vozes

---

## 📂 Estrutura do Projeto

```
texto-para-voz/
├── app/
│   ├── Http/Controllers/
│   │   └── TextToSpeechController.php    # Controller principal
│   └── Services/
│       └── TextToSpeechService.php       # Serviço de integração com API
├── config/
│   └── voicerss.php                      # Configuração da API
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php                 # Layout base
│   └── home.blade.php                    # Página principal
├── routes/
│   └── web.php                           # Rotas da aplicação
├── public/
│   └── audios/                           # Pasta de áudios gerados
└── README.md                             # Documentação
```

---

## 🎯 Como Usar

1. **Acesse a aplicação** no navegador (http://localhost:8000)
2. **Digite ou cole** o texto que deseja converter (máximo 1000 caracteres)
3. **Selecione o idioma** desejado
4. **Clique em "Gerar Áudio"**
5. **Aguarde** o processamento (5-10 segundos)
6. **Ouça o áudio** no player integrado
7. **Baixe o arquivo** MP3 se desejar

---

## 🌍 Idiomas Disponíveis

| Idioma | Código | Voz |
|--------|--------|-----|
| Português (Brasil) | `pt-br` | Feminina |
| Inglês (EUA) | `en-us` | Masculina |
| Espanhol (Espanha) | `es-es` | Masculina |
| Francês (França) | `fr-fr` | Masculina |
| Alemão (Alemanha) | `de-de` | Masculina |
| Italiano (Itália) | `it-it` | Masculina |

---

## 🧪 Testes

### Teste manual via Tinker

```bash
php artisan tinker
```

```php
$service = app('App\Services\TextToSpeechService');
$result = $service->convertTextToSpeech('Olá, mundo!', 'pt-br');
print_r($result);
```

---

## 🐛 Troubleshooting

### Erro: "The account is inactive"
**Solução:** Ative sua conta VoiceRSS pelo email de confirmação

### Áudio vazio ou não toca
**Verifique:** 
- Se a chave da API está correta no `.env`
- Execute: `php artisan config:clear`

### Erro de permissão na pasta audios
**Execute:** `chmod -R 755 public/audios`

### Erro "Class not found"
**Execute:** `composer dump-autoload`

---

## 📝 Licença

Este projeto está sob a licença MIT.

---
## 🙏 Agradecimentos

- **Laravel** - Framework PHP incrível
- **VoiceRSS** - API de conversão texto-para-voz
- **Bootstrap** - Framework CSS
- **Font Awesome** - Biblioteca de ícones

---

**Desenvolvido com ❤️ e Laravel**

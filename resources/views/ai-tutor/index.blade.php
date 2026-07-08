@extends('adminlte::page')

@section('content')
<div class="container-fluid pt-4">
    <!-- Navbar Modern agar seragam dengan Dashboard -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 shadow-sm rounded-lg py-2">
        <div class="navbar-brand font-weight-bold text-primary ml-2">Konsultasi AI Tutor</div>
        <div class="ml-auto">
             <span class="text-muted mr-3" style="font-size: 0.85rem;">Siap membantu materi kuliah Anda</span>
        </div>
    </nav>

    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <!-- Chat Card yang sudah disesuaikan stylenya -->
            <div class="card shadow-sm border-0 rounded-lg overflow-hidden" style="height: calc(100vh - 200px); min-height: 500px; display: flex; flex-direction: column;">
                
                <div id="chat-box" class="card-body p-4 overflow-auto bg-white" style="flex-grow: 1;">
                    <div class="d-flex mb-4">
                        <div class="p-3 shadow-sm" style="background-color: #f8f9fc; border-radius: 15px; max-width: 80%; font-size: 0.95rem; color: #333; line-height: 1.6; border: 1px solid #edf2f7;">
                            Halo! Saya AI Tutor CMS Anda. Tanyakan apa saja seputar materi artikel, pengelolaan forum, atau pembuatan kuis!
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white border-top-0 p-3">
                    <form id="chat-form" onsubmit="sendMessage(event)">
                        <div class="d-flex align-items-center">
                            <input type="text" id="user-input" autocomplete="off" placeholder="Tulis pertanyaan Anda di sini..." 
                                   class="form-control bg-light border-0 px-4" 
                                   style="height: 48px; border-radius: 50px; font-size: 0.9rem;">
                            
                            <button type="submit" class="btn btn-primary px-4 font-weight-bold ml-2 shadow-sm" 
                                    style="border-radius: 50px; height: 48px; width: 120px;">
                                Kirim
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
async function sendMessage(event) {
    event.preventDefault();
    
    const inputElement = document.getElementById('user-input');
    const chatBox = document.getElementById('chat-box');
    const question = inputElement.value.trim();
    
    if (!question) return;

    // 1. Tampilkan chat user ke layar (Sesuai panjang teks)
    const userChatHtml = `
        <div class="d-flex mb-4 justify-content-end">
            <div class="p-3 text-white" style="background: #4e73df; border-radius: 12px; max-width: 80%; font-size: 0.9rem; line-height: 1.5; width: fit-content; word-break: break-word;">
                ${question}
            </div>
        </div>
    `;
    chatBox.insertAdjacentHTML('beforeend', userChatHtml);
    
    // Reset input dan gulir ke bawah
    inputElement.value = '';
    chatBox.scrollTop = chatBox.scrollHeight;

    // 2. Tampilkan template loading
    const loadingId = 'loading-' + Date.now();
    const loadingHtml = `
        <div class="d-flex mb-4" id="${loadingId}">
            <div class="p-3 text-muted" style="background-color: #f4f6f9; border-radius: 12px; font-size: 0.9rem; font-style: italic; width: fit-content;">
                <i class="fas fa-spinner fa-spin mr-2"></i> AI sedang memikirkan jawaban...
            </div>
        </div>
    `;
    chatBox.insertAdjacentHTML('beforeend', loadingHtml);
    chatBox.scrollTop = chatBox.scrollHeight;

    try {
        // 3. Menembak API AI Publik Gratis (System dipasangi instruksi tanpa enter sisa)
        const response = await fetch(`https://text.pollinations.ai/${encodeURIComponent(question)}?system=Kamu adalah AI Tutor pintar di platform web CMS kampus. Jawablah semua pertanyaan akademik, coding, kuis, rpl, atau materi kuliah dengan sangat terstruktur, detail, ramah, dan 100% benar menggunakan bahasa Indonesia. Jangan sertakan baris kosong atau jeda enter baru di akhir jawaban.`);
        let answerText = await response.text();

        // Bersihkan sisa spasi atau enter gaib di ujung teks tangkapan API
        answerText = answerText.trim();

        // Hapus indikator loading
        document.getElementById(loadingId).remove();

        // 4. Tampilkan respons AI (Menggunakan struktur span untuk memotong tinggi baris kosong secara paksa)
        const aiChatId = 'ai-msg-' + Date.now();
        const aiChatHtml = `
            <div class="d-flex mb-4">
                <div id="${aiChatId}" class="p-3" style="background-color: #f4f6f9; border-radius: 12px; max-width: 80%; font-size: 0.9rem; color: #333; line-height: 1.5; display: inline-block; width: fit-content;">
                    <span style="white-space: pre-line; display: block; margin: 0; padding: 0; word-break: break-word;"></span>
                </div>
            </div>
        `;
        chatBox.insertAdjacentHTML('beforeend', aiChatHtml);
        
        // Suntikkan teks ke dalam span menggunakan textContent agar aman & rapi tanpa sisa baris bawah
        document.querySelector(`#${aiChatId} span`).textContent = answerText;

    } catch (error) {
        document.getElementById(loadingId).remove();
        const errorHtml = `
            <div class="d-flex mb-4">
                <div class="p-3 text-danger" style="background-color: #fce8e6; border-radius: 12px; font-size: 0.9rem; width: fit-content;">
                    Gagal terhubung ke AI Tutor. Pastikan device Anda terkoneksi internet.
                </div>
            </div>
        `;
        chatBox.insertAdjacentHTML('beforeend', errorHtml);
    }

    // Otomatis scroll ke dasar chatbox
    chatBox.scrollTop = chatBox.scrollHeight;
}
</script>
@endsection
@extends('adminlte::page')

@section('title','Kerjakan Quiz')

@section('content')

<div class="container">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <h3 class="mb-0">
                {{ $quiz->judul }}
            </h3>

        </div>

        <div class="card-body">

            {{-- ================= TIMER ================= --}}

            <div class="row mb-3">

                <div class="col-md-6">

                    <div class="alert alert-warning">

                        <strong>

                            ⏰ Sisa Waktu :

                            <span id="timer">
                                --:--
                            </span>

                        </strong>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="alert alert-info text-right">

                        <strong>

                            Total Soal :

                            {{ $quiz->questions->count() }}

                        </strong>

                    </div>

                </div>

            </div>

            {{-- ================= PROGRESS ================= --}}

            <div class="progress mb-4" style="height:25px">

                <div
                    id="progressBar"
                    class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                    style="width:0%">

                    0%

                </div>

            </div>

            {{-- ================= FORM ================= --}}

            <form

                id="quizForm"

                action="{{ route('questions.submit',$quiz->id) }}"

                method="POST">

                @csrf

                @foreach($quiz->questions as $no => $soal)

<div
    class="card soal mb-4 shadow-sm"
    id="soal{{ $no }}"
    style="{{ $no == 0 ? '' : 'display:none' }}">

    <div class="card-header d-flex justify-content-between align-items-center bg-light">

        <h5 class="mb-0">

            Soal {{ $no + 1 }} dari {{ $quiz->questions->count() }}

        </h5>

        <span class="badge badge-primary">

            {{ round((($no + 1) / $quiz->questions->count()) * 100) }}%

        </span>

    </div>

    <div class="card-body">

        <h4 class="mb-4">

            {{ $soal->pertanyaan }}

        </h4>

        <div class="custom-control custom-radio mb-3">

            <input
                type="radio"
                class="custom-control-input"
                id="a{{ $soal->id }}"
                name="jawaban[{{ $soal->id }}]"
                value="A">

            <label
                class="custom-control-label"
                for="a{{ $soal->id }}">

                {{ $soal->pilihan_a }}

            </label>

        </div>

        <div class="custom-control custom-radio mb-3">

            <input
                type="radio"
                class="custom-control-input"
                id="b{{ $soal->id }}"
                name="jawaban[{{ $soal->id }}]"
                value="B">

            <label
                class="custom-control-label"
                for="b{{ $soal->id }}">

                {{ $soal->pilihan_b }}

            </label>

        </div>

        <div class="custom-control custom-radio mb-3">

            <input
                type="radio"
                class="custom-control-input"
                id="c{{ $soal->id }}"
                name="jawaban[{{ $soal->id }}]"
                value="C">

            <label
                class="custom-control-label"
                for="c{{ $soal->id }}">

                {{ $soal->pilihan_c }}

            </label>

        </div>

        <div class="custom-control custom-radio mb-4">

            <input
                type="radio"
                class="custom-control-input"
                id="d{{ $soal->id }}"
                name="jawaban[{{ $soal->id }}]"
                value="D">

            <label
                class="custom-control-label"
                for="d{{ $soal->id }}">

                {{ $soal->pilihan_d }}

            </label>

        </div>

        <div class="d-flex justify-content-between">

            <button
                type="button"
                class="btn btn-secondary prevBtn">

                ← Sebelumnya

            </button>

            <button
                type="button"
                class="btn btn-primary nextBtn">

                Selanjutnya →

            </button>

        </div>

    </div>

</div>

@endforeach

<button
    id="submitBtn"
    type="submit"
    class="btn btn-success btn-lg btn-block"
    style="display:none">

    <i class="fas fa-check-circle"></i>

    Selesai Quiz

</button>

</form>

</div>

</div>

</div>

<script>

document.addEventListener("DOMContentLoaded", function () {

    // ==========================
    // TIMER
    // ==========================

    let waktu = Number(@json($quiz->durasi)) * 60;

    const timerElement = document.getElementById("timer");

    function updateTimer(){

        let menit = Math.floor(waktu / 60);
        let detik = waktu % 60;

        timerElement.innerHTML =
            menit + ":" + String(detik).padStart(2,'0');

        if(waktu <= 300){

            timerElement.style.color = "red";

            timerElement.style.fontWeight = "bold";

        }

        if(waktu <= 0){

            clearInterval(timer);

            alert("Waktu habis, quiz akan dikumpulkan.");

            document.getElementById("quizForm").submit();

        }

        waktu--;

    }

    updateTimer();

    const timer = setInterval(updateTimer,1000);




    // ==========================
    // NAVIGASI SOAL
    // ==========================

    const soal = document.querySelectorAll(".soal");

    const nextButtons =
        document.querySelectorAll(".nextBtn");

    const prevButtons =
        document.querySelectorAll(".prevBtn");

    let current = 0;

    function tampilkan(index){

        soal.forEach(function(item){

            item.style.display="none";

        });

        soal[index].style.display="block";

        prevButtons.forEach(btn=>btn.style.display="inline-block");

        nextButtons.forEach(btn=>btn.style.display="inline-block");

        if(index==0){

            prevButtons[index].style.display="none";

        }

        if(index==soal.length-1){

            nextButtons[index].style.display="none";

            document.getElementById("submitBtn").style.display="block";

        }else{

            document.getElementById("submitBtn").style.display="none";

        }

    }

    tampilkan(0);



    nextButtons.forEach(function(btn){

        btn.addEventListener("click",function(){

            if(current<soal.length-1){

                current++;

                tampilkan(current);

                updateProgress();

            }

        });

    });




    prevButtons.forEach(function(btn){

        btn.addEventListener("click",function(){

            if(current>0){

                current--;

                tampilkan(current);

            }

        });

    });




    // ==========================
    // PROGRESS
    // ==========================

    const total = {{ $quiz->questions->count() }};

    function updateProgress(){

        let answered = 0;

        @foreach($quiz->questions as $soal)

        if(document.querySelector('input[name="jawaban[{{ $soal->id }}]"]:checked')){

            answered++;

        }

        @endforeach

        let persen = Math.round((answered/total)*100);

        let bar = document.getElementById("progressBar");

        bar.style.width = persen+"%";

        bar.innerHTML = persen+"%";

    }

    document.querySelectorAll("input[type=radio]")

    .forEach(function(item){

        item.addEventListener("change",updateProgress);

    });

});

</script>

@endsection
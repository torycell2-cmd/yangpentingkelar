<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizResult;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($quiz)
    {
        $quiz = Quiz::findOrFail($quiz);

        $nomor = $quiz->questions()->count() + 1;

        return view('quiz.questions', compact(
        'quiz',
        'nomor'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request, $quiz)
    {
        $request->validate([

            'pertanyaan' => 'required',
            'pilihan_a'  => 'required',
            'pilihan_b'  => 'required',
            'pilihan_c'  => 'required',
            'pilihan_d'  => 'required',
            'jawaban'    => 'required'

        ]);

        Question::create([

            'quiz_id'    => $quiz,
            'pertanyaan' => $request->pertanyaan,
            'pilihan_a'  => $request->pilihan_a,
            'pilihan_b'  => $request->pilihan_b,
            'pilihan_c'  => $request->pilihan_c,
            'pilihan_d'  => $request->pilihan_d,
            'jawaban'    => $request->jawaban

        ]);

        $quizData = Quiz::findOrFail($quiz);

        if ($quizData->questions()->count() >= $quizData->jumlah_soal) {

            return redirect()
                ->route('quiz.index')
                ->with('success', 'Semua soal berhasil ditambahkan.');

        }

        return redirect()->back()
            ->with(
                'success',
                'Soal berhasil ditambahkan. Masih kurang '
                . ($quizData->jumlah_soal - $quizData->questions()->count())
                . ' soal lagi.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function play($quiz)
    {
        $quiz = Quiz::with('questions')->findOrFail($quiz);

        return view('quiz.play', compact('quiz'));
    }

    public function submit(Request $request, $quiz)
    {
        $quiz = Quiz::with('questions')->findOrFail($quiz);

        $benar = 0;

        foreach ($quiz->questions as $question) {

            $jawabanUser = $request->jawaban[$question->id] ?? null;

            if ($jawabanUser == $question->jawaban) {
                $benar++;
            }
        }

        $total = $quiz->questions->count();

        $nilai = $total > 0 ? round(($benar / $total) * 100) : 0;

        QuizResult::updateOrCreate(

            [
                'user_id' => auth()->id(),
                'quiz_id' => $quiz->id,
            ],

            [
                'nilai' => $nilai,
                'status' => $nilai >= 75 ? 'Lulus' : 'Remedial',
            ]

        );

        return redirect()
            ->route('quiz.index')
            ->with('success', "Quiz selesai! Nilai kamu: {$nilai}");
    }
}

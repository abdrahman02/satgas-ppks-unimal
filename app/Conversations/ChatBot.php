<?php

namespace App\Conversations;

use App\Models\Tema;
use App\Models\Pertanyaan;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class ChatBot extends Conversation
{
    protected $topik = '';
    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askTema();
    }

    /**
     * First question
     */
    public function askTema()
    {
        $temas = Tema::all();
        $buttons = [];

        foreach ($temas as $tema) {
            $buttons[] = Button::create($tema->tema)->value($tema->id);
        }

        $question = Question::create("Silahkan pilih informasi yang anda butuhkan.")->fallback('Unable to ask question')->callbackId('ask_reason')->addButtons($buttons);

        return $this->ask(
            $question,
            function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {
                    $temaId = $answer->getValue();
                    $this->showPertanyaanButtons($temaId);
                }
            }
        );
    }

    /**
     * Display pertanyaan buttons based on the selected tema.
     *
     * @param int $temaId
     */

    public function showPertanyaanButtons($temaId)
    {
        $tema = Tema::find($temaId);
        if ($tema) {
            $pertanyaans = Pertanyaan::where('tema_id', $temaId)->get();
            $buttons = [];

            foreach ($pertanyaans as $pertanyaan) {
                $buttons[] = Button::create($pertanyaan->pertanyaan)->value($pertanyaan->pertanyaan);
            }

            $this->ask(
                Question::create("Silahkan pilih pertanyaan yang anda inginkan untuk tema '{$tema->tema}'.")->fallback('Unable to ask question')
                    ->callbackId('ask_pertanyaan')
                    ->addButtons($buttons),
                function (Answer $answer) {
                    $pertanyaanTerpilih = $answer->getValue();
                    $this->handlePertanyaanSelection($pertanyaanTerpilih);
                }
            );
        } else {
            $this->say("Maaf, saya belum menyediakan informasi mengenai topik '{$temaId}'. Silahkan laporkan masalah ini dengan mengetik report");
        }
    }

    /**
     * Handle the user's pertanyaan selection.
     *
     * @param Answer $answer
     */

    public function handlePertanyaanSelection($pertanyaanTerpilih)
    {
        $selectedPertanyaan = $pertanyaanTerpilih;
        $pertanyaan = Pertanyaan::where('pertanyaan', $selectedPertanyaan)->first();

        if ($pertanyaan) {
            // Tampilkan jawaban untuk pertanyaan yang dipilih
            $this->say("Jawaban untuk pertanyaan '{$selectedPertanyaan}': <br> <br> {$pertanyaan->jawaban}");
            $this->say('Silahkan ketik <strong>start</strong> untuk memulai kembali');
        } else {
            // Handle jika pertanyaan tidak ditemukan
            $this->say("Maaf, jawaban untuk pertanyaan '{$selectedPertanyaan}' tidak ditemukan. Silahkan laporkan masalah ini dengan mengetik report");
        }
    }
}

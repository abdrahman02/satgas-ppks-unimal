<?php

namespace App\Conversations;

use App\Models\Tema;
use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer as BotManAnswer;
use BotMan\BotMan\Messages\Outgoing\Question as BotManQuestion;
use App\Models\Pertanyaan;


class ExampleConversation extends Conversation
{
    protected $topik = '';
    /**
     * First question
     */
    public function askHadits()
    {
        $temas = Tema::all();
        $buttonTemas = [];

        foreach ($temas as $tema) {
            $buttonTemas[] = Button::create($tema->tema)->value($tema->id);
        }

        $question = Question::create("Silahkan pilih informasi yang anda butuhkan.")
            ->fallback('Unable to ask question')
            ->callbackId('ask_reason')
            ->addButtons($buttonTemas);

        return $this->ask(
            $question,
            function (Answer $answer) {
                if ($answer->isInteractiveMessageReply()) {
                    $temaId = $answer->getValue();
                    $this->showPertanyaanButtons($temaId);
                    // switch ($tema) {
                    //     case 'dawud':
                    //         $this->topik = 'dawud';
                    //         $this->jawabanNya('HR. Abu Daud');
                    //         break;
                    //     case 'bukhari':
                    //         $this->topik = 'bukhari';
                    //         $this->jawabanNya('HR. Bukhari');
                    //         break;
                    //     case 'majah':
                    //         $this->topik = 'majah';
                    //         $this->jawabanNya('HR. Ibnu Majah');
                    //         break;
                    //     case 'muslim':
                    //         $this->topik = 'muslim';
                    //         $this->jawabanNya('HR. Muslim');
                    //         break;
                    //     case 'nasai':
                    //         $this->topik = 'nasai';
                    //         $this->jawabanNya('HR. Nasai');
                    //         break;
                    //     case 'tirmidzi':
                    //         $this->topik = 'tirmidzi';
                    //         $this->jawabanNya('HR. Tirmidzi');
                    //         break;

                    //     default:
                    //         # code...
                    //         break;
                    // }
                }
            }
        );
    }

    /**
     * Display pertanyaan buttons based on the selected tema.
     *
     * @param int $temaId
     */
    protected function showPertanyaanButtons($temaId)
    {
        $tema = Tema::find($temaId);
        if ($tema) {
            $pertanyaans = Pertanyaan::where('tema_id', $tema->id);
            $buttonPertanyaans = [];

            foreach ($pertanyaans as $pertanyaan) {
                $buttonPertanyaans[] = Button::create($pertanyaan->pertanyaan)->value($pertanyaan->pertanyaan);
            }

            $this->ask(
                Question::create("Silahkan pilih pertanyaan yang anda inginkan untuk tema '{$tema->tema}'.")
                    ->fallback('Unable to ask question')
                    ->callbackId('ask_pertanyaan')
                    ->addButtons($buttonPertanyaans),
                function (Answer $answer) {
                    // Handle pertanyaan selection
                    $this->handlePertanyaanSelection($answer);
                }
            );
        } else {
            // Handle the case where the temaId is not found
            // Provide a default action or error response
        }
    }

    /**
     * Handle the user's pertanyaan selection.
     *
     * @param Answer $answer
     */
    protected function handlePertanyaanSelection(Answer $answer)
    {
        $selectedPertanyaan = $answer->getValue();

        // Cari pertanyaan berdasarkan nama pertanyaan yang dipilih
        $pertanyaan = Pertanyaan::where('pertanyaan', $selectedPertanyaan)->first();

        if ($pertanyaan) {
            // Tampilkan jawaban untuk pertanyaan yang dipilih
            $this->say("Jawaban untuk pertanyaan '{$selectedPertanyaan}': {$pertanyaan->jawaban}");
        } else {
            // Handle jika pertanyaan tidak ditemukan
            $this->say("Maaf, jawaban untuk pertanyaan '{$selectedPertanyaan}' tidak ditemukan. Silahkan laporkan masalah ini dengan mengetik lapor");
        }
    }









    public function jawabanNya($tokoh)
    {
        $this->ask('Kamu memilih topik dari ' . $tokoh . '. Silahkan masukkan nomor hadits yang ingin dicari.', function (Answer $answer) {
            $no = $answer->getText();
            // echo $no;
            $hasil = $this->getData($this->topik, $no);
            $jawaban = sprintf("Hadits menjelaskan tentang: " . $hasil[3] . ". \r\t\n\n " . $hasil[0] . "\r\t\n\n " . $hasil[1]);
            // $this->say('Hadits menjelaskan tentang: '.$hasil[3]);
            // $this->say($hasil[0]);
            $this->say($jawaban);
            if ($hasil[2] == true) {
                $this->say('Silahkan laporkan permasalahan ini dengan menu /lapor .');
            }
        });
    }

    public function getData($topik, $no)
    {
        try {
            $str = 'https://scrape-fastapi.herokuapp.com/hadits/?tokoh=' . $topik . '&no=' . $no;
            // $str='https://hadits-api-zhirrr.vercel.app/books/'.$topik.'/'.$no;
            $dt = json_decode(file_get_contents($str));
            return [$dt->data->contents->arab, $dt->data->contents->id, false, $dt->data->contents->judul];
        } catch (\Throwable $th) {
            return ["Something went wrong 😯️", "Sepertinya ada masalah.🧐️", true];
        }
    }
    /**
     * Start the conversation
     */
    public function run()
    {
        $this->askHadits();
        // $this->cariLagi();
    }
}

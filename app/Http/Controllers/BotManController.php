<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Conversations\ChatBot;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\LaravelCache;
use BotMan\BotMan\Drivers\DriverManager;
use App\Conversations\ExampleConversation;
use BotMan\Drivers\Telegram\TelegramDriver;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        // Load the driver(s) you want to use
        DriverManager::loadDriver(TelegramDriver::class);

        $config = [
            // Your driver-specific configuration
            "telegram" => [
                "token" => "TOKEN_TELEGRAM_KAMU"
            ]
        ];
        $botman = BotManFactory::create($config, new LaravelCache());

        $botman->hears('/start|start', function (BotMan $bot) {
            $user = $bot->getUser();
            $bot->reply('Hai ' . $user->getFirstName() . ', saya adalah pemandu anda!, apa ada yang bisa saya bantu?');
            $bot->startConversation(new ChatBot());
        })->stopsConversation();

        $botman->hears('/report|report', function (BotMan $bot) {
            $bot->reply('Silahkan laporkan di email <strong>Satgas.ppks@unimal.ac.id</strong> . Laporan kamu akan sangat berharga buat kemajuan bot ini.');
        })->stopsConversation();

        $botman->hears('/about|about', function (BotMan $bot) {
            $bot->reply('Halo! Saya adalah pemandu di website Satgas PPKS UNIMAL. Tujuan saya adalah membantu Anda menjelajahi dan mendapatkan informasi yang Anda butuhkan.');
        })->stopsConversation();

        $botman->hears('/help|help', function (BotMan $bot) {
            $pesan = "Berikut adalah beberapa perintah yang dapat Anda gunakan:<br>";
            $pesan .= "- '/start' atau 'start': Memulai percakapan dengan bot.<br>";
            $pesan .= "- '/report' atau 'report': Melaporkan sesuatu kepada bot.<br>";
            $pesan .= "- '/about' atau 'about': Mengetahui informasi tentang bot.<br>";
            $pesan .= "- '/help' atau 'help': Menampilkan panduan perintah.<br>";
            $pesan .= "Anda juga dapat mengetik pertanyaan atau kata kunci lain untuk mencari informasi.";

            $bot->reply($pesan);
        })->stopsConversation();

        $botman->fallback(function (BotMan $bot) {
            $bot->reply("Maaf, saya tidak mengerti perintah tersebut. Gunakan '/help' untuk melihat daftar perintah yang tersedia.");
        });

        $botman->listen();
    }
}

<?php
namespace App\Mail; use Illuminate\Bus\Queueable; use Illuminate\Mail\Mailable; use Illuminate\Queue\SerializesModels; use Illuminate\Contracts\Queue\ShouldQueue; class OrderShipped extends Mailable { use Queueable, SerializesModels; public $order; public $card_msg; public $cards_txt; public function __construct($sp804c16, $sp059fe1, $sp5e8cfb) { $this->order = $sp804c16; $this->card_msg = $sp059fe1; $this->cards_txt = $sp5e8cfb; } public function build() { return $this->subject(config('app.name') . '-订单提醒 #' . $this->order->order_no)->view('emails.order'); } }
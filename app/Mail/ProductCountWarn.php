<?php
namespace App\Mail; use Illuminate\Bus\Queueable; use Illuminate\Mail\Mailable; use Illuminate\Queue\SerializesModels; use Illuminate\Contracts\Queue\ShouldQueue; class ProductCountWarn extends Mailable { use Queueable, SerializesModels; public $product = null; public $count = null; public function __construct($sp32da29, $spbc55c7) { $this->product = $sp32da29; $this->count = $spbc55c7; } public function build() { return $this->subject(config('app.name') . '-库存预警 #' . $this->product->name)->view('emails.product_count_warn'); } }
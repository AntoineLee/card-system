<?php
namespace App; use Hashids\Hashids; use Illuminate\Database\Eloquent\Model; class Product extends Model { protected $guarded = array(); const ID_API = -1001; public static function id_encode($sp403bd7) { $sp98c553 = new Hashids(config('app.key')); return @$sp98c553->encode($sp403bd7, 2); } public static function id_decode($sped151d) { $sp98c553 = new Hashids(config('app.key')); return @$sp98c553->decode($sped151d)[0]; } function getUrlAttribute() { return config('app.url') . '/p/' . self::id_encode($this->id); } function getCountAttribute() { return count($this->cards) ? $this->cards[0]->count : 0; } function category() { return $this->belongsTo(Category::class); } function cards() { return $this->hasMany(Card::class); } function coupons() { return $this->hasMany(Coupon::class); } function orders() { return $this->hasMany(Order::class); } function user() { return $this->belongsTo(User::class); } }
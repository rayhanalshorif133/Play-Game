<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'start_date_time',
        'end_date_time',
        'status',
        'description',
        'created_by',
        'updated_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function campaignDuration()
    {
        return $this->hasMany(CampaignDuration::class);
    }

    public function gameURL($campaign, $msisdn)
    {
        $game = Game::select()->first();
        $payload = '?campaign_id=' . $campaign->id . 'keyword=' . $game->keyword . '&token=' . $msisdn;

        $cipherMethod = 'AES-256-CBC';
        $secretKey = "B2M_T3chN0l0g!@$"; // Replace with your actual secret key
        $ivLength = openssl_cipher_iv_length($cipherMethod);
        $payload = $this->encrypt($payload, $secretKey, $cipherMethod, $ivLength);
        $url = $game->url . '?payload=' . $payload;
        return $url;
    }



    // Function to encrypt a string
    function encrypt($data, $key, $cipherMethod, $ivLength)
    {
        $iv = openssl_random_pseudo_bytes($ivLength); // Generate a random initialization vector
        $encryptedData = openssl_encrypt($data, $cipherMethod, $key, 0, $iv);
        // Combine the IV and encrypted data for decryption
        return base64_encode($iv . $encryptedData);
    }
}

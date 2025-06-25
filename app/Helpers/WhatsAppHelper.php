<?php

namespace App\Helpers;

class WhatsAppHelper
{
    /**
     * Format phone number for WhatsApp API
     * 
     * @param string $phone
     * @return string
     */
    public static function formatPhoneForWhatsApp($phone)
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // If phone starts with 0, replace with 62 (Indonesia country code)
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }
        
        // If phone doesn't start with country code, add 62
        if (substr($phone, 0, 2) !== '62') {
            $phone = '62' . $phone;
        }
        
        return $phone;
    }
    
    /**
     * Generate WhatsApp URL with pre-filled message
     * 
     * @param string $phone
     * @param string $message
     * @return string
     */
    public static function generateWhatsAppUrl($phone, $message = '')
    {
        $formattedPhone = self::formatPhoneForWhatsApp($phone);
        $encodedMessage = urlencode($message);
        
        return "https://wa.me/{$formattedPhone}?text={$encodedMessage}";
    }
    
    /**
     * Check if phone number is valid for WhatsApp
     * 
     * @param string $phone
     * @return bool
     */
    public static function isValidPhone($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        return strlen($phone) >= 10 && strlen($phone) <= 15;
    }
} 
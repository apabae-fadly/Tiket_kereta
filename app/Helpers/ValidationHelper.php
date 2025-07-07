<?php

namespace App\Helpers;

class ValidationHelper
{
    /**
     * Validasi format email
     */
    public static function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Validasi nomor telepon Indonesia
     */
    public static function isValidPhone(string $phone): bool
    {
        // Format: +62 atau 08xx
        return preg_match('/^(\+62|62|0)8[1-9][0-9]{6,9}$/', $phone);
    }

    /**
     * Validasi NIK (Nomor Induk Kependudukan)
     */
    public static function isValidNIK(string $nik): bool
    {
        // NIK harus 16 digit angka
        return preg_match('/^[0-9]{16}$/', $nik);
    }

    /**
     * Validasi password strength
     */
    public static function isStrongPassword(string $password): bool
    {
        // Minimal 8 karakter, mengandung huruf besar, kecil, angka
        return strlen($password) >= 8 
            && preg_match('/[A-Z]/', $password) 
            && preg_match('/[a-z]/', $password) 
            && preg_match('/[0-9]/', $password);
    }

    /**
     * Format rupiah
     */
    public static function formatRupiah(float $amount): string
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }

    /**
     * Format tanggal Indonesia
     */
    public static function formatTanggal(string $date): string
    {
        $bulan = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        
        $timestamp = strtotime($date);
        $tanggal = date('j', $timestamp);
        $bulan_index = date('n', $timestamp);
        $tahun = date('Y', $timestamp);
        
        return $tanggal . ' ' . $bulan[$bulan_index] . ' ' . $tahun;
    }

    /**
     * Format waktu
     */
    public static function formatWaktu(string $time): string
    {
        return date('H:i', strtotime($time));
    }

    /**
     * Generate kode booking
     */
    public static function generateBookingCode(): string
    {
        return 'BK' . date('Ymd') . rand(1000, 9999);
    }

    /**
     * Generate kode tiket
     */
    public static function generateTicketCode(): string
    {
        return 'TK' . date('Ymd') . rand(1000, 9999);
    }

    /**
     * Sanitasi input
     */
    public static function sanitizeInput(string $input): string
    {
        return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Validasi file upload
     */
    public static function isValidImage($file): bool
    {
        if (!$file || !$file->isValid()) {
            return false;
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 5 * 1024 * 1024; // 5MB

        return in_array($file->getMimeType(), $allowedTypes) && $file->getSize() <= $maxSize;
    }
} 
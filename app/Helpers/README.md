# Helper Classes

Dokumentasi untuk helper classes yang telah dibuat untuk memudahkan pengembangan aplikasi.

## UserHelper

Helper untuk validasi dan fungsi terkait user.

### Methods:

#### `IsAdmin(): bool`
Cek apakah user yang sedang login adalah admin.
```php
if (UserHelper::IsAdmin()) {
    // User adalah admin
}
```

#### `isUser(): bool`
Cek apakah user yang sedang login adalah user biasa.
```php
if (UserHelper::isUser()) {
    // User adalah user biasa
}
```

#### `currentUser(): ?User`
Dapatkan user yang sedang login.
```php
$user = UserHelper::currentUser();
```

#### `currentUserId(): ?int`
Dapatkan ID user yang sedang login.
```php
$userId = UserHelper::currentUserId();
```

#### `isLoggedIn(): bool`
Cek apakah user sudah login.
```php
if (UserHelper::isLoggedIn()) {
    // User sudah login
}
```

#### `hasRole(string $role): bool`
Cek apakah user memiliki role tertentu.
```php
if (UserHelper::hasRole('admin')) {
    // User memiliki role admin
}
```

#### `currentUserName(): string`
Dapatkan nama user yang sedang login.
```php
$name = UserHelper::currentUserName();
```

#### `currentUserEmail(): string`
Dapatkan email user yang sedang login.
```php
$email = UserHelper::currentUserEmail();
```

#### `requireAdmin()`
Redirect dengan pesan error jika bukan admin.
```php
$redirect = UserHelper::requireAdmin();
if ($redirect) {
    return $redirect;
}
```

#### `requireLogin()`
Redirect dengan pesan error jika belum login.
```php
$redirect = UserHelper::requireLogin();
if ($redirect) {
    return $redirect;
}
```

## ValidationHelper

Helper untuk validasi dan format data.

### Methods:

#### `isValidEmail(string $email): bool`
Validasi format email.
```php
if (ValidationHelper::isValidEmail($email)) {
    // Email valid
}
```

#### `isValidPhone(string $phone): bool`
Validasi nomor telepon Indonesia.
```php
if (ValidationHelper::isValidPhone($phone)) {
    // Nomor telepon valid
}
```

#### `isValidNIK(string $nik): bool`
Validasi NIK (Nomor Induk Kependudukan).
```php
if (ValidationHelper::isValidNIK($nik)) {
    // NIK valid
}
```

#### `isStrongPassword(string $password): bool`
Validasi kekuatan password.
```php
if (ValidationHelper::isStrongPassword($password)) {
    // Password kuat
}
```

#### `formatRupiah(float $amount): string`
Format rupiah.
```php
$formatted = ValidationHelper::formatRupiah(1000000);
// Output: Rp 1.000.000
```

#### `formatTanggal(string $date): string`
Format tanggal Indonesia.
```php
$formatted = ValidationHelper::formatTanggal('2024-01-15');
// Output: 15 Januari 2024
```

#### `formatWaktu(string $time): string`
Format waktu.
```php
$formatted = ValidationHelper::formatWaktu('14:30:00');
// Output: 14:30
```

#### `generateBookingCode(): string`
Generate kode booking.
```php
$code = ValidationHelper::generateBookingCode();
// Output: BK202401151234
```

#### `generateTicketCode(): string`
Generate kode tiket.
```php
$code = ValidationHelper::generateTicketCode();
// Output: TK202401151234
```

#### `sanitizeInput(string $input): string`
Sanitasi input untuk mencegah XSS.
```php
$clean = ValidationHelper::sanitizeInput($userInput);
```

#### `isValidImage($file): bool`
Validasi file upload gambar.
```php
if (ValidationHelper::isValidImage($file)) {
    // File gambar valid
}
```

## ResponseHelper

Helper untuk response dan flash message.

### Methods:

#### `successRedirect(string $message, string $route = '/'): RedirectResponse`
Response sukses dengan redirect.
```php
return ResponseHelper::successRedirect('Data berhasil disimpan', route('index'));
```

#### `errorRedirect(string $message, string $route = '/'): RedirectResponse`
Response error dengan redirect.
```php
return ResponseHelper::errorRedirect('Terjadi kesalahan', route('index'));
```

#### `successJson(string $message, $data = null, int $code = 200): JsonResponse`
Response sukses JSON.
```php
return ResponseHelper::successJson('Data berhasil disimpan', $data);
```

#### `errorJson(string $message, int $code = 400): JsonResponse`
Response error JSON.
```php
return ResponseHelper::errorJson('Terjadi kesalahan');
```

#### `notFoundJson(string $message = 'Data tidak ditemukan'): JsonResponse`
Response not found JSON.
```php
return ResponseHelper::notFoundJson();
```

#### `unauthorizedJson(string $message = 'Akses ditolak'): JsonResponse`
Response unauthorized JSON.
```php
return ResponseHelper::unauthorizedJson();
```

#### `forbiddenJson(string $message = 'Akses dilarang'): JsonResponse`
Response forbidden JSON.
```php
return ResponseHelper::forbiddenJson();
```

#### `validationErrorJson(array $errors): JsonResponse`
Response validation error JSON.
```php
return ResponseHelper::validationErrorJson($errors);
```

#### `flashSuccess(string $message): void`
Flash message sukses.
```php
ResponseHelper::flashSuccess('Data berhasil disimpan');
```

#### `flashError(string $message): void`
Flash message error.
```php
ResponseHelper::flashError('Terjadi kesalahan');
```

#### `flashWarning(string $message): void`
Flash message warning.
```php
ResponseHelper::flashWarning('Peringatan');
```

#### `flashInfo(string $message): void`
Flash message info.
```php
ResponseHelper::flashInfo('Informasi');
```

#### `hasFlash(string $type = null): bool`
Cek apakah ada flash message.
```php
if (ResponseHelper::hasFlash()) {
    // Ada flash message
}
```

#### `getFlash(string $type): ?string`
Dapatkan flash message.
```php
$message = ResponseHelper::getFlash('success');
```

## Contoh Penggunaan di Controller

```php
<?php

namespace App\Http\Controllers;

use App\Helpers\UserHelper;
use App\Helpers\ResponseHelper;
use App\Helpers\ValidationHelper;

class ExampleController extends Controller
{
    public function index()
    {
        // Cek apakah user adalah admin
        if (!UserHelper::IsAdmin()) {
            return ResponseHelper::forbiddenJson('Akses ditolak');
        }

        // Sanitasi input
        $cleanInput = ValidationHelper::sanitizeInput($request->input('name'));

        // Format rupiah
        $price = ValidationHelper::formatRupiah(1000000);

        // Flash message
        ResponseHelper::flashSuccess('Data berhasil disimpan');

        return view('example.index');
    }
}
```

## Contoh Penggunaan di View

```php
@if(UserHelper::isLoggedIn())
    <p>Selamat datang, {{ UserHelper::currentUserName() }}</p>
@endif

@if(ResponseHelper::hasFlash('success'))
    <div class="alert alert-success">
        {{ ResponseHelper::getFlash('success') }}
    </div>
@endif

<p>Harga: {{ ValidationHelper::formatRupiah($product->price) }}</p>
<p>Tanggal: {{ ValidationHelper::formatTanggal($order->created_at) }}</p>
``` 
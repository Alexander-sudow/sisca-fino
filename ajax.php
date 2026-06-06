<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Metode request tidak diizinkan.'
    ]);
    exit;
}

// 1. Fetch and Sanitize Input
$name = isset($_POST['name']) ? trim(strip_tags($_POST['name'])) : '';
$attendance = isset($_POST['attendance']) ? trim(strip_tags($_POST['attendance'])) : '';
$guests = isset($_POST['guests']) ? intval($_POST['guests']) : 1;
$wish = isset($_POST['wish']) ? trim(strip_tags($_POST['wish'])) : '';

// Validation
if (empty($name)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Nama tamu harus diisi.'
    ]);
    exit;
}

if (empty($attendance) || !in_array($attendance, ['hadir', 'tidak_hadir'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Konfirmasi kehadiran harus dipilih.'
    ]);
    exit;
}

// Time zone setup
date_default_timezone_set('Asia/Jakarta');
$timestamp = date('Y-m-d H:i:s');

// Paths
$rsvpFile = __DIR__ . '/data/rsvp.json';
$wishesFile = __DIR__ . '/data/wishes.json';

// Ensure data folder exists
if (!is_dir(__DIR__ . '/data')) {
    mkdir(__DIR__ . '/data', 0755, true);
}

// 2. Save RSVP data
$rsvpData = [];
if (file_exists($rsvpFile)) {
    $rsvpData = json_decode(file_get_contents($rsvpFile), true) ?: [];
}

$newRsvp = [
    'name' => $name,
    'attendance' => $attendance,
    'guests' => ($attendance === 'hadir') ? $guests : 0,
    'timestamp' => $timestamp
];

$rsvpData[] = $newRsvp;
file_put_contents($rsvpFile, json_encode($rsvpData, JSON_PRETTY_PRINT));

// 3. Save Wish data (if user wrote something)
$wishesData = [];
if (file_exists($wishesFile)) {
    $wishesData = json_decode(file_get_contents($wishesFile), true) ?: [];
}

if (!empty($wish)) {
    $newWish = [
        'name' => $name,
        'wish' => $wish,
        'status' => ($attendance === 'hadir') ? 'Hadir' : 'Tidak Hadir',
        'timestamp' => $timestamp
    ];
    // Put new wish at the beginning of the list (so it shows on top)
    array_unshift($wishesData, $newWish);
    file_put_contents($wishesFile, json_encode($wishesData, JSON_PRETTY_PRINT));
}

// Return the list of wishes to update the guestbook dynamically
echo json_encode([
    'status' => 'success',
    'message' => 'Konfirmasi kehadiran dan ucapan berhasil dikirim.',
    'wishes' => $wishesData
]);
exit;

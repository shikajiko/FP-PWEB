<?php

require_once __DIR__ . '/config.php';

/**
 * Provide a shared PDO connection and ensure schema exists.
 */
function getDb(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $defaultPath = __DIR__ . '/../data/app.db';
    $dbPath = env('APP_DB_PATH', $defaultPath);
    $dbDir = dirname($dbPath);

    if (!is_dir($dbDir)) {
        mkdir($dbDir, 0777, true);
    }
    if (!is_writable($dbDir)) {
        $tmpDir = sys_get_temp_dir() . '/fp-pweb';
        if (!is_dir($tmpDir)) {
            mkdir($tmpDir, 0777, true);
        }
        $dbPath = $tmpDir . '/app.db';
        $dbDir = $tmpDir;
    }

    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE,
            password_hash TEXT NOT NULL,
            verification_token TEXT,
            verified_at TEXT,
            created_at TEXT NOT NULL,
            updated_at TEXT NOT NULL
        )'
    );

    return $pdo;
}

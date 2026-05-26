<?php
declare(strict_types=1);
require_once __DIR__ . '/../Exeptions/InvalidUserPasswordException.php';

final class UserPassword
{
    private string $value;

    private function __construct(string $value)
    {
        // Internal constructor expects the stored value (hash or plain),
        // perform minimal validation: non-empty and reasonable length.
        $normalized = trim($value);

        if ($normalized === '') {
            throw InvalidUserPasswordException::becauseValueIsEmpty();
        }

        if (strlen($normalized) < 8) {
            throw InvalidUserPasswordException::becauseLengthIsTooShort(8);
        }

        $this->value = $normalized;
    }

    public static function fromPlainText(string $plain): self
    {
        $normalized = trim($plain);

        if ($normalized === '') {
            throw InvalidUserPasswordException::becauseValueIsEmpty();
        }

        if (strlen($normalized) < 8) {
            throw InvalidUserPasswordException::becauseLengthIsTooShort(8);
        }

        $hash = password_hash($normalized, PASSWORD_DEFAULT);

        return new self($hash);
    }

    public static function fromHash(string $hash): self
    {
        return new self($hash);
    }

    public function verifyPlain(string $plain): bool
    {
        return password_verify($plain, $this->value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(UserPassword $other): bool
    {
        return hash_equals($this->value, $other->value());
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
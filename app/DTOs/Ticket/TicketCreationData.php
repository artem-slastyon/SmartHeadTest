<?php

namespace App\DTOs\Ticket;

use Illuminate\Http\UploadedFile;

readonly class TicketCreationData
{

    /**
     * @param string $email
     * @param string $name
     * @param string|null $phone
     * @param string $subject
     * @param string $text
     * @param UploadedFile[] $files
     */
    public function __construct(
        public string $email,
        public string $name,
        public ?string $phone,

        public string $subject,
        public string $text,

        public array $files
    ) {
    }
}

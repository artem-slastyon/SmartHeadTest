<?php

namespace App\Models;

use App\Enums\TicketStatus;
use Database\Factories\TicketFactory;
use DateTime;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\FileAdder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @method void prepareToAttachMedia(Media $media, FileAdder $fileAdder)
 */
class Ticket extends Model implements HasMedia
{
    /** @use HasFactory<TicketFactory> */
    use HasFactory;
    use InteractsWithMedia;

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments');
    }

    #[Scope]
    protected function whereCustomerEmailContains(Builder $query, string $email): void
    {
        $query->whereRelation('customer', 'email', 'like', "%$email%");
    }

    #[Scope]
    protected function whereCustomerPhoneContains(Builder $query, string $phone): void
    {
        $query->whereRelation('customer', 'phone', 'like', "%$phone%");
    }

    #[Scope]
    protected function withStatus(Builder $query, TicketStatus $status): void
    {
        $query->where('status', '=', $status);
    }

    #[Scope]
    protected function whereWasCreatedBefore(Builder $query, DateTime $dateTo): void
    {
        $query->where('created_at', '<=', $dateTo);
    }

    #[Scope]
    protected function whereWasCreatedAfter(Builder $query, DateTime $dateFrom): void
    {
        $query->where('created_at', ">=", $dateFrom);
    }

    protected $casts = [
        'status' => TicketStatus::class,
        'response_at' => 'datetime'
    ];

    protected $fillable = [
        'subject',
        'text',
        'status'
    ];
}

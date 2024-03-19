<?php

namespace App\Modules\Feedback\DTO;
use App\Modules\Base\DTO\BaseDTO;
use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Attributes\Validation\File;
use Spatie\LaravelData\Attributes\Validation\Max;

/**
 * @OA\Schema(
 *      title="FeedbackStoreDTO",
 *      type="object",
 *      required={"subject", "message"}
 * )
 * @OA\Property(property="subject", type="string"),
 * @OA\Property(property="message", type="string"),
 * @OA\Property(property="attachment", type="string", format="binary"),
 */
class FeedbackStoreDTO extends BaseDto
{
    public string $subject;
    public string $message;
    #[File, Max(5000)]
    public ?UploadedFile $attachment; 
}
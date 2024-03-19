<?php

namespace App\Modules\Feedback\Services;


use App\Modules\Base\DTO\PaginateParamsDTO;
use App\Modules\Feedback\DTO\FeedbackDTO;
use App\Modules\Feedback\DTO\FeedbackStoreDTO;
use App\Modules\Feedback\DTO\RequestDTO;
use App\Modules\Feedback\DTO\RequestIndexDTO;
use App\Modules\Feedback\DTO\RequestStoreDTO;
use App\Modules\Feedback\DTO\RequestResolveDTO;
use App\Modules\Feedback\Mail\NewFeedback;
use App\Modules\Feedback\Mail\RequestResolved;
use App\Modules\Feedback\Models\Feedback;
use App\Modules\User\Models\User;
use App\Modules\User\Services\UserService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;

class FeedbackService
{
    function __construct(
        private UserService $userService
    ) {
    }

    public function getPaginated(PaginateParamsDTO $paginateParams)
    {
        $paginator = Feedback::query()->orderBy($paginateParams->sort, $paginateParams->dir)->paginate($paginateParams->count);
        return FeedbackDTO::collect($paginator);
    }

    public function getById(int $id)
    {
        $data = Feedback::findOrFail($id);
        return FeedbackDTO::from($data);
    }

    public function createFeedback(FeedbackStoreDTO $dto, int $userId): void
    {
        
        $feedback = new Feedback();
        $feedback->fill($dto->except('attachment')->toArray());

        if(isset($dto->attachment)){
            $attachmentPath = $dto->attachment->store('', 'attachments');
            $feedback->attachment = $attachmentPath;
        }
        
        $feedback->client()->associate($userId);
        $feedback->saveOrFail();
        $feedback->refresh()->load('client');
        $this->sendMailToManagers(FeedbackDTO::from($feedback));
    }


    private function sendMailToManagers(FeedbackDTO $feedback){

        $managers = $this->userService->getManagers();

        foreach ($managers as $manager) {
            Mail::mailer('log')->to($manager->email)->send(new NewFeedback($feedback));
        }

        
    }

}
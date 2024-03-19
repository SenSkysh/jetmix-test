<?php

namespace Tests\Feature;


use App\Modules\Feedback\DTO\FeedbackDTO;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;


use App\Modules\User\Models\User;
use App\Modules\Feedback\Models\Feedback as TestModel;
use App\Modules\Feedback\Mail\NewFeedback;

class FeedbackTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    


    static $apiPath = 'api/feedback';
    
    private $client;
    private $manager;

    public function test_the_store(): void
    {

        Mail::fake();
        Storage::fake('attachments');

        $data =  [
            'subject' => fake()->name(),
            'message' => fake()->paragraph(),
            'attachment' => UploadedFile::fake()->image("descimage2.jpg", 800, 200)
        ];
        
        
        $response = $this->postJson(self::$apiPath, $data);
        $response->assertStatus(401);

        $response = $this->actingAs($this->manager)->postJson(self::$apiPath, $data);
        $response->assertStatus(403);

        $response = $this->actingAs($this->client)->post(self::$apiPath, $data);
        $response->assertStatus(200);


        unset($data["attachment"]);
        $this->assertDatabaseHas(TestModel::class, $data);
        Mail::assertSent(NewFeedback::class);

        $saved = TestModel::where($data)->first();

        Storage::disk('attachments')->assertExists($saved->attachment);

    }


    public function test_the_index(): void
    {
        TestModel::factory()->count(3)->create();

        $response = $this->getJson(self::$apiPath);
        $response->assertStatus(401);

        $response = $this->actingAs($this->client)->getJson(self::$apiPath);
        $response->assertStatus(403);

        $response = $this->actingAs($this->manager)->getJson(self::$apiPath);
        $response->assertStatus(200);
        $response->assertJsonCount(3, "data");
    }

    public function test_the_show(): void
    {
        $model = TestModel::factory()->count(1)->create()->first();

        $response = $this->getJson(self::$apiPath);
        $response->assertStatus(401);

        $response = $this->actingAs($this->client)->getJson(self::$apiPath);
        $response->assertStatus(403);

        $response = $this->actingAs($this->manager)->getJson(self::$apiPath.'/'.$model->id);
        $response->assertStatus(200);       

        $response->assertJsonFragment(FeedbackDTO::from($model)->toArray());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = User::factory()->create(['role' => 'client']);

        $this->manager = User::factory()->create(['role' => 'manager']);
    }








}

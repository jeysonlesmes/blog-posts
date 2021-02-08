<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the posts from another blogging platform';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \DB::beginTransaction();

        try {
            $url = env("URL_IMPORT_POSTS");
            $response = Http::get($url);

            if ($response->ok()) {
                Post::insert($this->getPosts($response->json()));
                \DB::commit();

                $this->info("The posts have been imported successfully");

                return 1;
            }
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error($e->getMessage());
            $this->error("The posts have not been imported");
        }

        return 0;
    }

    private function getPosts(array $data): array
    {
        $posts = [];
        $now = date("Y-m-d H:i:s");
        $user = $this->getUser($now);

        collect($data)->each(function ($row) use (&$posts, $now, $user) {
            collect($row)->each(function ($post) use (&$posts, $now, $user) {
                $posts[] = [
                    "title" => data_get($post, "title", ""),
                    "description" => data_get($post, "description", ""),
                    "publicated_at" => data_get($post, "publication_date", $now),
                    "user_id" => $user->id,
                    "created_at" => $now,
                    "updated_at" => $now
                ];
            });
        });

        return $posts;
    }

    private function getUser(String $now): User
    {
        $user = User::whereIsAdmin(true)->first();

        if (!$user) {
            return $this->createUser($now);
        }

        return $user;
    }

    private function createUser(String $now): User
    {
        $user = new User;
        $user->name = "Administrator";
        $user->email = "admin@admin.com";
        $user->is_admin = true;
        $user->password = bcrypt("mypassword");
        $user->created_at = $now;
        $user->updated_at = $now;

        $user->save();

        return $user;
    }
}

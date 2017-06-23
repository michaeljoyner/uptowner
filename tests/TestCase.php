<?php

namespace Tests;

use App\Exceptions\Handler;
use App\GroupedTranslationAttributes;
use App\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function disableExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, new class extends Handler
        {
            public function __construct()
            {
            }

            public function report(\Exception $e)
            {
                // no-op
            }

            public function render($request, \Exception $e)
            {
                throw $e;
            }

        });
    }

    public function asLoggedInUser($superadmin = true, $attributes = [])
    {
        $data = array_merge(
            ['email' => 'joe@example.com', 'password' => 'password', 'superadmin' => $superadmin],
            $attributes
        );
        $this->actingAs(factory(User::class)->create($data));

        return $this;
    }

    public function assertTranslatableTableHas($table, $data)
    {
        $formatted_data = collect(GroupedTranslationAttributes::from($data))->flatMap(function($value, $field) {
            $new_value = is_array($value) && array_key_exists('zh', $value) ? json_encode($value) : $value;
            return [$field => $new_value];
        })->toArray();

        $this->assertDatabaseHas($table, $formatted_data);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Artifact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_artifact_list_page_is_reachable(): void
    {
        $response = $this->get('/artifacts');

        $response->assertOk();
    }

    public function test_artifact_can_be_created(): void
    {
        $response = $this->post('/artifacts', [
            'artifact_type' => 'pc',
            'name' => 'Dell Latitude 5440 / i5 / 16GB / 14inch',
            'maker' => 'Dell',
            'model' => 'Latitude 5440',
            'cpu' => 'i5',
            'memory_gb' => 16,
            'storage_gb' => 512,
            'display_size' => '14inch',
        ]);

        $response->assertRedirect('/artifacts');

        $this->assertDatabaseHas('artifacts', [
            'artifact_type' => 'pc',
            'name' => 'Dell Latitude 5440 / i5 / 16GB / 14inch',
        ]);
    }

    public function test_artifact_creation_validates_required_fields(): void
    {
        $response = $this->post('/artifacts', [
            'artifact_type' => 'pc',
            'name' => '',
        ]);

        $response->assertSessionHasErrors(['name']);
    }

    public function test_artifact_list_supports_keyword_search(): void
    {
        Artifact::query()->create([
            'artifact_type' => 'pc',
            'name' => 'Dell Latitude 5440 / i5 / 16GB / 14inch',
        ]);

        Artifact::query()->create([
            'artifact_type' => 'monitor',
            'name' => 'Dell 27 Monitor',
        ]);

        $response = $this->get('/artifacts?q=Latitude');

        $response->assertOk();
        $response->assertSeeText('Latitude');
        $response->assertDontSeeText('Dell 27 Monitor');
    }
}

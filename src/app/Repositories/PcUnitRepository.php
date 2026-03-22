<?php

namespace App\Repositories;

use App\Models\PcUnit;
use Illuminate\Support\Facades\DB;

class PcUnitRepository
{
    public function createForArtifact(int $artifactId, int $quantity): void
    {
        if ($quantity <= 0) {
            return;
        }

        $maxSerial = PcUnit::query()
            ->where('management_no', 'like', 'kepc%')
            ->lockForUpdate()
            ->selectRaw('MAX(CAST(SUBSTR(management_no, 5) AS INTEGER)) as max_serial')
            ->value('max_serial');

        $nextSerial = ((int) $maxSerial) + 1;
        $rows = [];
        $now = now();

        for ($i = 0; $i < $quantity; $i++) {
            $serial = $nextSerial + $i;
            $rows[] = [
                'artifact_id' => $artifactId,
                'management_no' => sprintf('kepc%04d', $serial),
                'status' => '在庫',
                'warranty' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('pc_units')->insert($rows);
    }
}

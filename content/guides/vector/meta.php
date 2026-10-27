<?php
declare(strict_types=1);

return [
    'title' => 'Vector growth (and why mid-insert is different)',
    'summary' => 'Dynamic arrays grow by doubling so appends stay cheap; inserting in the middle still costs O(n) and shows up in rebuild-by-height style problems.',
    'category' => 'Data Structures',
    'subcategory' => 'Arrays',
    'kind' => 'algo',
    'tags' => ['vector', 'dynamic-array'],
    'related_session' => 'vector',
    'topic' => 'Data Structures · Arrays',
    'related_game' => 'vector-game',
];

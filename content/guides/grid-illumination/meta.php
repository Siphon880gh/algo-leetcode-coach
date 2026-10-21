<?php
declare(strict_types=1);

return [
    'title' => 'Grid Illumination: count lamps per line',
    'leetcode' => 1001,
    'difficulty' => 'Hard',
    'summary' => 'A cell is lit if some lamp shares its row, column, diagonal (r − c) or anti-diagonal (r + c). Keep a count for each line and a set of lamp positions. For each query, check the four counts, then switch off lamps in the 3 × 3 area around it.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'matrix', 'leetcode'],
    'related_session' => 'grid-illumination',
];

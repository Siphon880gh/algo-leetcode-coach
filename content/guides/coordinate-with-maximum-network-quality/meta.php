<?php
declare(strict_types=1);

return [
    'title' => 'Coordinate With Maximum Network Quality: brute force the grid',
    'leetcode' => 1620,
    'difficulty' => 'Med',
    'summary' => 'Coordinates are 0 … 50, so test every integer point: sum ⌊q / (1 + d)⌋ over towers within radius, and keep the best (smallest coordinate on ties).',
    'category' => 'LeetCode',
    'subcategory' => 'Enumeration',
    'topic' => 'LeetCode · Enumeration',
    'kind' => 'algo',
    'tags' => ['enumeration', 'geometry', 'leetcode'],
    'related_session' => 'coordinate-with-maximum-network-quality',
];

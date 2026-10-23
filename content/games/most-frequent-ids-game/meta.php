<?php
declare(strict_types=1);

return [
    'title' => 'Most Frequent IDs',
    'leetcode' => 3092,
    'difficulty' => 'Med',
    'summary' => 'Maintain counts per id plus a max-heap of (count, id) entries; after each update pop stale entries until the top matches the live count.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'tags' => ['heap', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'most-frequent-ids',
    'related_session' => 'most-frequent-ids',
];

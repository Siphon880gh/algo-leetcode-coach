<?php
declare(strict_types=1);

return [
    'title' => 'Partition Labels: extend each part to its letters\' last occurrences',
    'leetcode' => 763,
    'difficulty' => 'Med',
    'summary' => 'Record the last index of every letter. Scan while extending the current part\'s end to the last occurrence of each letter seen; when the scan reaches that end, cut a part.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'two-pointers', 'hash-map', 'strings', 'leetcode'],
    'related_session' => 'partition-labels',
];

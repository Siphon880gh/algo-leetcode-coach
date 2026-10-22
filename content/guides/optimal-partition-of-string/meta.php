<?php
declare(strict_types=1);

return [
    'title' => 'Optimal Partition of String: cut at the first repeat',
    'leetcode' => 2405,
    'difficulty' => 'Med',
    'summary' => 'Scan left to right keeping the letters of the current piece. When a letter is already in it, start a new piece there. Cutting as late as possible gives the fewest pieces.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['hash-table', 'string', 'greedy', 'leetcode'],
    'related_session' => 'optimal-partition-of-string',
];

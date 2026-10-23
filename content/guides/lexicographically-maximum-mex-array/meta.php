<?php
declare(strict_types=1);

return [
    'title' => 'Lexicographically Maximum MEX Array: greedy with suffix MEX',
    'leetcode' => 3948,
    'difficulty' => 'Hard',
    'summary' => 'The first value can be at most the MEX of what is left. Reach it with the shortest prefix, which keeps the rest as long as possible, and repeat. Once 0 is gone, take single elements so the result is as long as possible.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'queue', 'array', 'hash-table', 'leetcode'],
    'related_session' => 'lexicographically-maximum-mex-array',
];

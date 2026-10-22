<?php
declare(strict_types=1);

return [
    'title' => 'Construct the Longest New String: alternate AA and BB, then all AB',
    'leetcode' => 2745,
    'difficulty' => 'Med',
    'summary' => 'Alternate AA and BB as long as both last, plus one extra of the more plentiful kind, and every AB fits too. The answer is 2 · (2 · min(x, y) + [x ≠ y] + z).',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['math', 'greedy', 'leetcode'],
    'related_session' => 'construct-the-longest-new-string',
];

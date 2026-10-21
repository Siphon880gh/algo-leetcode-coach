<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Swaps to Make the String Balanced: maximum deficit',
    'leetcode' => 1963,
    'difficulty' => 'Med',
    'summary' => 'Scan with a balance of unmatched closing brackets (] adds 1, [ subtracts 1) and track its maximum mx. Each swap fixes two units of deficit, so the answer is ceil(mx / 2).',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'stack', 'string', 'leetcode'],
    'related_session' => 'minimum-number-of-swaps-to-make-the-string-balanced',
];

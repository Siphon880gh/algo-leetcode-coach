<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Score After Pair Deletions: minimize what stays',
    'leetcode' => 3496,
    'difficulty' => 'Med',
    'summary' => 'Every operation removes from the ends, so what remains is one element (odd length) or two neighbors (even length), and any such choice is reachable. Score = total − the smallest possible remainder.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'leetcode'],
    'related_session' => 'maximize-score-after-pair-deletions',
];

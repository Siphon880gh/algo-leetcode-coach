<?php
declare(strict_types=1);

return [
    'title' => 'Count Shadow Pairs I',
    'leetcode' => 4054,
    'difficulty' => 'Med',
    'summary' => 'A smaller value between i and j blocks the pair, so j must come before R[i], the next strictly smaller index (found with a monotonic stack). Inside (i, R[i]) every value is at least nums[i]; the pairs are the strictly larger ones.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'tags' => ['mono-stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-shadow-pairs-i',
    'related_session' => 'count-shadow-pairs-i',
];

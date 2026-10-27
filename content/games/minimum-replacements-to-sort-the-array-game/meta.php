<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Replacements to Sort: split from the right',
    'leetcode' => 2366,
    'difficulty' => 'Hard',
    'summary' => 'Go right to left with the current bound. If x > bound, split it into p = (x divided by bound, rounded up) parts (p − 1 operations); the new bound is x divided by p, rounded down.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-replacements-to-sort-the-array',
    'related_session' => 'minimum-replacements-to-sort-the-array',
];

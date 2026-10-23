<?php
declare(strict_types=1);

return [
    'title' => 'Count Powerful Integers: free prefix digits ≤ limit, fixed suffix',
    'leetcode' => 2999,
    'difficulty' => 'Hard',
    'summary' => 'x = prefix · 10^|s| + s with every digit ≤ limit. count(N) walks N\'s prefix digits: smaller digits (≤ limit) leave (limit + 1)^(rest) choices; a digit above limit caps everything. Answer = count(finish) − count(start − 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-the-number-of-powerful-integers',
    'related_session' => 'count-the-number-of-powerful-integers',
];

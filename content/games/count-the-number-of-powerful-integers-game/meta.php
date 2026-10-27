<?php
declare(strict_types=1);

return [
    'title' => 'Count Powerful Integers: free prefix digits at most limit, fixed suffix',
    'leetcode' => 2999,
    'difficulty' => 'Hard',
    'summary' => 'x = prefix times 10 to the power |s| + s with every digit at most limit. count(N) walks N\'s prefix digits: smaller digits (at most limit) leave (limit + 1) to the power (rest) choices; a digit above limit caps everything. Answer = count(finish) − count(start − 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-the-number-of-powerful-integers',
    'related_session' => 'count-the-number-of-powerful-integers',
];

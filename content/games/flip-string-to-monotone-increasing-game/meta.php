<?php
declare(strict_types=1);

return [
    'title' => 'Flip String to Monotone Increasing: flip this 0 or all earlier 1s',
    'leetcode' => 926,
    'difficulty' => 'Med',
    'summary' => 'Scan left to right with ones = 1s seen. On "1": ones++. On "0": flips = min(flips + 1, ones) (flip this 0 to 1, or flip every earlier 1 to 0).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'flip-string-to-monotone-increasing',
    'related_session' => 'flip-string-to-monotone-increasing',
];

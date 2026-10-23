<?php
declare(strict_types=1);

return [
    'title' => 'Find the Number of Subarrays Where Boundary Elements Are Maximum',
    'leetcode' => 3113,
    'difficulty' => 'Hard',
    'summary' => 'Decreasing stack of [value, count]: pop smaller values; if the top equals x, increment its count, else push [x, 1]. Add the count each time (x pairs with every equal value still visible, itself included).',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'tags' => ['mono-stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-number-of-subarrays-where-boundary-elements-are-maximum',
    'related_session' => 'find-the-number-of-subarrays-where-boundary-elements-are-maximum',
];

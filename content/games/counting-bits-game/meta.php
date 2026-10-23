<?php
declare(strict_types=1);

return [
    'title' => 'Counting Bits: drop the last bit',
    'leetcode' => 338,
    'difficulty' => 'Easy',
    'summary' => 'ans[i] = ans[i >> 1] + (i & 1). Shifting right removes the last bit, whose count you already know.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'counting-bits',
    'related_session' => 'counting-bits',
];

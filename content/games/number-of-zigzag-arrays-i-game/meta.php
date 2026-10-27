<?php
declare(strict_types=1);

return [
    'title' => 'Number of ZigZag Arrays I',
    'leetcode' => 3699,
    'difficulty' => 'Hard',
    'summary' => 'up[v] = arrays ending at v whose last step went up; down[v] = last step went down. Next up[v] = the sum of down[u] for u < v and next down[v] = the sum of up[u] for u > v (prefix sums make it O(m) per length).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-zigzag-arrays-i',
    'related_session' => 'number-of-zigzag-arrays-i',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Alternating Subsequence Sum: even and odd ends',
    'leetcode' => 1911,
    'difficulty' => 'Med',
    'summary' => 'even = best sum with the last pick added; odd = best with the last pick subtracted. even = max(even, odd + x); odd = max(odd, even − x).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-alternating-subsequence-sum',
    'related_session' => 'maximum-alternating-subsequence-sum',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Make All Characters Equal: fix each boundary',
    'leetcode' => 2712,
    'difficulty' => 'Med',
    'summary' => 'Every place where s[i] not equal to s[i−1] must be fixed once: flip the prefix (cost i) or the suffix (cost n − i). Sum min(i, n − i).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-to-make-all-characters-equal',
    'related_session' => 'minimum-cost-to-make-all-characters-equal',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Partition a Binary String',
    'leetcode' => 3864,
    'difficulty' => 'Hard',
    'summary' => 'Recurse on segments: a segment costs flatCost with no sensitive elements, else L times X times encCost. If its length is even, it may instead split into two halves, each solved the same way. Prefix counts give X in O(1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-to-partition-a-binary-string',
    'related_session' => 'minimum-cost-to-partition-a-binary-string',
];

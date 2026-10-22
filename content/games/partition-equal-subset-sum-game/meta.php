<?php
declare(strict_types=1);

return [
    'title' => 'Partition Equal Subset Sum: can we hit half?',
    'leetcode' => 416,
    'difficulty' => 'Med',
    'summary' => 'Target = sum / 2. can[s] says some subset sums to s. For each number, go DOWN from target to num: can[s] = can[s] or can[s − num]. Going down keeps each number used once.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'partition-equal-subset-sum',
    'related_session' => 'partition-equal-subset-sum',
];

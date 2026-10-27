<?php
declare(strict_types=1);

return [
    'title' => 'Maximum K to Sort a Permutation',
    'leetcode' => 3644,
    'difficulty' => 'Med',
    'summary' => 'Only misplaced elements (nums[i] not equal to i) need to move, and every swap partner pair must AND to k, so k must be a sub-mask of all of them. The AND of all misplaced values is the largest k that works (0 if already sorted).',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'tags' => ['bits', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-k-to-sort-a-permutation',
    'related_session' => 'maximum-k-to-sort-a-permutation',
];

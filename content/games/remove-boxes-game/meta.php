<?php
declare(strict_types=1);

return [
    'title' => 'Remove Boxes: carry the same-color boxes waiting on the left',
    'leetcode' => 546,
    'difficulty' => 'Hard',
    'summary' => 'f(l, r, k) = best for boxes[l..r] with k boxes equal to boxes[l] glued in front. Either remove boxes[l] with its k friends now ((k+1)² + f(l+1, r, 0)), or save it for a later equal box m: f(l+1, m−1, 0) + f(m, r, k+1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'remove-boxes',
    'related_session' => 'remove-boxes',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Remove Adjacent Almost-Equal Characters: change every other one',
    'leetcode' => 2957,
    'difficulty' => 'Med',
    'summary' => 'Scan left to right. When word[i] and word[i−1] are equal or adjacent letters, change word[i] (count 1) and skip to i + 2, since the change can avoid both neighbors.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'remove-adjacent-almost-equal-characters',
    'related_session' => 'remove-adjacent-almost-equal-characters',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Score After Binary Swaps',
    'leetcode' => 3781,
    'difficulty' => 'Med',
    'summary' => 'A "1" can only slide left over zeros, so the 1 at index i can claim any free spot at or before i. Sweep left to right with a max-heap of values seen so far; each time s[i] = "1", claim the largest value in the heap.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-score-after-binary-swaps',
    'related_session' => 'maximum-score-after-binary-swaps',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Swaps to Make Sequences Increasing: keep or swap each column',
    'leetcode' => 801,
    'difficulty' => 'Hard',
    'summary' => 'keep[i] / swap[i] = fewest swaps with column i unswapped / swapped. If both stay increasing in order, keep follows keep and swap follows swap. If they stay increasing crossed, keep follows swap and swap follows keep.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-swaps-to-make-sequences-increasing',
    'related_session' => 'minimum-swaps-to-make-sequences-increasing',
];

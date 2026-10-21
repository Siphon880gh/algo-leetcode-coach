<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Swaps To Make Sequences Increasing: keep or swap at each index',
    'leetcode' => 801,
    'difficulty' => 'Hard',
    'summary' => 'Track two costs at each index: the fewest swaps if index i is left alone, and if it is swapped. Each state comes from the previous keep or swap state, depending on which orderings stay strictly increasing.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'arrays', 'leetcode'],
    'related_session' => 'minimum-swaps-to-make-sequences-increasing',
];

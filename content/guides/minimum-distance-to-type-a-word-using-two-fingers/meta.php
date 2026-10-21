<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Distance to Type a Word Using Two Fingers: DP on the free finger',
    'leetcode' => 1320,
    'difficulty' => 'Hard',
    'summary' => 'One finger always rests on the previous letter, so the state is just the other finger\'s position (or unplaced). For each next letter, move either the finger on the previous letter or the free one, using Manhattan distance on the 6-column keyboard.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'strings', 'leetcode'],
    'related_session' => 'minimum-distance-to-type-a-word-using-two-fingers',
];

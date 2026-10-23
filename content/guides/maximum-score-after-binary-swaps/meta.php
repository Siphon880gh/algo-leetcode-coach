<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Score After Binary Swaps: each 1 moves left',
    'leetcode' => 3781,
    'difficulty' => 'Med',
    'summary' => 'A swap moves a 1 one step left. The j-th 1 can end anywhere at or left of its start without passing other 1s. Scan left to right with a max-heap; at each 1, take the best value seen so far.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'string', 'heap', 'leetcode'],
    'related_session' => 'maximum-score-after-binary-swaps',
];

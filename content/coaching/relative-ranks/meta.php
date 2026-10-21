<?php
declare(strict_types=1);

return [
    'title' => 'Relative Ranks: sort indices by score, assign medals then numbers',
    'leetcode' => 506,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: unique scores, top three get "Gold Medal", "Silver Medal", "Bronze Medal", the rest their place. Sort indexes by score descending and write each rank at the original index. [10,3,8,9,4] → [Gold, "5", Bronze, Silver, "4"]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'tags' => ['sorting', 'arrays', 'heap', 'step-by-step'],
    'related_guide' => 'relative-ranks',
];

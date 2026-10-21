<?php
declare(strict_types=1);

return [
    'title' => 'Relative Ranks: sort indices by score, assign medals then numbers',
    'leetcode' => 506,
    'difficulty' => 'Easy',
    'summary' => 'Scores are unique. Rank 1, 2, 3 get "Gold Medal", "Silver Medal", "Bronze Medal"; the rest get their place as a string. Sort indices by score descending and write each athlete’s rank at their original index. [5,4,3,2,1] → [Gold, Silver, Bronze, "4", "5"]. [10,3,8,9,4] → [Gold, "5", Bronze, Silver, "4"].',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'kind' => 'algo',
    'tags' => ['sorting', 'arrays', 'heap', 'leetcode'],
    'related_session' => 'relative-ranks',
];

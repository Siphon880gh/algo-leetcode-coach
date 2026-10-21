<?php
declare(strict_types=1);

return [
    'title' => 'Score After Flipping Matrix: lead with 1s, then fix each column',
    'leetcode' => 861,
    'difficulty' => 'Med',
    'summary' => 'The leading bit outweighs every bit after it, so flip rows until every row starts with 1. Then each other column is flipped if it has more 0s than 1s; add max(ones, m − ones) times its bit weight.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'bit-manipulation', 'matrix', 'leetcode'],
    'related_session' => 'score-after-flipping-matrix',
];

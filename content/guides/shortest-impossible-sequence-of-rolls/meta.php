<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Impossible Sequence of Rolls: count complete rounds',
    'leetcode' => 2350,
    'difficulty' => 'Hard',
    'summary' => 'Scan the rolls and close a round each time all k values have been seen since the last round ended. With r complete rounds every sequence of length r can be formed, and some sequence of length r + 1 cannot, so return r + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'greedy', 'leetcode'],
    'related_session' => 'shortest-impossible-sequence-of-rolls',
];

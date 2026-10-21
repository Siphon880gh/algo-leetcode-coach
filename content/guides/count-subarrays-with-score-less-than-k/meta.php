<?php
declare(strict_types=1);

return [
    'title' => 'Count Subarrays With Score Less Than K: shrinking window',
    'leetcode' => 2302,
    'difficulty' => 'Hard',
    'summary' => 'All values are positive, so the score only grows as a window widens. For each right end, move the left end until sum · length < k and add the window length to the count.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'prefix-sum', 'sliding-window', 'leetcode'],
    'related_session' => 'count-subarrays-with-score-less-than-k',
];

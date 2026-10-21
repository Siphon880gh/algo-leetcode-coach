<?php
declare(strict_types=1);

return [
    'title' => 'Campus Bikes: bucket pairs by distance',
    'leetcode' => 1057,
    'difficulty' => 'Med',
    'summary' => 'Distances are at most 1998, so put every pair into a bucket by distance, generated in worker-then-bike order so each bucket is already tie-broken. Read the buckets in order and assign each pair whose worker and bike are both free.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'kind' => 'algo',
    'tags' => ['sorting', 'greedy', 'bucket-sort', 'arrays', 'leetcode'],
    'related_session' => 'campus-bikes',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Campus Bikes: buckets by distance',
    'leetcode' => 1057,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: drop every (worker, bike) pair into a bucket for its distance in worker-then-bike order, then read buckets from 0 and assign pairs whose worker and bike are both free. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'related_guide' => 'campus-bikes',
    'tags' => ['sorting', 'greedy', 'bucket-sort', 'arrays', 'step-by-step'],
];

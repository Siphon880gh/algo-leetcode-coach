<?php
declare(strict_types=1);

return [
    'title' => 'Tweet Counts Per Frequency: buckets from the start time',
    'leetcode' => 1348,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep sorted times per tweet name, compute the bucket count from the chunk size, and place each time in [start, end] at (t − start) / size. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'tweet-counts-per-frequency',
    'tags' => ['design', 'binary-search', 'step-by-step'],
];

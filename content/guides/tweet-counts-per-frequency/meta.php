<?php
declare(strict_types=1);

return [
    'title' => 'Tweet Counts Per Frequency: sorted times, fixed buckets',
    'leetcode' => 1348,
    'difficulty' => 'Med',
    'summary' => 'Store each tweet name\'s timestamps. For a query, the chunk size is 60, 3600, or 86400 seconds; there are (end − start) / size + 1 buckets, and each time t in [start, end] goes to bucket (t − start) / size.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'binary-search', 'leetcode'],
    'related_session' => 'tweet-counts-per-frequency',
];

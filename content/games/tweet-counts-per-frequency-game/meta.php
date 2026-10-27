<?php
declare(strict_types=1);

return [
    'title' => 'Tweet Counts Per Frequency',
    'leetcode' => 1348,
    'difficulty' => 'Med',
    'summary' => 'Store each tweet\'s times. For a query, the chunk size is 60, 3600 or 86400; there are ((end − start) divided by size, rounded down) + 1 chunks, and each time t in [start, end] adds to chunk (t − start) divided by size, rounded down.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'tags' => ['design', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'tweet-counts-per-frequency',
    'related_session' => 'tweet-counts-per-frequency',
];

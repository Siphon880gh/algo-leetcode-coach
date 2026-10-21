<?php
declare(strict_types=1);

return [
    'title' => 'Time Needed to Rearrange a Binary String: each 1 waits or follows',
    'leetcode' => 2380,
    'difficulty' => 'Med',
    'summary' => 'Scan left to right counting zeros. A 1 with zeros before it finishes at max(previous finish + 1, zeros): it needs one second per zero to pass, and one more than the 1 ahead of it if they collide.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['string', 'dynamic-programming', 'simulation', 'leetcode'],
    'related_session' => 'time-needed-to-rearrange-a-binary-string',
];

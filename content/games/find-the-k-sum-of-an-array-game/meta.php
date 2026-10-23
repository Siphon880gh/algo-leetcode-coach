<?php
declare(strict_types=1);

return [
    'title' => 'Find the K-Sum of an Array',
    'leetcode' => 2386,
    'difficulty' => 'Hard',
    'summary' => 'The largest sum is the sum of positives. Every other sum subtracts a subset of |nums|. Sort |nums| and generate subtraction amounts in order with a min-heap: from (s, i) push (s + b[i+1], i+1) and (s − b[i] + b[i+1], i+1).',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'tags' => ['heap', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-k-sum-of-an-array',
    'related_session' => 'find-the-k-sum-of-an-array',
];

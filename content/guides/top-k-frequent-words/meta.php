<?php
declare(strict_types=1);

return [
    'title' => 'Top K Frequent Words: count, then order by frequency and word',
    'leetcode' => 692,
    'difficulty' => 'Med',
    'summary' => 'Count the words, then take the k best by (higher count, then alphabetical). Use a size-k heap whose root is the worst kept word, or sort the distinct words.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['heap', 'hash-map', 'sorting', 'leetcode'],
    'related_session' => 'top-k-frequent-words',
];

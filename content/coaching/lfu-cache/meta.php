<?php
declare(strict_types=1);

return [
    'title' => 'LFU Cache: frequency buckets of LRU lists, track min frequency',
    'leetcode' => 460,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: LFU cache with O(1) get and put; evict the lowest use count, ties by least recent. Map key → node, map count → recency list, and track minFreq. A touch moves the node to the count + 1 list; a new key sets minFreq = 1. Not 146. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'tags' => ['design', 'hash-table', 'linked-list', 'step-by-step'],
    'related_guide' => 'lfu-cache',
];

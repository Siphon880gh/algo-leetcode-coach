<?php
declare(strict_types=1);

return [
    'title' => 'LFU Cache: frequency buckets of LRU lists, track min frequency',
    'leetcode' => 460,
    'difficulty' => 'Hard',
    'summary' => 'get and put in O(1). Evict the least frequently used key; break ties by least recently used. Map key → node, and map freq → doubly linked list (most recent at the front). Touching a key moves it to the freq + 1 list. Keep minFreq; on a new insert it resets to 1. Evict from the back of the minFreq list. Not 146.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'hash-table', 'linked-list', 'leetcode'],
    'related_session' => 'lfu-cache',
];

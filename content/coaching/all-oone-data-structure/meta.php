<?php
declare(strict_types=1);

return [
    'title' => 'All O(1) Data Structure: count buckets in a doubly linked list',
    'leetcode' => 432,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: design inc, dec, getMaxKey, getMinKey in O(1). Keep a hash map key → count bucket, and a doubly linked list of buckets sorted by count, each with a set of keys. inc / dec moves a key to the neighbor bucket. Head and tail give min and max. Not 460 / 146. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'tags' => ['design', 'hash-table', 'linked-list', 'step-by-step'],
    'related_guide' => 'all-oone-data-structure',
];

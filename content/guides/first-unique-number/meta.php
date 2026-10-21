<?php
declare(strict_types=1);

return [
    'title' => 'First Unique Number: queue plus counts',
    'leetcode' => 1429,
    'difficulty' => 'Med',
    'summary' => 'Keep counts and a queue of candidates. On a query, pop from the front while the front\'s count exceeds 1; the front is then the answer, or −1 if the queue is empty.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'hash-map', 'queue', 'leetcode'],
    'related_session' => 'first-unique-number',
];

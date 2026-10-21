<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Fruits Harvested After at Most K Steps: window over positions',
    'leetcode' => 2106,
    'difficulty' => 'Hard',
    'summary' => 'The harvested positions form an interval [l, r] around startPos. Walking it costs (r − l) plus the shorter of the two distances from startPos to an end. Slide a window over the sorted fruit positions, shrinking from the left while that cost exceeds k, with prefix sums of amounts.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['sliding-window', 'prefix-sum', 'binary-search', 'leetcode'],
    'related_session' => 'maximum-fruits-harvested-after-at-most-k-steps',
];

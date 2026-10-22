<?php
declare(strict_types=1);

return [
    'title' => 'Custom Interval: chain timeouts and keep the current handle',
    'leetcode' => 2805,
    'difficulty' => 'Med',
    'summary' => 'Schedule each call with setTimeout, and from inside it schedule the next one with the next gap. Store the latest timeout handle under the id so clearing can cancel it.',
    'category' => 'LeetCode',
    'subcategory' => 'JavaScript',
    'topic' => 'LeetCode · JavaScript',
    'kind' => 'algo',
    'tags' => ['javascript', 'leetcode'],
    'related_session' => 'custom-interval',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Set Cooking Time: two ways to write it',
    'leetcode' => 2162,
    'difficulty' => 'Med',
    'summary' => 'Only two digit strings can work: minutes = t / 60 with seconds = t mod 60, or one minute less with 60 more seconds. Keep those with both parts in 0…99, drop leading zeros, and price the typing.',
    'category' => 'LeetCode',
    'subcategory' => 'Enumeration',
    'topic' => 'LeetCode · Enumeration',
    'kind' => 'algo',
    'tags' => ['math', 'enumeration', 'leetcode'],
    'related_session' => 'minimum-cost-to-set-cooking-time',
];

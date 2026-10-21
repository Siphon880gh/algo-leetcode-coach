<?php
declare(strict_types=1);

return [
    'title' => 'Design Authentication Manager: expiry map',
    'leetcode' => 1797,
    'difficulty' => 'Med',
    'summary' => 'Store each token\'s expiry time. renew only if the stored expiry is strictly greater than the current time. count returns how many expiries exceed the current time.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'hash-table', 'leetcode'],
    'related_session' => 'design-authentication-manager',
];

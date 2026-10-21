<?php
declare(strict_types=1);

return [
    'title' => 'Design Authentication Manager: expiry map',
    'leetcode' => 1797,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: store expiry = time + ttl; renew only if expiry > now; count expiries > now. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'design-authentication-manager',
    'tags' => ['design', 'hash-table', 'step-by-step'],
];

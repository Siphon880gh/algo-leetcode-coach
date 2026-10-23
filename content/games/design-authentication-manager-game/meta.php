<?php
declare(strict_types=1);

return [
    'title' => 'Design Authentication Manager',
    'leetcode' => 1797,
    'difficulty' => 'Med',
    'summary' => 'Map token → expiry (time + ttl). renew works only if the token exists and expiry > now. A token is unexpired at time t iff expiry > t.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'tags' => ['design', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'design-authentication-manager',
    'related_session' => 'design-authentication-manager',
];

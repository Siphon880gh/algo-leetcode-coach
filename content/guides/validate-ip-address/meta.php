<?php
declare(strict_types=1);

return [
    'title' => 'Validate IP Address: split and check each part by the exact rules',
    'leetcode' => 468,
    'difficulty' => 'Med',
    'summary' => 'Return "IPv4", "IPv6", or "Neither". IPv4: four dot-separated decimal parts, each 0..255, no leading zeros, digits only. IPv6: eight colon-separated parts, each 1 to 4 hex digits (either case), leading zeros fine. Split, check the count, then check every part. "172.16.254.1" → IPv4. "256.256.256.256" → Neither.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['strings', 'parsing', 'leetcode'],
    'related_session' => 'validate-ip-address',
];

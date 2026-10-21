<?php
declare(strict_types=1);

return [
    'title' => 'Validate IP Address: split and check each part by the exact rules',
    'leetcode' => 468,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: return "IPv4", "IPv6", or "Neither". IPv4: exactly 4 decimal parts, 0..255, no leading zeros. IPv6: exactly 8 parts of 1 to 4 hex digits, any case, leading zeros fine. Split, count, check every part. "172.16.254.1" → IPv4. "256.256.256.256" → Neither. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'tags' => ['strings', 'parsing', 'step-by-step'],
    'related_guide' => 'validate-ip-address',
];

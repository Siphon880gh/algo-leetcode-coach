<?php
declare(strict_types=1);

return [
    'title' => 'Encode and Decode TinyURL: map short keys to long URLs',
    'leetcode' => 535,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: encode a long URL to a short one and decode it back. Keep a map from a key to the long URL; the key is a counter or a random 6-character code (retry on collision). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'tags' => ['design', 'hash-table', 'strings', 'step-by-step'],
    'related_guide' => 'encode-and-decode-tinyurl',
];

<?php
declare(strict_types=1);

return [
    'title' => 'Encode and Decode TinyURL: map short keys to long URLs',
    'leetcode' => 535,
    'difficulty' => 'Med',
    'summary' => 'Design encode(longUrl) → short URL and decode(shortUrl) → the original. Keep a hash map from a key to the long URL; the key can be an increasing counter or a random 6-character string (retry on collision). Optionally keep a reverse map so the same URL gets the same code.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'hash-table', 'strings', 'leetcode'],
    'related_session' => 'encode-and-decode-tinyurl',
];

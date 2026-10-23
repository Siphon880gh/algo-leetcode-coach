<?php
declare(strict_types=1);

return [
    'title' => 'Russian Doll Envelopes: sort, then LIS on heights',
    'leetcode' => 354,
    'difficulty' => 'Hard',
    'summary' => 'Sort by width ascending and, for equal widths, height descending (so two of the same width never nest). Then run patience LIS on heights: replace the first tail ≥ h, or append.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'russian-doll-envelopes',
    'related_session' => 'russian-doll-envelopes',
];

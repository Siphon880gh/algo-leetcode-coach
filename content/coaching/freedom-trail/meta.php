<?php
declare(strict_types=1);

return [
    'title' => 'Freedom Trail: DP over key index and ring position, circular distance',
    'leetcode' => 514,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: spell key by rotating ring (1 step per position, either way) and pressing (1 per char). DP over (key index, ring position) with circular distance min(|j − k|, n − |j − k|). "godding", "gd" → 4. "godding", "godding" → 13. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dynamic-programming', 'strings', 'step-by-step'],
    'related_guide' => 'freedom-trail',
];

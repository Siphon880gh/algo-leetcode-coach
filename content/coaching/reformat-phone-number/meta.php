<?php
declare(strict_types=1);

return [
    'title' => 'Reformat Phone Number: blocks of three',
    'leetcode' => 1694,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: strip non-digits; peel blocks of 3 while more than 4 remain; end with 2-2 for four, or a single block of 2 or 3. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'String',
    'topic' => 'LeetCode · String',
    'related_guide' => 'reformat-phone-number',
    'tags' => ['string', 'simulation', 'step-by-step'],
];

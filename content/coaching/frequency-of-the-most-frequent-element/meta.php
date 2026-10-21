<?php
declare(strict_types=1);

return [
    'title' => 'Frequency of the Most Frequent Element: sliding window on sorted values',
    'leetcode' => 1838,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sort; for each right end, shrink from the left while nums[r] · len − sum exceeds k; track the longest window. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'frequency-of-the-most-frequent-element',
    'tags' => ['sliding-window', 'sorting', 'prefix-sum', 'step-by-step'],
];

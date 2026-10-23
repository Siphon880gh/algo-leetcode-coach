<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Frequency After Subarray Operation: Kadane per value',
    'leetcode' => 3434,
    'difficulty' => 'Med',
    'summary' => 'Base = count of k. Turning value v into k inside a subarray gains (#v − #k) there. For each v, Kadane on +1 for v, −1 for k. Answer = base + best gain.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-frequency-after-subarray-operation',
    'related_session' => 'maximum-frequency-after-subarray-operation',
];

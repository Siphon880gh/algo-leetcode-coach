<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Total Cost to Process All Elements: only the count matters',
    'leetcode' => 3987,
    'difficulty' => 'Med',
    'summary' => 'Every refill must happen anyway, and the i-th refill costs i whenever it happens. So the cost is T(T + 1) / 2 with T = ⌈sum / k⌉ − 1 refills (0 if the sum fits in k).',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'simulation', 'leetcode'],
    'related_session' => 'minimum-total-cost-to-process-all-elements',
];

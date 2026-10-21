<?php
declare(strict_types=1);

return [
    'title' => 'Online Stock Span: a monotonic stack of (price, span)',
    'leetcode' => 901,
    'difficulty' => 'Med',
    'summary' => 'Keep a stack of earlier prices with their spans, strictly decreasing in price. A new price absorbs every stacked price ≤ it, adding their spans to its own.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'kind' => 'algo',
    'tags' => ['monotonic-stack', 'design', 'stack', 'leetcode'],
    'related_session' => 'online-stock-span',
];

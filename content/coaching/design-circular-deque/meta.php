<?php
declare(strict_types=1);

return [
    'title' => 'Design Circular Deque: wrap both ends',
    'leetcode' => 641,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: move the head back with (head − 1 + k) % k on insertFront, count items to tell full from empty, and find the rear from head + size − 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'design-circular-deque',
    'tags' => ['design', 'queue', 'arrays', 'step-by-step'],
];

<?php
declare(strict_types=1);

return [
    'title' => 'Add Two Numbers II: stacks give you the digits from the right',
    'leetcode' => 445,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: add two numbers stored most significant digit first, without reversing the inputs. Push both lists onto stacks, pop and add with carry, prepend each new node. [7,2,4,3] + [5,6,4] → [7,8,0,7]. Not 2. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Linked List',
    'topic' => 'LeetCode · Linked List',
    'tags' => ['linked-list', 'stack', 'math', 'step-by-step'],
    'related_guide' => 'add-two-numbers-ii',
];

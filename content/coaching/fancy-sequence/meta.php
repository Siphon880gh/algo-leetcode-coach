<?php
declare(strict_types=1);

return [
    'title' => 'Fancy Sequence: lazy affine map',
    'leetcode' => 1622,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: keep a global x → m·x + a; append stores (val − a) · m⁻¹; getIndex returns stored · m + a, all mod 1e9+7. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'fancy-sequence',
    'tags' => ['design', 'math', 'modular-arithmetic', 'step-by-step'],
];

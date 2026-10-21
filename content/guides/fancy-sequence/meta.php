<?php
declare(strict_types=1);

return [
    'title' => 'Fancy Sequence: lazy affine transform with modular inverse',
    'leetcode' => 1622,
    'difficulty' => 'Hard',
    'summary' => 'Keep a global transform x → m·x + a. Store each appended value pre-inverted, (val − a) · m⁻¹ mod p, so getIndex is stored · m + a.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'math', 'modular-arithmetic', 'leetcode'],
    'related_session' => 'fancy-sequence',
];

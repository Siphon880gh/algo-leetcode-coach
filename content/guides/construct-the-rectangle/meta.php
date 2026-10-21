<?php
declare(strict_types=1);

return [
    'title' => 'Construct the Rectangle: largest width at most sqrt(area) that divides it',
    'leetcode' => 492,
    'difficulty' => 'Easy',
    'summary' => 'Return [L, W] with L × W = area, L ≥ W, and L − W as small as possible. Start W at floor(sqrt(area)) and step down until W divides area; then L = area / W. 4 → [2,2]. 37 → [37,1]. 122122 → [427,286].',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'leetcode'],
    'related_session' => 'construct-the-rectangle',
];

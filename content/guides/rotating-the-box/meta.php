<?php
declare(strict_types=1);

return [
    'title' => 'Rotating the Box: let stones slide right, then rotate',
    'leetcode' => 1861,
    'difficulty' => 'Med',
    'summary' => 'Before rotating, gravity points to the right of each row. Scan each row right to left, tracking the lowest empty slot; obstacles reset it. Then rotate clockwise: result[j][i] = box[m − 1 − i][j].',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'kind' => 'algo',
    'tags' => ['matrix', 'two-pointers', 'simulation', 'leetcode'],
    'related_session' => 'rotating-the-box',
];

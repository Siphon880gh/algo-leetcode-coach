<?php
declare(strict_types=1);

return [
    'title' => 'Exam Room: sorted seats, best gap',
    'leetcode' => 855,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: store only the occupied seats in sorted order; seat() compares the left wall, the middle of each gap, and the right wall, taking the lowest seat on ties. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'exam-room',
    'tags' => ['design', 'ordered-set', 'heap', 'step-by-step'],
];

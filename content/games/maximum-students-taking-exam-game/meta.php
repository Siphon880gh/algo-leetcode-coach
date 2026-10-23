<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Students Taking Exam: row masks',
    'leetcode' => 1349,
    'difficulty' => 'Hard',
    'summary' => 'Each row picks a mask of good seats with no two adjacent. A row\'s mask must not have a student diagonally in front of one in the previous row (mask & (prev << 1) and mask & (prev >> 1) are 0). dp over rows.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-students-taking-exam',
    'related_session' => 'maximum-students-taking-exam',
];

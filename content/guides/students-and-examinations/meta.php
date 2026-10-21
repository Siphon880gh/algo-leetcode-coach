<?php
declare(strict_types=1);

return [
    'title' => 'Students and Examinations: cross join, then left join counts',
    'leetcode' => 1280,
    'difficulty' => 'Easy',
    'summary' => 'Every student must appear with every subject, so cross join Students and Subjects first. Then left join Examinations on both student_id and subject_name and count matching rows, which gives 0 for exams not attended.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'join', 'leetcode'],
    'related_session' => 'students-and-examinations',
];

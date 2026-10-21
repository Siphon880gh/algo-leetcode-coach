<?php
declare(strict_types=1);

return [
    'title' => 'Masking Personal Information: email or phone, then fixed masks',
    'leetcode' => 831,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: an "@" means email, so mask the name to first + five stars + last; otherwise keep the digits and build the phone mask from the country-code length. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'related_guide' => 'masking-personal-information',
    'tags' => ['strings', 'simulation', 'step-by-step'],
];

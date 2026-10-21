<?php
declare(strict_types=1);

return [
    'title' => 'Masking Personal Information: two formats, two rules',
    'leetcode' => 831,
    'difficulty' => 'Med',
    'summary' => 'An "@" means an email: lowercase it and keep the first and last letters of the name around five stars. Otherwise it is a phone number: keep the digits, show the last four as ***-***-XXXX, and prefix +, stars, and - for any country code.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['strings', 'simulation', 'leetcode'],
    'related_session' => 'masking-personal-information',
];

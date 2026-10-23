<?php
declare(strict_types=1);

return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "This session teaches: 实现strStr.\nWhat do you focus on first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The core idea and when to use it', 'next' => 's2'],
                ['label' => 'Memorize code without the invariant', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Without the idea, code will not transfer to new prompts.\nStep back to when you skipped the invariant.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Good. Next: which complexity story matches this topic?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Name the dominant time/space in terms of n (or V,E)', 'next' => 's3'],
                ['label' => 'Skip complexity; it never matters', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Interviewers and production both care how it scales.\nStep back to when you ignored Big-O.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Lock a common trap for this topic, then finish.",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'State one trap and the fix from the guide', 'next' => 'success'],
                ['label' => 'Assume the happy path only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Edge cases and traps are where solutions break.\nStep back to when you ignored failure modes.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. You can explain the idea, complexity, and a trap for this topic.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

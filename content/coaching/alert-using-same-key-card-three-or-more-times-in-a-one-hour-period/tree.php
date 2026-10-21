<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Read the problem statement above.\nTime format?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Minutes = HH · 60 + MM', 'next' => 's2'],
                ['label' => 'Compare strings', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Differences need numbers.\nStep back to when you compared strings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Input order sorted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Assume yes', 'next' => 'wrong_b'],
                ['label' => 'No: sort each list', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 lists 12:01 before 12:00.\nStep back to when you assumed order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Exactly 60 minutes apart?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counts (≤ 60)', 'next' => 'success'],
                ['label' => 'Does not count', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Within one hour includes the boundary.\nStep back to when you used < 60.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [\"daniel\"], [\"bob\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

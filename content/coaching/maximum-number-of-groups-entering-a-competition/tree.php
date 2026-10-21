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
            'message' => "Read the problem statement above.\nStudents needed for k groups?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At least 1 + 2 + … + k', 'next' => 's2'],
                ['label' => 'At least k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Sizes must strictly increase; Example 1 → 6 instead of 3.\nStep back to when you used k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Must k(k + 1) / 2 equal n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No, extras join the last group', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 has no exact k → 0 instead of 1.\nStep back to when you required equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Find k by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Grow k while (k + 1)(k + 2) / 2 ≤ n', 'next' => 'success'],
                ['label' => 'floor(√(2n))', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. n = 2 → 2 instead of 1.\nStep back to when you used the square root.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(√n). Examples → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

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
            'message' => "Read the problem statement above.\nSort key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(age, score)', 'next' => 's2'],
                ['label' => 'Score only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Conflicts are about age order.\nStep back to when you sorted by score.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Transition condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'score[j] < score[i]', 'next' => 'wrong_b'],
                ['label' => 'score[j] ≤ score[i]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal scores never conflict.\nStep back to when you used <.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal ages?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ties sorted by score, so they chain', 'next' => 'success'],
                ['label' => 'Must be excluded', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Same-age players never conflict.\nStep back to when you excluded them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 34, 16, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

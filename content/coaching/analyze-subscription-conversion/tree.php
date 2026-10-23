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
            'message' => "Read the problem statement above.\nPaid average over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'paid rows only', 'next' => 's2'],
                ['label' => 'Every non-trial row', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. User 4 → 22.5 instead of 45.\nStep back to when you included cancelled rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which users?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any user with a free_trial row', 'next' => 'wrong_b'],
                ['label' => 'Both free_trial and paid rows', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. User 2 shows up with no paid average.\nStep back to when you skipped the paid check.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Example → users 1, 3, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

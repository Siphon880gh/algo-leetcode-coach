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
            'message' => "Read the problem statement above.\nBefore counting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check all values share a remainder mod k', 'next' => 's2'],
                ['label' => 'Skip the check', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2, query [0, 2] → 2 instead of −1.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Meeting value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The rounded mean', 'next' => 'wrong_b'],
                ['label' => 'A median of the quotients', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): [9, 5, 5], k = 1 → 5 instead of 4.\nStep back to when you used the mean.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [1, 2], [−1, 0, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

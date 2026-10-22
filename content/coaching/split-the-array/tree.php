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
            'message' => "Read the problem statement above.\nPossible when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every count ≤ 2', 'next' => 's2'],
                ['label' => 'At least n / 2 distinct values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 1, 1, 2, 3, 4] → true instead of false.\nStep back to when you counted distinct values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Build the halves to be sure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, try every split', 'next' => 'wrong_b'],
                ['label' => 'No, the count test suffices', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n = 100 has about 10^29 ways to pick a half.\nStep back to when you tried splits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

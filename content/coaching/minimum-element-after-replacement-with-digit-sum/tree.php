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
            'message' => "Read the problem statement above.\nOrder?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Digit sums, then minimum', 'next' => 's2'],
                ['label' => 'Minimum, then its digit sum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [10, 9] → 9 instead of 1.\nStep back to when you took the minimum first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Digit sum via?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x mod 9', 'next' => 'wrong_b'],
                ['label' => 'Adding digits', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 999 → 0 instead of 27: example 3 → 0 instead of 10.\nStep back to when you used mod 9.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log max). Examples → 1, 1, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

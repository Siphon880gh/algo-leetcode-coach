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
            'message' => "Read the problem statement above.\nUpdate the best when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p < best', 'next' => 's2'],
                ['label' => 'p ≤ best', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Ties must keep the earliest hour; Example 1 → 4 instead of 2.\nStep back to when you used ≤.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Last closing hour tried?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − 1', 'next' => 'wrong_b'],
                ['label' => 'n', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Staying open all day is allowed; Example 3 → 3 instead of 4.\nStep back to when you stopped at n − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 0, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

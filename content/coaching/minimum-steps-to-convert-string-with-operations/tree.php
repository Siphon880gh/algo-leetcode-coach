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
            'message' => "Read the problem statement above.\nTwo mismatches share one swap when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One is (x, y) and the other (y, x)', 'next' => 's2'],
                ['label' => 'Always, pairing any two', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 2 instead of 4.\nStep back to when you paired any two.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Reverse a piece?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never', 'next' => 'wrong_b'],
                ['label' => 'Try it, at one extra step', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 5 instead of 2.\nStep back to when you skipped reversing.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³). Examples → 4, 4, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

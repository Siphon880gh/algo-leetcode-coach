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
            'message' => "Read the problem statement above.\nLength 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare with 0101… and 1010…', 'next' => 's2'],
                ['label' => 'Same run formula', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 0110, numOps = 1 → 1 instead of 2.\nStep back to when you used the run formula.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Run of m, length L ≥ 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '⌈m / (L + 1)⌉ flips', 'next' => 'wrong_b'],
                ['label' => '⌊m / (L + 1)⌋ flips', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 0000, numOps = 1 → 3 instead of 2.\nStep back to when you rounded up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 2, 1, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

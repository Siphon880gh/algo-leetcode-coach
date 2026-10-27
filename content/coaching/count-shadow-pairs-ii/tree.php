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
            'message' => "Read the problem statement above.\nExample 1, pair (0, 2) = (3, 4). The 1 between them: does it block?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, 1 is not strictly between 3 and 4', 'next' => 's2'],
                ['label' => 'Yes, 1 is smaller than 3', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is part I's rule. Using it gives 4 instead of 5.\nStep back to when you used the part I rule.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "n = 5 × 10^4. How do you count the pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check every pair (i, j)', 'next' => 'wrong_b'],
                ['label' => 'Split in half: one bound from each side, then a Fenwick tree', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every pair is about 1.25 × 10^9 checks for n = 5 × 10^4.\nStep back to when you checked every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Divide and conquer with U[i], D[j] and a Fenwick tree. O(n log² n). Examples give 5 and 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

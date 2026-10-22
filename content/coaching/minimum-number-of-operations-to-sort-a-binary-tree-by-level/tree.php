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
            'message' => "Read the problem statement above.\nSwaps for one level come from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Cycles of the permutation to sorted order', 'next' => 's2'],
                ['label' => 'The number of inversions', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Inversions count adjacent swaps, but any two values may swap; Example 2 → 7 instead of 3.\nStep back to when you counted inversions.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A cycle of length L ≥ 2 needs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'L swaps', 'next' => 'wrong_b'],
                ['label' => 'L − 1 swaps', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last swap fixes two values at once; Example 2 → 6 instead of 3.\nStep back to when you charged L.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 3, 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

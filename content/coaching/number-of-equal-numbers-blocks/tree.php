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
            'message' => "Problem: An array is hidden behind an interface that reports its length and the value at an index. Equal values form blocks of adjacent positions. Return the number of blocks. The exact interface, limits and any query budget are in the official statement. For instance, [1, 1, 1, 3, 9, 9, 9, 2, 10, 10] → 5. (Restated from memory; limits and examples may differ slightly.)\nWhy does binary search work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Equal values are adjacent, so equal to a[i] is true, then false', 'next' => 's2'],
                ['label' => 'The array is sorted', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. It need not be sorted: the example [1, 1, 1, 3, 9, 9, 9, 2, 10, 10] is not, yet each block is contiguous.\nStep back to when you assumed sorted order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After the block ends at j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Continue at j', 'next' => 'wrong_b'],
                ['label' => 'Continue at j + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The search from j finds j again, so you never leave the block.\nStep back to when you continued at j.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k log n) reads for k blocks. The example → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

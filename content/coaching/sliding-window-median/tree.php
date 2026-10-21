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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two heaps: max-heap for the lower half, min-heap for the upper half', 'next' => 's2'],
                ['label' => 'Sort each window and read the middle', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorting each window costs O(k log k), so O(n k log k) total — too slow when k is large.\nStep back to when you sorted every window.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A value leaves the window.\nHow do you remove it from a heap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Search the heap for it and delete it directly', 'next' => 'wrong_b'],
                ['label' => 'Record it in a delayed map, fix the size count, and pop it when it reaches a top', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A heap cannot find a value quickly; searching it is O(k).\nStep back to when you searched the heap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Keep the lower heap at ceil(k/2) valid values. Clean delayed tops after every add, removal, and rebalance. Median = lower top, or the mean of both tops. A sorted container also works. O(n log k).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two heaps, lazy deletes, balanced sizes, average in 64 bits', 'next' => 'success'],
                ['label' => 'Compute (a + b) / 2 in 32-bit ints', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. a + b with values near 2^31 overflows a 32-bit int before you divide.\nStep back to when you averaged in 32 bits.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two balanced heaps with lazy deletion, averaging safely. Example → [1,−1,−1,3,5,6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

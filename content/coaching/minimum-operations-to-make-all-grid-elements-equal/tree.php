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
            'message' => "Problem: You get an m × n integer grid and an integer k. In one operation you pick a k × k subgrid and increase every cell in it by 1. Return the minimum number of operations that make all cells equal, or −1 if that cannot happen. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nFinal value T?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Solve for it from the forced counts', 'next' => 's2'],
                ['label' => 'max(grid)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [[5, 0, 5], [5, 0, 5]], k = 2 → −1 instead of 10.\nStep back to when you fixed T at the maximum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count at a window start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'T − original value', 'next' => 'wrong_b'],
                ['label' => 'T − current value, after earlier windows', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Same grid → 15 instead of 10.\nStep back to when you ignored earlier windows.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Constructed checks → 10, 6, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

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
            'message' => "Problem: Given s, consider an n × n × n array whose entries are built from an index and the bitwise OR of the other two. Return the largest n whose total stays at most s. The exact formula and limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nTotal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(Σ i) · (Σ j OR k)', 'next' => 's2'],
                ['label' => 'Sum all n³ entries', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. About 5 · 10^11 steps by n = 1196.\nStep back to when you summed entries.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Indices (as assumed)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 … n', 'next' => 'wrong_b'],
                ['label' => '0 … n − 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. s = 100 → 2 instead of 3.\nStep back to when you started at 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(N²). The guide’s checks → 2, 3, 5, 1196.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

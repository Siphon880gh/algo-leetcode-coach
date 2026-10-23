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
            'message' => "Problem: You get an integer array nums. For each index, count the elements after it that are smaller and have the opposite parity, and return the counts. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWhich tree to query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The opposite parity', 'next' => 's2'],
                ['label' => 'The same parity', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (made-up values, run in code): [5, 2, 4, 1, 3] → [2, 0, 0, 0, 0] instead of [2, 1, 2, 0, 0].\nStep back to when you queried the same parity.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Scan direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Left to right', 'next' => 'wrong_b'],
                ['label' => 'Right to left', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Same check → [0, 0, 0, 0, 1] instead of [2, 1, 2, 0, 0].\nStep back to when you counted earlier elements.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Constructed checks → [2, 1, 2, 0, 0], [0, 2, 0, 1, 0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

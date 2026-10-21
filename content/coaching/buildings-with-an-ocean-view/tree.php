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
            'message' => "Problem: Given building heights in a line with the ocean to the right, a building has an ocean view if every building to its right is strictly shorter. Return the indices with a view in increasing order. For instance, [4,2,3,1] → [0,2,3], [1,3,2,4] → [3], and [2,2,2] → [2]. (Restated from memory; limits and examples may differ slightly.)\nScan direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right to left', 'next' => 's2'],
                ['label' => 'Left to right, checking all to the right', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you scanned from the left.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal height to the right?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allows it, so use ≥', 'next' => 'wrong_b'],
                ['label' => 'Blocks the view, so use >', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every building to the right must be strictly shorter.\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reverse to increasing', 'next' => 'success'],
                ['label' => 'As collected', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Collection runs right to left.\nStep back to when you returned it unreversed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check → [0,2,3], [3], [2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

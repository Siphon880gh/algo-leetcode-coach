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
            'message' => "Problem: Break n locks in any order with a sword whose energy starts at 0 and grows by a factor X every minute, with X starting at 1. A lock breaks once the energy reaches its strength; then the energy resets to 0 and X goes up by 1. Return the least total time. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nOrder?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Minimum-cost assignment', 'next' => 's2'],
                ['label' => 'Weakest first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [2, 4, 3] → 6 instead of 5.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Solver?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Bitmask DP from part I', 'next' => 'wrong_b'],
                ['label' => 'Hungarian method, O(n³)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That needs 2^n states, far too many at the limits the guide assumes.\nStep back to when you reused the bitmask.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³). The guide’s check → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

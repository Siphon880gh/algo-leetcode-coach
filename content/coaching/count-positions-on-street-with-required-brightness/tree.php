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
            'message' => "Problem: A street has positions 0 … n − 1. Each light [position, range] lights every position from position − range to position + range, clipped to the street, adding 1 brightness there. Given requirement[i] for each position, return how many positions have brightness at least their requirement. For instance, n = 5, lights [[0,1],[2,1],[3,2]], requirement [0,2,1,4,1] → 4; n = 1, lights [[0,1]], requirement [2] → 0. (Restated from memory; limits and examples may differ slightly.)\nAdd each light?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Difference array: +1 at start, −1 after end', 'next' => 's2'],
                ['label' => 'Increment every lit position', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Many long lights make that quadratic.\nStep back to when you incremented each position.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Range past the street?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Write at position − range directly', 'next' => 'wrong_b'],
                ['label' => 'Clip to 0 … n − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A light at 0 with range 1 would write at index −1.\nStep back to when you skipped clipping.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'brightness ≥ requirement', 'next' => 'success'],
                ['label' => 'brightness > requirement', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The constructed example → 3 instead of 4.\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + lights). Constructed cases → 4, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

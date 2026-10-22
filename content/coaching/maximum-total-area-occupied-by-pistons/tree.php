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
            'message' => "Problem: Pistons sit between 0 and a maximum height. Each second every piston moves one unit in its direction and reverses when it reaches an end. The area is the sum of their positions. Return the largest area reached at any time. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nAnswer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Max area over the sweep', 'next' => 's2'],
                ['label' => 'The starting area', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The guide’s second check → 9 instead of 15.\nStep back to when you returned the start.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sweep up to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'height', 'next' => 'wrong_b'],
                ['label' => '2 · height', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Height 2, one piston at 1 moving down → 1 instead of 2 (it reaches the top at second 3).\nStep back to when you stopped at height.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). The guide’s checks → 7, 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

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
            'message' => "Problem: You get an integer k. Build any grid of '.' (free) and '#' (blocked) cells, within the size limit in the official statement, that has exactly k paths from the top-left cell to the bottom-right cell moving only right or down through free cells. Return an empty list if no such grid exists. It extends Create Grid With Exactly K Paths I, where the grid size was fixed and k was tiny. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nShape?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Doubling blocks plus corridors', 'next' => 's2'],
                ['label' => 'One free rectangle with C(a + b − 2, a − 1) = k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): k = 1000 → no rectangle up to 25 × 25 fits.\nStep back to when you looked for one rectangle.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Corridor for bit i leaves from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The bottom row of stage i', 'next' => 'wrong_b'],
                ['label' => 'The top row of stage i (2^i paths)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (made-up value, run in code): k = 5 → 8 paths instead of 5.\nStep back to when you tapped the bottom row.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log² k). Constructed check (made-up value): k = 5 → 5 paths; every k from 1 to 2047 checked.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

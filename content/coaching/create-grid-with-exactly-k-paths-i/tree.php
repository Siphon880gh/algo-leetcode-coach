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
            'message' => "Read the problem statement above.\nShape of the free cells?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Chained blocks plus a corridor', 'next' => 's2'],
                ['label' => 'One free rectangle', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [] instead of a 4-path grid.\nStep back to when you used one rectangle.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k = 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave every cell free', 'next' => 'wrong_b'],
                ['label' => 'A corridor: first row, then last column', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): m = 2, n = 3, k = 1 → 3 paths instead of 1.\nStep back to when you freed everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → 2 paths, 4 paths, [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

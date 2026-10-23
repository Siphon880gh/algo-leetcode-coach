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
            'message' => "Read the problem statement above.\nReturn route?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any route, taxed', 'next' => 's2'],
                ['label' => 'The forward route', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): n = 4, prices = [27, 30, 1, 16], roads = [[0, 1, 5, 1], [0, 2, 3, 4], [1, 2, 2, 2], [1, 3, 1, 2], [2, 3, 3, 2]] → [16, 7, 1, 10] instead of [13, 7, 1, 10].\nStep back to when you reused the route.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Buy locally?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only other shops', 'next' => 'wrong_b'],
                ['label' => 'Allowed, cost prices[i]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → [5, 16, 14] instead of [5, 11, 1].\nStep back to when you skipped the local shop.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · (n + m) log n). Examples → [6, 3], [8, 4, 6], [5, 11, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

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
            'message' => "Read the problem statement above.\nMedian node is the first where the walked weight?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reaches at least half (2 · walked ≥ total)', 'next' => 's2'],
                ['label' => 'Goes past half (2 · walked > total)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Edges [[0, 1, 2], [1, 2, 2]], query [0, 2] → [2] instead of [1].\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare with half how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'walked ≥ total // 2', 'next' => 'wrong_b'],
                ['label' => '2 · walked ≥ total', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Edges [[0, 1, 8], [1, 2, 9]], query [0, 2] → [1] instead of [2].\nStep back to when you rounded down.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [0, 1], [1, 0, 2], [2, 2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

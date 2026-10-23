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
            'message' => "Read the problem statement above.\nWeight of the joining subtree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(d(a, b) + d(b, c) + d(a, c)) / 2', 'next' => 's2'],
                ['label' => 'd(src1, dest) + d(src2, dest)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [16, 17] instead of [12, 11].\nStep back to when you counted shared edges twice.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Distances per query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A fresh BFS per query', 'next' => 'wrong_b'],
                ['label' => 'Depths plus LCA by binary lifting', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With n = q = 10^5 that is about 10^10 steps.\nStep back to when you searched per query.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [12, 11], [15].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

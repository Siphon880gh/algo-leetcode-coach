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
            'message' => "Read the problem statement above.\nCombine the two paths?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Meet at some node m and share m → dest', 'next' => 's2'],
                ['label' => 'Add the two shortest paths to dest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Shared edges are paid twice; Example 1 → 12 instead of 9.\nStep back to when you added the two paths.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Distances to dest?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Dijkstra from dest on the original edges', 'next' => 'wrong_b'],
                ['label' => 'Dijkstra from dest on reversed edges', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That measures dest → m, but the paths go m → dest.\nStep back to when you kept the edge directions.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Integer width?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Three path lengths of up to about 10^10 each overflow 32-bit.\nStep back to when you chose 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + E) log n). Examples → 9, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

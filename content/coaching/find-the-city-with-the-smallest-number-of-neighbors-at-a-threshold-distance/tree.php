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
            'message' => "Read the problem statement above.\nLoop order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k outermost', 'next' => 's2'],
                ['label' => 'k innermost', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Intermediate nodes must be outermost.\nStep back to when you nested k inside.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Edges are?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One way', 'next' => 'wrong_b'],
                ['label' => 'Bidirectional', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Set both d[u][v] and d[v][u].\nStep back to when you set one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Tie?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Larger index', 'next' => 'success'],
                ['label' => 'Smaller index', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement prefers the greatest number.\nStep back to when you picked the smaller.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³). First example → 3. Second → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

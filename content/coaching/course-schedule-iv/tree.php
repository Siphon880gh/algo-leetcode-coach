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
            'message' => "Read the problem statement above.\nBFS per query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: precompute', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Queries can number up to 10^4.\nStep back to when you searched per query.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Edge [a, b] means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'b before a', 'next' => 'wrong_b'],
                ['label' => 'a before b (a → b)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. a is the prerequisite.\nStep back to when you reversed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Closure loop order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k outermost', 'next' => 'success'],
                ['label' => 'k innermost', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Floyd–Warshall needs the intermediate node outermost.\nStep back to when you nested k inside.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³ + q). [[1,0]] → [false,true]. [[1,2],[1,0],[2,0]] → [true,true].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

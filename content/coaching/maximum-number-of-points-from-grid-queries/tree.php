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
            'message' => "Read the problem statement above.\nPop a cell when its value is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '< q', 'next' => 's2'],
                ['label' => '≤ q', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A cell equal to the query blocks; Example 1 → [8,8,3] instead of [5,8,1].\nStep back to when you used ≤.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer queries how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A fresh BFS per query', 'next' => 'wrong_b'],
                ['label' => 'Sorted, extending one region', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 10^4 queries on 10^5 cells is about 10^9 steps.\nStep back to when you restarted per query.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n log(m · n) + k log k). Examples → [5,8,1], [0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

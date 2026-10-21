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
            'message' => "Read the problem statement above.\nWhich group goes in the mask?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Group 2 (size ≤ 12)', 'next' => 's2'],
                ['label' => 'Group 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The smaller side keeps the mask small.\nStep back to when you masked group 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Edges per group-1 point in the DP?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any subset', 'next' => 'wrong_b'],
                ['label' => 'Exactly one', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Extra edges only cover group-2 points, which the final step does at least as cheaply.\nStep back to when you chose subsets.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Uncovered group-2 points at the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add their cheapest edge each', 'next' => 'success'],
                ['label' => 'Infeasible', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any group-1 point can link to them.\nStep back to when you rejected.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(size1 · size2 · 2^size2). Examples → 17, 4, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

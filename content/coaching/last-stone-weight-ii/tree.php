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
            'message' => "Read the problem statement above.\nSmash the two heaviest each time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: think of two signed groups', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Greedy smashing is not optimal here.\nStep back to when you used the heap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which target for the knapsack?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'total', 'next' => 'wrong_b'],
                ['label' => 'total // 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You want the two groups as equal as possible.\nStep back to when you targeted total.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Inner loop direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From half down to the stone', 'next' => 'success'],
                ['label' => 'From the stone up to half', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Going up reuses a stone.\nStep back to when you looped upward.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · total). [2,7,4,1,8,1] → 1. [31,26,33,21,40] → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

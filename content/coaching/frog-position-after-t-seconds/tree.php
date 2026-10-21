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
            'message' => "Read the problem statement above.\nAt the target with time left and children?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Probability 0: it jumps away', 'next' => 's2'],
                ['label' => 'Return the probability', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The frog must keep jumping while it can.\nStep back to when you returned early.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Choices at a vertex?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All neighbours', 'next' => 'wrong_b'],
                ['label' => 'Unvisited neighbours only', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The frog never goes back.\nStep back to when you counted the parent.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No choices left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stay there forever', 'next' => 'success'],
                ['label' => 'Probability 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A stuck frog stays on its vertex.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). t = 2, target 4 → 1/6. t = 1, target 7 → 1/3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

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
            'message' => "Read the problem statement above.\nHandle which columns first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Column sums of 2', 'next' => 's2'],
                ['label' => 'Column sums of 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You could use up capacity a 2-column needs.\nStep back to when you started with 1s.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "colsum = 1 and upper has room?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always the lower row', 'next' => 'wrong_b'],
                ['label' => 'Put it in the upper row', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That can overfill the lower row.\nStep back to when you always used lower.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "upper + lower ≠ sum(colsum)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return []', 'next' => 'success'],
                ['label' => 'Try anyway', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The counts cannot match.\nStep back to when you tried anyway.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). upper = 2, lower = 1, [1,1,1] → [[1,1,0],[0,0,1]]. upper = 2, lower = 3, [2,2,1,1] → [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

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
            'message' => "Read the problem statement above.\nPop when the top is faster or equal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, we never catch it', 'next' => 's2'],
                ['label' => 'No', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A car at least as fast stays ahead.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pop when we would reach it after its own collision?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, use that time anyway', 'next' => 'wrong_b'],
                ['label' => 'Yes, it has merged by then', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. After merging it moves at the slower fleet speed.\nStep back to when you used the stale time.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Process order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right to left', 'next' => 'success'],
                ['label' => 'Left to right', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each car only depends on the cars ahead.\nStep back to when you went left to right.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [1,-1,3,-1], [2,1,1.5,-1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

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
            'message' => "Read the problem statement above.\nSum every price increase, as in problem 122?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the fee makes small moves unprofitable', 'next' => 's2'],
                ['label' => 'Yes, minus a fee each time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Splitting one long rise into many trades pays the fee repeatedly.\nStep back to when you summed rises.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "cash for today?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(cash, hold + p)', 'next' => 'wrong_b'],
                ['label' => 'max(cash, hold + p − fee)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each sale pays the fee.\nStep back to when you dropped the fee.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cash', 'next' => 'success'],
                ['label' => 'max(cash, hold)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Holding a share at the end is never better than selling it or never buying it.\nStep back to when you considered hold.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) time, O(1) space. [1,3,2,8,4,9], fee = 2 → 8. [1,3,7,5,10,3], fee = 3 → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

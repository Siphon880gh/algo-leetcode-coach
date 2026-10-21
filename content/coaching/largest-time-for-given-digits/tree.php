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
            'message' => "Read the problem statement above.\nPick the largest valid digit for each position greedily?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: try all 24 orders', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. [2,0,6,6] greedily starts 20 and then cannot form valid minutes; the answer is 06:26.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare candidate times how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As strings without padding', 'next' => 'wrong_b'],
                ['label' => 'As minutes since midnight', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Unpadded strings compare wrongly, e.g. \"9:05\" > \"23:41\".\nStep back to when you compared strings.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No permutation is valid. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '""', 'next' => 'success'],
                ['label' => '"00:00"', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem asks for an empty string.\nStep back to when you returned 00:00.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(24). [1,2,3,4] → \"23:41\". [5,5,5,5] → \"\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

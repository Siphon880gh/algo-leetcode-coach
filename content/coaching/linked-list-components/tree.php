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
            'message' => "Read the problem statement above.\nWhat is a component?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A maximal run of consecutive list nodes whose values are in nums', 'next' => 's2'],
                ['label' => 'A group of equal values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Adjacency comes from the list order.\nStep back to when you grouped values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which nodes do you count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every node in the set', 'next' => 'wrong_b'],
                ['label' => 'Nodes in the set whose next is null or not in the set', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Adjacent members belong to one component.\nStep back to when you counted every member.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Do you need to sort nums?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: membership is all that matters', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The list order defines adjacency, not the values.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). head [0,1,2,3], nums [0,1,3] → 2. head [0,1,2,3,4], nums [0,3,1,4] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

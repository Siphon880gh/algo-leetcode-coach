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
            'message' => "Read the problem statement above.\nCompare slopes with division?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: use the cross product', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Vertical lines divide by zero.\nStep back to when you divided.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two of the points coincide. Need a separate check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: the cross product is 0 then too', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A zero vector makes the cross product 0.\nStep back to when you added a check.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cross product is 0. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'false', 'next' => 'success'],
                ['label' => 'true', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Zero area means a straight line.\nStep back to when you said true.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). [[1,1],[2,3],[3,2]] → true. [[1,1],[2,2],[3,3]] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

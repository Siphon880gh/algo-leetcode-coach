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
            'message' => "Read the problem statement above.\nSend each person to their cheaper city?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the cities need n each', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That can unbalance the groups.\nStep back to when you picked the cheaper city.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sort key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'aCost', 'next' => 'wrong_b'],
                ['label' => 'aCost − bCost', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. What matters is how much A saves over B.\nStep back to when you sorted by aCost.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After sorting, who goes to A?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first n', 'next' => 'success'],
                ['label' => 'The last n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The smallest a − b gain most from A.\nStep back to when you took the last n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [[10,20],[30,200],[400,50],[30,20]] → 110. [[259,770],[448,54],[926,667],[184,139],[840,118],[577,469]] → 1859.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

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
            'message' => "Read the problem statement above.\nBFS the whole million-by-million grid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: stop once the area exceeds the cap', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is 10¹² cells.\nStep back to when you searched everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which cap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'B cells', 'next' => 'wrong_b'],
                ['label' => 'B · (B − 1) / 2 cells', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A wall of B cells across a corner encloses far more than B.\nStep back to when you used B.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Source escapes. Done?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: also check the target from its side', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The target may be the one enclosed.\nStep back to when you stopped after one side.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(B²). blocked [[0,1],[1,0]], source [0,0], target [0,2] → false. blocked [], source [0,0], target [999999,999999] → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

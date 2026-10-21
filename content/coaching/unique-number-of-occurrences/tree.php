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
            'message' => "Read the problem statement above.\nWhat must be unique?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The counts', 'next' => 's2'],
                ['label' => 'The values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Values repeat by design.\nStep back to when you checked values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Check how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort the array', 'next' => 'wrong_b'],
                ['label' => 'len(set(counts)) == len(counts)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Count first, then compare counts.\nStep back to when you sorted the array.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "[1,2] → ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'false: both occur once', 'next' => 'success'],
                ['label' => 'true', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Two values share count 1.\nStep back to when you said true.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,2,1,1,3] → true. [−3,0,1,−3,1,1,1,−3,10,0] → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

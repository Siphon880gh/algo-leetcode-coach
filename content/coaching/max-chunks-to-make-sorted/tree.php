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
            'message' => "Read the problem statement above.\nWhen can you cut after index i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When max(arr[0..i]) == i', 'next' => 's2'],
                ['label' => 'When arr[i] == i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. [1,2,0,3] has arr[i] == i only at 3, but cuts after 2 and 3 work.\nStep back to when you compared one element.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why does max == i suffice?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Because the prefix is already sorted', 'next' => 'wrong_b'],
                ['label' => 'The prefix then holds exactly the values 0 … i', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The prefix need not be sorted, only contain the right values.\nStep back to when you required it sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of valid cuts', 'next' => 'success'],
                ['label' => 'The size of the largest chunk', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem asks for the number of chunks.\nStep back to when you returned a size.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [4,3,2,1,0] → 1. [1,0,2,3,4] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

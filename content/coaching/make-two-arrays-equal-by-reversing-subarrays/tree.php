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
            'message' => "Read the problem statement above.\nSimulate reversals?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: counts decide', 'next' => 's2'],
                ['label' => 'BFS over arrays', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The state space is factorial.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why is any order reachable?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only rotations', 'next' => 'wrong_b'],
                ['label' => 'Length-2 reversals are swaps', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Swaps generate every permutation.\nStep back to when you limited it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Compare how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counter or sorted copies', 'next' => 'success'],
                ['label' => 'Sets', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Sets lose multiplicities.\nStep back to when you used sets.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,4] vs [2,4,1,3] → true. [3,7,9] vs [3,7,11] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

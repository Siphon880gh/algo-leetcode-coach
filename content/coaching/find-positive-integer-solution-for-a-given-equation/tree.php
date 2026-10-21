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
            'message' => "Read the problem statement above.\nTry all x and y?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: f is increasing in both', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is 10⁶ calls.\nStep back to when you tried every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "f(x, y) < z. Move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'y −= 1', 'next' => 'wrong_b'],
                ['label' => 'x += 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Lowering y makes f smaller still.\nStep back to when you lowered y.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Match found. Move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both: x += 1 and y −= 1', 'next' => 'success'],
                ['label' => 'Stop', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. There can be more solutions.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2000) calls. function 1, z = 5 → [[1,4],[2,3],[3,2],[4,1]]. function 2, z = 5 → [[1,5],[5,1]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

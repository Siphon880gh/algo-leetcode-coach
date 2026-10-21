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
            'message' => "Read the problem statement above.\nTry flipping each set of k zeros?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: slide a window with at most k zeros', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is combinatorial.\nStep back to when you tried every set.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When do you shrink the window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'While it holds k zeros', 'next' => 'wrong_b'],
                ['label' => 'While it holds more than k zeros', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. k zeros are allowed.\nStep back to when you shrank at k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you record?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest window length', 'next' => 'success'],
                ['label' => 'The number of ones in the window', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The flipped zeros count too.\nStep back to when you counted only ones.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,1,1,0,0,0,1,1,1,1,0], k = 2 → 6. [0,0,1,1,0,0,1,1,1,0,1,1,0,0,0,1,1,1,1], k = 3 → 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

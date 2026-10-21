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
            'message' => "Read the problem statement above.\nTry every value 1 to 6?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only tops[0] and bottoms[0] can work', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The first domino must show the value too.\nStep back to when you tried all six.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A domino has the candidate on neither side. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rotate it', 'next' => 'wrong_b'],
                ['label' => 'That candidate fails', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Rotating cannot create the value.\nStep back to when you rotated.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Candidate x fits every domino. Rotations?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(n − tops count of x, n − bottoms count of x)', 'next' => 'success'],
                ['label' => 'n − tops count of x', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The bottom row might be cheaper.\nStep back to when you only counted tops.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). tops = [2,1,2,4,2,2], bottoms = [5,2,6,2,3,2] → 2. tops = [3,5,1,2,3], bottoms = [3,6,3,3,4] → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

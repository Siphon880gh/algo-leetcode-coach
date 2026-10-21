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
            'message' => "Read the problem statement above.\nConvert both to integers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: arrays can be 1000 digits long', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The values overflow ordinary integers.\nStep back to when you converted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Column sum s = 2. Digit and carry?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Digit 0, carry 1', 'next' => 'wrong_b'],
                ['label' => 'Digit 0, carry −1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 2 · (−2)^k equals −1 · (−2)^(k + 1).\nStep back to when you carried 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The result is [0,0,1]. Output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[1]', 'next' => 'success'],
                ['label' => '[0,0,1]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Leading zeros must be stripped.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m + n). [1,1,1,1,1] + [1,0,1] → [1,0,0,0,0]. [0] + [0] → [0]. [0] + [1] → [1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

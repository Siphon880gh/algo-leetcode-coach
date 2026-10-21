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
            'message' => "Read the problem statement above.\nReturn |count(\"(\") − count(\")\")|?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: order matters', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. \")(\" has equal counts but needs 2.\nStep back to when you compared counts.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A \")\" arrives with open == 0. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'open −= 1', 'next' => 'wrong_b'],
                ['label' => 'adds += 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A negative balance hides that this bracket needs a partner.\nStep back to when you went negative.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What is the answer at the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'adds + open', 'next' => 'success'],
                ['label' => 'adds', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The brackets still open each need a \")\".\nStep back to when you ignored them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) space. \"())\" → 1. \"(((\" → 3. \")(\" → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

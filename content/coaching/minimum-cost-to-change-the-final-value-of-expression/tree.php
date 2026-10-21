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
            'message' => "Read the problem statement above.\nPrecedence?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Equal; combine left to right', 'next' => 's2'],
                ['label' => '& before |', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The statement says & does not bind tighter.\nStep back to when you gave & precedence.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "1 & 1 flip cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c1 + c2', 'next' => 'wrong_b'],
                ['label' => 'min(c1, c2)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Making either side 0 is enough.\nStep back to when you flipped both.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "0 & 1 flip cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 (switch to |)', 'next' => 'success'],
                ['label' => 'Cost of flipping the 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Switching the operator always costs exactly 1.\nStep back to when you flipped an operand.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

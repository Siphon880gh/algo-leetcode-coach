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
            'message' => "Read the problem statement above.\nThe current width plus the next letter is exactly 100. New line?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a line may be exactly 100 wide', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The limit is 100 inclusive.\nStep back to when you wrapped at 100.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A letter does not fit. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Split the letter across lines', 'next' => 'wrong_b'],
                ['label' => 'Start a new line whose width is that letter\'s width', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Letters are never split.\nStep back to when you split it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Initial line count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The first letter is already on line 1.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). All widths 10, s = \"abcdefghijklmnopqrstuvwxyz\" → [3,60].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

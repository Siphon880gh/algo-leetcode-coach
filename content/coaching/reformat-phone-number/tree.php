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
            'message' => "Read the problem statement above.\nExactly 4 digits left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two blocks of 2', 'next' => 's2'],
                ['label' => 'One block of 3 and one of 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A single-digit block is not allowed.\nStep back to when you left one digit.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Separators in the input?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep them', 'next' => 'wrong_b'],
                ['label' => 'Remove spaces and dashes first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only digits form blocks.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Join with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Dashes', 'next' => 'success'],
                ['label' => 'Spaces', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Blocks are joined by dashes.\nStep back to when you used spaces.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"123-456\", \"123-45-67\", \"123-456-78\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

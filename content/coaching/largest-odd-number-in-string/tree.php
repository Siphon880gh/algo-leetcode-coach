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
            'message' => "Read the problem statement above.\nOdd test on?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last digit only', 'next' => 's2'],
                ['label' => 'The digit sum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Parity depends only on the last digit.\nStep back to when you summed digits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Convert to an integer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No, keep it as a string', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Up to 10^5 digits.\nStep back to when you converted.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which substring?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The prefix up to the rightmost odd digit', 'next' => 'success'],
                ['label' => 'The single largest odd digit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A longer prefix is larger.\nStep back to when you took one digit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"5\", \"\", \"35427\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

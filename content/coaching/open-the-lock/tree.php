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
            'message' => "Read the problem statement above.\n\"0000\" is a deadend. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return -1 immediately', 'next' => 's2'],
                ['label' => 'Start the BFS anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The lock is stuck from the start.\nStep back to when you started the BFS.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many neighbors does a state have?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4', 'next' => 'wrong_b'],
                ['label' => '8: each of 4 wheels turned up or down', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each wheel can turn either way.\nStep back to when you used 4.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Turning 0 down gives?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '9, by wrapping mod 10', 'next' => 'success'],
                ['label' => '-1, which is invalid', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The wheels are circular.\nStep back to when you dropped the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. BFS over 10⁴ states. deadends [\"0201\",\"0101\",\"0102\",\"1212\",\"2002\"], target \"0202\" → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

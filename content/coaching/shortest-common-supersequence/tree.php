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
            'message' => "Read the problem statement above.\nWhat is the shortest length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'm + n − LCS', 'next' => 's2'],
                ['label' => 'max(m, n)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Letters outside the LCS appear once each.\nStep back to when you took the maximum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Letters match during the walk-back. Emit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The letter twice', 'next' => 'wrong_b'],
                ['label' => 'The letter once, move both indices', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Shared letters are written once.\nStep back to when you emitted it twice.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "One string runs out. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Emit the rest of the other string', 'next' => 'success'],
                ['label' => 'Stop', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Those letters must appear too.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). \"abac\", \"cab\" → \"cabac\". \"aaaaaaaa\", \"aaaaaaaa\" → \"aaaaaaaa\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

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
            'message' => "Read the problem statement above.\nDecide the width how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check s[i + 2] == #', 'next' => 's2'],
                ['label' => 'Always read two digits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Single digits map to a–i.\nStep back to when you always read two.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Two-digit code 10?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a then 0', 'next' => 'wrong_b'],
                ['label' => 'j', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 10# is one letter.\nStep back to when you split it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Map a number k to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'chr(96 + k)', 'next' => 'success'],
                ['label' => 'chr(97 + k)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 1 must map to a.\nStep back to when you were off by one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"10#11#12\" → \"jkab\". \"1326#\" → \"acz\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

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
            'message' => "Read the problem statement above.\nMatch inside a word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not enough: must be a prefix', 'next' => 's2'],
                ['label' => 'Counts', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only word starts count.\nStep back to when you matched inside.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Several matches?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last', 'next' => 'wrong_b'],
                ['label' => 'The first (smallest index)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement asks for the minimum index.\nStep back to when you took the last.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Index base?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1-based', 'next' => 'success'],
                ['label' => '0-based', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 'burger' is word 4.\nStep back to when you returned 3.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"burg\" → 4. \"pro\" → 2. \"you\" → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

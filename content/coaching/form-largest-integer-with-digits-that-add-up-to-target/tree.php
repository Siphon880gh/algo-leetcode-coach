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
            'message' => "Read the problem statement above.\nCompare candidates how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'More digits wins first', 'next' => 's2'],
                ['label' => 'Lexicographic strings in DP', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Length dominates; string DP is slow.\nStep back to when you stored strings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Impossible target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return ""', 'next' => 'wrong_b'],
                ['label' => 'Return "0"', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement asks for the string 0.\nStep back to when you returned empty.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Building order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Digits 9 down to 1', 'next' => 'success'],
                ['label' => '1 up to 9', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Larger leading digits first.\nStep back to when you went upward.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(9 · target). Example 1 → \"7772\". Example 2 → \"85\". Example 3 → \"0\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

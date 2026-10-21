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
            'message' => "Read the problem statement above.\nCase sensitivity?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count both cases', 'next' => 's2'],
                ['label' => 'Lowercase only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Uppercase vowels count too.\nStep back to when you ignored them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The vowels themselves', 'next' => 'wrong_b'],
                ['label' => 'Vowel counts', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only how many matters.\nStep back to when you compared letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Half boundary?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n / 2 (n is even)', 'next' => 'success'],
                ['label' => 'Middle character excluded', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. There is no middle character.\nStep back to when you excluded one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"book\" → true. \"textbook\" → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

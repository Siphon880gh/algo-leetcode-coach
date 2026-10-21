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
            'message' => "Read the problem statement above.\nTotal happy strings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3 · 2^(n−1)', 'next' => 's2'],
                ['label' => '3^n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Adjacent characters must differ.\nStep back to when you counted 3^n.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k too large?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Wrap around', 'next' => 'wrong_b'],
                ['label' => 'Return ""', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement asks for an empty string.\nStep back to when you wrapped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Order of choices?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allowed letters in a, b, c order', 'next' => 'success'],
                ['label' => 'Any order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Lexicographic order needs sorted choices.\nStep back to when you chose freely.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 1, k = 3 → \"c\". n = 1, k = 4 → \"\". n = 3, k = 9 → \"cab\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

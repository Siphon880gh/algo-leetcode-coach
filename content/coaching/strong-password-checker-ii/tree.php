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
            'message' => "Read the problem statement above.\nSpecial characters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only !@#$%^&*()-+', 'next' => 's2'],
                ['label' => 'Anything not a letter or digit', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Abcdefg1_ → true instead of false.\nStep back to when you accepted any symbol.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Repeated characters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No character may repeat anywhere', 'next' => 'wrong_b'],
                ['label' => 'Only equal neighbours are forbidden', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 repeats e and o → false instead of true.\nStep back to when you banned all repeats.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Length rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At least 8', 'next' => 'success'],
                ['label' => 'More than 8', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Abcdef1! has exactly 8 → false instead of true.\nStep back to when you required more than 8.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

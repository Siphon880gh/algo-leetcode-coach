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
            'message' => "Read the problem statement above.\nValues like 4, 8, 9, 12?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip them: a prime appears twice', 'next' => 's2'],
                ['label' => 'Include them like any other value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Their product repeats a prime, so no subset containing them is good.\nStep back to when you included them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Several copies of the same value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use the value once and ignore copies', 'next' => 'wrong_b'],
                ['label' => 'Multiply the transition by its count', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Copies are different subsets; [2, 2] has two good subsets.\nStep back to when you ignored copies.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The 1s?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Multiply the total by 2^count(1)', 'next' => 'success'],
                ['label' => 'Count a subset of only 1s as good', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A product of 1 contains no prime; 1s only multiply the count of other good subsets.\nStep back to when you counted the 1s alone.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(30 · 2^10 + n). Examples → 6, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

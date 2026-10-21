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
            'message' => "Problem: Given a numeric string that is a palindrome, return the smallest palindrome strictly larger than it that uses exactly the same digits, or an empty string if none exists. For instance, \"1221\" → \"2112\", \"32123\" → \"\", and \"45544554\" → \"54455445\". (Restated from memory; limits and examples may differ slightly.)\nPermute what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first half only', 'next' => 's2'],
                ['label' => 'The whole string', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The result must stay a palindrome.\nStep back to when you permuted everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No next permutation?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the sorted half mirrored', 'next' => 'wrong_b'],
                ['label' => 'Return ""', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That would be smaller, not larger.\nStep back to when you wrapped around.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Middle digit of odd length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep it in place', 'next' => 'success'],
                ['label' => 'Include it in the half', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The middle must mirror onto itself.\nStep back to when you moved it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check → \"2112\", \"\", \"54455445\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

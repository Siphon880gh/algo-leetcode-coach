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
            'message' => "Read the problem statement above.\nScan numbers from L to R?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: enumerate the square roots instead', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. R can be 10¹⁸.\nStep back to when you scanned the range.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which roots p do you try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every p up to 10⁹', 'next' => 'wrong_b'],
                ['label' => 'Only palindromes, built from their first halves', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. p itself must be a palindrome, so build only those.\nStep back to when you scanned every p.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "From a half t, which palindromes do you build?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both odd length (t + reverse without the middle) and even length (t + reverse)', 'next' => 'success'],
                ['label' => 'Only odd lengths', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Roots like 11 or 22 have even length.\nStep back to when you skipped even lengths.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. About 2·10⁵ candidates. \"4\", \"1000\" → 4. \"1\", \"2\" → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

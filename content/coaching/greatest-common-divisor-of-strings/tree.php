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
            'message' => "Read the problem statement above.\nQuick test for whether any divisor exists?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'str1 + str2 == str2 + str1', 'next' => 's2'],
                ['label' => 'str2 is a prefix of str1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. \"ABAB\" is a prefix of \"ABABAB\" but does not divide it.\nStep back to when you used the prefix test.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which length is the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(len(str1), len(str2))', 'next' => 'wrong_b'],
                ['label' => 'gcd(len(str1), len(str2))', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The shorter string may not divide the longer one.\nStep back to when you took the minimum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The test fails. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '""', 'next' => 'success'],
                ['label' => 'The common prefix', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. No string divides both.\nStep back to when you returned the prefix.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m + n). \"ABCABC\", \"ABC\" → \"ABC\". \"ABABAB\", \"ABAB\" → \"AB\". \"LEET\", \"CODE\" → \"\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

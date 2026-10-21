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
            'message' => "Read the problem statement above.\nCompare halves by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rolling hash in O(1)', 'next' => 's2'],
                ['label' => 'Character by character', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That adds a factor of n.\nStep back to when you compared characters.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Same echo at two places?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count both', 'next' => 'wrong_b'],
                ['label' => 'Count once with a set', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The answer counts distinct substrings.\nStep back to when you counted both.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Half-length range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 to n / 2', 'next' => 'success'],
                ['label' => '1 to n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The whole echo has length 2L ≤ n.\nStep back to when you went to n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). \"abcabcabc\" → 3. \"leetcodeleetcode\" → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

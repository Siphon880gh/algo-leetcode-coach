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
            'message' => "Read the problem statement above.\nAnswer is which kind of substring?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A suffix', 'next' => 's2'],
                ['label' => 'Any substring', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Extending to the end only makes it larger.\nStep back to when you considered all substrings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "s[i + k] > s[j + k]. Next j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'j + 1', 'next' => 'wrong_b'],
                ['label' => 'j + k + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Starts inside the matched part lose too.\nStep back to when you moved j by 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "s[i + k] < s[j + k]. Next i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(i + k + 1, j), with j = i + 1', 'next' => 'success'],
                ['label' => 'j', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Starts up to i + k are beaten as well.\nStep back to when you set i to j.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"abab\" → \"bab\". \"leetcode\" → \"tcode\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

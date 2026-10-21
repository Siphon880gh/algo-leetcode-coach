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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Think about the whole strings first', 'next' => 's2'],
                ['label' => 'Enumerate subsequences of both and compare', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. No enumeration is needed. The whole strings already decide the answer.\nStep back to when you enumerated subsequences.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "a != b.\nWhat is the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'len(a) + len(b) − 2 × LCS', 'next' => 'wrong_b'],
                ['label' => 'max(len(a), len(b)): the longer string cannot be inside the other', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. LCS measures what is shared. The question is what is not shared.\nStep back to when you used LCS.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Same length but different: neither is a subsequence of the other, so the length works. O(n).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a == b → −1, else the longer length', 'next' => 'success'],
                ['label' => 'Return len(a) even when a == b', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. If a == b, every subsequence is shared.\nStep back to when you returned the length.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Equal → −1, otherwise the longer length. \"aba\", \"cdc\" → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

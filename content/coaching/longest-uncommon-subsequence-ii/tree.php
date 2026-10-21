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
                ['label' => 'Test only whole strings as candidates', 'next' => 's2'],
                ['label' => 'Enumerate all subsequences of all strings', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Up to 50 × 2^10 subsequences works but misses the key fact: if any subsequence of s is uncommon, s itself is.\nStep back to when you enumerated subsequences.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Candidate s = strs[i].\nAgainst which strings do you check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only strings longer than s', 'next' => 'wrong_b'],
                ['label' => 'Every j != i, including same-length strings', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal-length duplicates also contain s. [\"aaa\",\"aaa\"] must fail.\nStep back to when you checked longer strings only.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "isSub via two pointers. If no other string contains s, len(s) is a candidate. O(n² L).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Whole strings vs all others; max length or −1', 'next' => 'success'],
                ['label' => 'Return the length of the shortest unique string', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. \"aa\" is a subsequence of \"aaa\", so it is not uncommon either. Answer −1.\nStep back to when you returned the shortest.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Whole-string candidates checked against everyone else. → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

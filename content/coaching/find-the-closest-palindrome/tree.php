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
            'message' => "Read the problem statement above.\nCheck n − 1, n + 1, n − 2, … until one is a palindrome?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: build a few candidates from the left half', 'next' => 's2'],
                ['label' => 'Yes: search outward from n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n can have 18 digits, and the nearest palindrome can be around 10^9 away.\nStep back to when you searched outward.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which candidates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the mirror of the left half', 'next' => 'wrong_b'],
                ['label' => 'Mirror the left half as prefix − 1, prefix, prefix + 1, plus 10^(len − 1) − 1 and 10^len + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. For 99 the answer is 101 and for 100 it is 99; changes in length need 9…9 and 10…01, and prefix ± 1 can beat the plain mirror.\nStep back to when you used one candidate.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you choose among them?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop n itself, take the smallest distance, and the smaller value on a tie', 'next' => 'success'],
                ['label' => 'Return n if it is already a palindrome', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer must differ from n: \"1\" → \"0\" and \"121\" → \"111\".\nStep back to when you kept n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Five candidates, exclude n, closest then smaller: O(len) time. \"123\" → \"121\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

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
            'message' => "Read the problem statement above.\nreach[i] uses?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Longest prefix of any word', 'next' => 's2'],
                ['label' => 'Whole words only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → −1 instead of 3.\nStep back to when you used whole words.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Jump how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always to the end of the longest match', 'next' => 'wrong_b'],
                ['label' => 'Farthest reach within the frontier', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Words [ba, bb], target bba → −1 instead of 2.\nStep back to when you jumped to the longest match.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · longest word). Examples → 3, 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

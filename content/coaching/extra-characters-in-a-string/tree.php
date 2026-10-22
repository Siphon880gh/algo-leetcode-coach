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
            'message' => "Read the problem statement above.\nAt each position?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DP over every word ending there', 'next' => 's2'],
                ['label' => 'Take the longest word that starts here', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A long match can strand letters; abbbba with [b, bb, ba] → 2 instead of 1.\nStep back to when you matched greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "dp[i] before checking words?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Infinity unless a word ends at i', 'next' => 'wrong_b'],
                ['label' => 'dp[i − 1] + 1, letter i is extra', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Uncovered letters are allowed; example 1 → a huge value instead of 1, because the s is in no word.\nStep back to when you started from infinity.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · total word length). Examples → 1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

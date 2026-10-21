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
            'message' => "Read the problem statement above.\nMatch where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the start of the word', 'next' => 's2'],
                ['label' => 'Anywhere in the word', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 0; leetcode contains code only at the end.\nStep back to when you searched anywhere.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Word shorter than pref?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare only the first len(word) letters', 'next' => 'wrong_b'],
                ['label' => 'It cannot match', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. words = [a], pref = ab would count a.\nStep back to when you shortened the comparison.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Word equal to pref?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It counts', 'next' => 'success'],
                ['label' => 'It does not count', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A string is a prefix of itself; [at] with pref at → 1.\nStep back to when you excluded it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · |pref|). Examples → 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

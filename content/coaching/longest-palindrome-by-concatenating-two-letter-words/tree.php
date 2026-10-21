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
            'message' => "Read the problem statement above.\nlc and cl?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One pair: 4 letters, counted once', 'next' => 's2'],
                ['label' => 'Count lc with cl and again cl with lc', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Example 1 → 6, not 10.\nStep back to when you counted the pair twice.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A leftover word like gg?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Discard it', 'next' => 'wrong_b'],
                ['label' => 'It can be the single centre', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 puts gg in the middle for 6.\nStep back to when you discarded it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Leftovers gg and hh both?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only one can be the centre', 'next' => 'success'],
                ['label' => 'Both go in the middle', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. gghh is not a palindrome; [gg, hh] → 2.\nStep back to when you used two centres.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 6, 8, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

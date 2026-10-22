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
            'message' => "Read the problem statement above.\nCheck first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'len(s) = number of words', 'next' => 's2'],
                ['label' => 'Nothing, just zip', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. zip stops at the shorter one; example 2 → true instead of false.\nStep back to when you skipped the length check.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "s[i] must be?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any letter of words[i]', 'next' => 'wrong_b'],
                ['label' => 'words[i][0]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only the first letter counts; [ab, cd] with s = bd → true instead of false.\nStep back to when you allowed any letter.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

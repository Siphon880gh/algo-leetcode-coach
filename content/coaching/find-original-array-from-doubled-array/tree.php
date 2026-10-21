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
            'message' => "Read the problem statement above.\nOrder to match values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Increasing', 'next' => 's2'],
                ['label' => 'Any order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In [1,2,4,8], pairing 2 with 4 first leaves 1 without a 2, though [1,4] works.\nStep back to when you matched in any order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Zeros?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each zero is its own double', 'next' => 'wrong_b'],
                ['label' => 'Pair zeros with zeros; their count must be even', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A single 0 needs another 0 as its double; [0] is not doubled.\nStep back to when you let a 0 pair with itself.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "cnt[2x] < cnt[x]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not doubled: return []', 'next' => 'success'],
                ['label' => 'Pair what you can and continue', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The extra x cannot be anyone's double (smaller values are done), so it can never be matched.\nStep back to when you continued.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [1,3,4], [], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

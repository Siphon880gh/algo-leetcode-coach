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
            'message' => "Read the problem statement above.\nCan a letter move from an even index to an odd one?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: swaps stay within one parity', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each move swaps two even or two odd indices.\nStep back to when you mixed parities.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Group key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The whole word sorted', 'next' => 'wrong_b'],
                ['label' => '(sorted even-index letters, sorted odd-index letters)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That merges words whose letters sit at different parities.\nStep back to when you sorted the whole word.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of distinct keys', 'next' => 'success'],
                ['label' => 'The size of the largest group', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The question asks how many groups there are.\nStep back to when you measured a group.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · m log m). [\"abcd\",\"cdab\",\"cbad\",\"xyzz\",\"zzxy\",\"zzyx\"] → 3. [\"abc\",\"acb\",\"bac\",\"bca\",\"cab\",\"cba\"] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

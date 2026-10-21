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
            'message' => "Read the problem statement above.\nWhich letter is wanted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The one whose second occurrence comes first', 'next' => 's2'],
                ['label' => 'The repeated letter that first appears earliest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → a instead of c.\nStep back to when you used the first appearance.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Detect a repeat how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare with the previous letter', 'next' => 'wrong_b'],
                ['label' => 'A set of all letters seen', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Repeats need not be adjacent; abca → no answer instead of a.\nStep back to when you compared neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When to return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the first repeat', 'next' => 'success'],
                ['label' => 'After the scan, the last repeat found', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. abba → a instead of b.\nStep back to when you waited for the end.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → c, d.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

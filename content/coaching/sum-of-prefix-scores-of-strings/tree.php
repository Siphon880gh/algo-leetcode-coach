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
            'message' => "Read the problem statement above.\nCount at each node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Words passing through it', 'next' => 's2'],
                ['label' => 'Words ending at it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A prefix’s score counts every word starting with it; Example 1 → [2,1,2,1] instead of [5,4,3,2].\nStep back to when you counted endings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sum along the path?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every node but the last', 'next' => 'wrong_b'],
                ['label' => 'Every node, including the last', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The whole word is a prefix of itself; Example 2 → [3] instead of [4].\nStep back to when you skipped the last node.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Store prefixes how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A trie', 'next' => 'success'],
                ['label' => 'Every prefix as a string in a hash map', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That copies up to about 1000 · 1000² / 2 = 5 · 10^8 characters.\nStep back to when you hashed strings.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Examples → [5,4,3,2], [4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

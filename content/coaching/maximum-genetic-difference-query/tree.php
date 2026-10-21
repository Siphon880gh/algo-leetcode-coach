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
            'message' => "Read the problem statement above.\nPer query, walk the path to the root?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, answer offline during one DFS', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Deep trees make that O(n) per query.\nStep back to when you walked paths.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Leaving a node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave it in the trie', 'next' => 'wrong_b'],
                ['label' => 'Decrement its trie counts', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Off-path values would answer later queries.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Greedy bit choice?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Opposite bit if that child count > 0', 'next' => 'success'],
                ['label' => 'Same bit as the query', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Matching bits give 0 in XOR.\nStep back to when you matched the bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) · 18). Examples → [2,3,7], [6,14,7].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

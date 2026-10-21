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
            'message' => "Read the problem statement above.\nScan all words for each query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: precompute so a query is one trie walk', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Up to 10⁴ queries × 10⁴ words is too slow.\nStep back to when you scanned on each query.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What do you insert for each word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Just the word', 'next' => 'wrong_b'],
                ['label' => 'suffix + "#" + word, for every suffix', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A plain trie answers prefixes only; gluing the suffix in front handles both.\nStep back to when you inserted only the word.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Several words match. Which index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest, by overwriting as you insert in order', 'next' => 'success'],
                ['label' => 'The smallest', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem asks for the largest index.\nStep back to when you kept the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(N · L²) build, O(L) per query. [\"apple\"]: f(\"a\", \"e\") → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

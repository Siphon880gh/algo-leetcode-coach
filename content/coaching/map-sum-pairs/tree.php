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
            'message' => "Read the problem statement above.\nWhat does each trie node store?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The total value of all keys passing through it', 'next' => 's2'],
                ['label' => 'Only the value of a key ending there', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Then sum(prefix) would need to walk the whole subtree.\nStep back to when you stored only end values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A key is inserted again with a new value. What do you add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The full new value', 'next' => 'wrong_b'],
                ['label' => 'delta = new − old along its path', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The old value is already counted; adding the full value double-counts it.\nStep back to when you added the full value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "sum(prefix) and the path breaks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 'success'],
                ['label' => 'Return the score of the deepest node reached', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. No key starts with that prefix.\nStep back to when you returned a partial score.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(len) per operation. insert(\"apple\",3), sum(\"ap\") → 3; insert(\"app\",2), sum(\"ap\") → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

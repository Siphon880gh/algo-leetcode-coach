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
            'message' => "Problem: Given an N-ary tree with unique values and nodes p and q, make p's subtree the last child of q; if q lies inside p's subtree, reconnect as the statement specifies so the tree stays connected; if p is already q's child, change nothing. For instance, 1→{2,3}, 2→{4}, p = 2, q = 4: 4 takes 2's place under 1, and 2 becomes 4's child. (Restated from memory; limits and examples may differ slightly.)\np already a child of q?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return unchanged', 'next' => 's2'],
                ['label' => 'Move it to the end anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The statement leaves it in place.\nStep back to when you moved it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "q inside p's subtree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Append p to q directly', 'next' => 'wrong_b'],
                ['label' => 'Detach q and put it in p\'s place first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That forms a cycle.\nStep back to when you appended directly.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "p was the root in that case?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'q becomes the new root', 'next' => 'success'],
                ['label' => 'Keep the old root', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The old root is now under q.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The three cases cover every position of q relative to p.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

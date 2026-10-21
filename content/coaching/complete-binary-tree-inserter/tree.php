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
            'message' => "Read the problem statement above.\nSearch the tree for a free slot on each insert?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: keep a queue of nodes with a free slot', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n) per insert.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The front node already has a left child. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Attach it to the next node in the queue', 'next' => 'wrong_b'],
                ['label' => 'Attach the new node as its right child and pop the front', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The front node's right slot comes next in level order.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What happens to the new node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Enqueue it: it has two free slots', 'next' => 'success'],
                ['label' => 'Nothing', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Later inserts need it as a parent.\nStep back to when you dropped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per insert. Tree [1,2]: insert(3) → 1, insert(4) → 2, get_root() → [1,2,3,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

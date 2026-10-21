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
            'message' => "Problem: N-ary tree with 0 to 1e4 nodes, height up to 1000. Write serialize and deserialize so any tree round-trips. The codec must keep no state between calls. Empty tree ↔ empty string. (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS: write the root, then for each node its children values followed by #', 'next' => 's2'],
                ['label' => 'Reuse the binary 297 format with null for missing left and right', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 297 marks a missing left or right child with null because a binary node has exactly two slots. An N-ary node has any number of children, so two null slots cannot describe it.\nStep back to when you reused the binary format.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Decode: split tokens. First token is the root; queue it. For each dequeued node, read tokens as children until you hit #.\nWhat must a leaf write?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing, leaves have no children to write', 'next' => 'wrong_b'],
                ['label' => 'A # with no values before it, so its child list is empty', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Without # after a leaf, the decoder reads the next node's children as this leaf's children, and the tree shifts.\nStep back to when you skipped the terminator for leaves.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Each node writes its value once and one #, so serialize and deserialize are both O(n) time and space. Encode N-ary Tree to Binary Tree (431) is a pointer encoding, not a string.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS, children then # per node, stateless. Not 297 / 431', 'next' => 'success'],
                ['label' => 'Keep a shared index on the Codec instance between calls', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A cursor stored on the Codec object breaks when the judge calls serialize and deserialize in a different order or on different instances.\nStep back to when you kept state on the class.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. BFS with a # after each node's children, leaves write a bare #, and nothing lives on the Codec between calls.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Write preorder values only; use BST order to rebuild', 'next' => 's2'],
                ['label' => 'Use the general 297 format with a null marker for every missing child', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 297's format works for any binary tree, but the null markers waste space. A BST's ordering already tells you where values go.\nStep back to when you added null markers.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Values: 5 3 2 4 7. Read with an index i and bounds (low, high).\nWhat do you do when the next value is outside the bounds?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Consume it anyway and place it as a leaf here', 'next' => 'wrong_b'],
                ['label' => 'Return null without consuming it; a parent above will use it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Consuming a value that does not fit puts it in the wrong subtree.\nStep back to when you consumed an out-of-range value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "In range: make a node, advance i, build left with (low, value), then right with (value, high). Each value is read once: O(n). Construct BST from Preorder (1008) is this half alone.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Preorder only; rebuild with bounds in one pass. Not 297', 'next' => 'success'],
                ['label' => 'At each node, scan forward to find where the right subtree starts', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Scanning ahead for the first larger value at every node is O(n²) on a skewed tree.\nStep back to when you searched for the split point.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Preorder values, no nulls; rebuild by bounds, reading each value once. [2,1,3] → \"2 1 3\" → [2,1,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

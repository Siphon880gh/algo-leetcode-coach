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
            'message' => "Problem: In a binary tree, the leaves are also linked to each other in a cycle through their child pointers, so a plain traversal would loop forever. Return the height of the tree. How the leaf links are set, the height convention, and the limits are in the official statement. For instance, a root with children 2 and 3, where 2 has a left child 4, has height 2 counted in edges, whatever the leaf links are. (Restated from memory; limits and examples may differ slightly.)\nFollow a child pointer when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its target does not point straight back', 'next' => 's2'],
                ['label' => 'Always', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The leaf links form a cycle; in code the recursion never ends.\nStep back to when you followed every pointer.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine the two sides with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'sum', 'next' => 'wrong_b'],
                ['label' => 'max', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Height is one path; the example → 3 instead of 2.\nStep back to when you added the sides.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The example → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

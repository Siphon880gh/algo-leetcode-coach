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
            'message' => "Read the problem statement above.\nOn death?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add to the dead set', 'next' => 's2'],
                ['label' => 'Remove from the tree', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Their descendants still inherit through them.\nStep back to when you removed the node.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS by generation', 'next' => 'wrong_b'],
                ['label' => 'Preorder, children in birth order', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A child's whole line comes before the next sibling.\nStep back to when you used BFS.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cost of birth and death?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1) each', 'next' => 'success'],
                ['label' => 'O(n) each', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only getInheritanceOrder walks the tree.\nStep back to when you recomputed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. The example gives the king…catherine order, then the same without bob.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

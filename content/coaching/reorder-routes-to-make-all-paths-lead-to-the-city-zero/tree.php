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
            'message' => "Read the problem statement above.\nTraverse from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'City 0', 'next' => 's2'],
                ['label' => 'Every city', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. One traversal from 0 covers the tree.\nStep back to when you searched from each city.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Edge used in its original direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Cost 0', 'next' => 'wrong_b'],
                ['label' => 'Away from 0: cost 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It must be reversed.\nStep back to when you counted 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Graph type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Tree (n − 1 edges)', 'next' => 'success'],
                ['label' => 'General graph', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A tree gives a unique path.\nStep back to when you treated it generally.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Example 1 → 3. Example 2 → 2. Example 3 → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

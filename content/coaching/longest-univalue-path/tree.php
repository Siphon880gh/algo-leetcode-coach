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
            'message' => "Read the problem statement above.\nWhat does the DFS return to the parent?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The longest downward arm of the node\'s value, in edges', 'next' => 's2'],
                ['label' => 'The longest path anywhere in the subtree', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A parent can only extend a straight arm, not an arbitrary path.\nStep back to when you returned the best path.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A child has a different value. Its arm counts as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip the child\'s subtree entirely', 'next' => 'wrong_b'],
                ['label' => '0 for this node, but still recurse into it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That child's subtree may hold the longest path.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you record at each node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'left + right, the path bending here', 'next' => 'success'],
                ['label' => 'max(left, right)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A path can pass through the node, using both arms.\nStep back to when you used only one arm.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Postorder DFS: O(n). [5,4,5,1,1,null,5] → 2. [1,4,5,4,4,null,5] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

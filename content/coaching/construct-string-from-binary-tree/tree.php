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
            'message' => "Read the problem statement above.\nWhich traversal builds the string?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Preorder: value, then (left), then (right)', 'next' => 's2'],
                ['label' => 'Inorder', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The value must come first, as in 1(2(4))(3).\nStep back to when you used inorder.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When must an empty () stay?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never', 'next' => 'wrong_b'],
                ['label' => 'For a missing left child when there is a right child', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1,null,2] must be 1()(2); without the () it would read as a left child.\nStep back to when you dropped every ().",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The right child is missing. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop its () entirely', 'next' => 'success'],
                ['label' => 'Keep () for it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A missing right child is never ambiguous, so its parentheses are redundant.\nStep back to when you kept the right ().",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Preorder with the one left-child special case: O(n) time with a builder. [1,2,3,4] → \"1(2(4))(3)\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

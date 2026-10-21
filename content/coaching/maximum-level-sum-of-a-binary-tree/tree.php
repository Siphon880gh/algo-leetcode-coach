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
            'message' => "Read the problem statement above.\nTraversal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'BFS by levels', 'next' => 's2'],
                ['label' => 'Inorder', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Inorder mixes levels.\nStep back to when you chose inorder.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Initial best?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => '−∞', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. All level sums can be negative.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal sums at two levels?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the smaller level', 'next' => 'success'],
                ['label' => 'Take the later one', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Ties go to the smallest level.\nStep back to when you replaced on a tie.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,7,0,7,−8,null,null] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

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
            'message' => "Read the problem statement above.\nFind the kth from the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Run a pointer from head while the first-node pointer runs to the tail', 'next' => 's2'],
                ['label' => 'Reverse the list', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Reversing costs extra passes and pointer fixes.\nStep back to when you reversed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Swap nodes or values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Relink the nodes', 'next' => 'wrong_b'],
                ['label' => 'Values', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only values must change; relinking adds edge cases.\nStep back to when you relinked.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Same node from both ends?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Swapping with itself is fine', 'next' => 'success'],
                ['label' => 'Special-case and return early', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The swap is harmless when the two coincide.\nStep back to when you special-cased it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1). Examples → [1,4,3,2,5], [7,9,6,6,8,7,3,0,9,5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

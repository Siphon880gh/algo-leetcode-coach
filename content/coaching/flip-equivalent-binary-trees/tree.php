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
            'message' => "Read the problem statement above.\nOne subtree is null and the other is not. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'false', 'next' => 's2'],
                ['label' => 'true', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A missing node cannot match a real one.\nStep back to when you returned true.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The roots match. What must hold for the children?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They match straight', 'next' => 'wrong_b'],
                ['label' => 'They match straight or crossed', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A flip swaps the children.\nStep back to when you allowed only straight.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Can flips happen at several nodes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: at any number of nodes', 'next' => 'success'],
                ['label' => 'Only at the root', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each node may be flipped independently.\nStep back to when you flipped only the root.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,4,5,6,null,null,null,7,8], [1,3,2,null,6,4,5,null,null,null,null,8,7] → true. [], [] → true. [], [1] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

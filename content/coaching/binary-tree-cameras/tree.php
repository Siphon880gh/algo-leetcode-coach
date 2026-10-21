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
            'message' => "Read the problem statement above.\nPut cameras on the leaves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: their parents cover more', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A leaf camera covers only the leaf and its parent.\nStep back to when you used leaves.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What state does a null child report?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not covered', 'next' => 'wrong_b'],
                ['label' => 'Covered: it needs nothing', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That would force cameras above every leaf's missing children.\nStep back to when you called null uncovered.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The root ends up not covered. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add one camera', 'next' => 'success'],
                ['label' => 'Nothing', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. No parent is left to cover it.\nStep back to when you ignored the root.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [0,0,null,0,0] → 1. [0,0,null,0,null,0,null,null,0] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

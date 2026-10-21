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
            'message' => "Read the problem statement above.\nBuild path strings and parse them?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: carry one integer', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Strings add work at every leaf.\nStep back to when you built strings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Value at a child?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'parent value + child bit', 'next' => 'wrong_b'],
                ['label' => 'parent value · 2 + child bit', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each new bit shifts the earlier ones left.\nStep back to when you only added.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Where do you add to the total?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only at leaves', 'next' => 'success'],
                ['label' => 'At every node', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Numbers end only at leaves.\nStep back to when you added at every node.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,0,1,0,1,0,1] → 22. [0] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

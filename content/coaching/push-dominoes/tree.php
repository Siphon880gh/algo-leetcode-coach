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
            'message' => "Read the problem statement above.\nSimulate second by second?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: each dot depends only on the nearest pushes on either side', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That can take O(n²).\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Dots between an \"R\" and an \"L\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They all fall right', 'next' => 'wrong_b'],
                ['label' => 'Fill from both ends inward; an odd middle stays "."', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The two pushes meet in the middle.\nStep back to when you let R win.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Dots between an \"L\" and an \"R\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'They stay upright', 'next' => 'success'],
                ['label' => 'They fall left', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. L pushes left and R pushes right, both away from them.\nStep back to when you let them fall.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Treat the string as padded with \"L\" on the left and \"R\" on the right. \"RR.L\" → \"RR.L\". \".L.R...LR..L..\" → \"LL.RR.LLRRLL..\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

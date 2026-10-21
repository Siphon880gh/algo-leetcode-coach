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
            'message' => "Read the problem statement above.\nWhat do \"XL\" → \"LX\" and \"RX\" → \"XR\" allow?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'L moves left through X, R moves right through X', 'next' => 's2'],
                ['label' => 'Any piece moves anywhere', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each move has one direction, and L and R never pass each other.\nStep back to when you allowed any movement.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Matching an L at index i in start with index j in end. Requirement?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i ≤ j', 'next' => 'wrong_b'],
                ['label' => 'i ≥ j', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. L can only move left.\nStep back to when you reversed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Matching an R. Requirement?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i ≤ j', 'next' => 'success'],
                ['label' => 'i ≥ j', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. R can only move right.\nStep back to when you reversed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two pointers, O(n). \"RXXLRXRXL\" → \"XRLXXRRLX\" is true. \"X\" → \"L\" is false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

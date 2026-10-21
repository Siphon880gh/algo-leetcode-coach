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
            'message' => "Read the problem statement above.\nGenerate all strings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count paths per choice', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. C(30, 15) is about 155 million.\nStep back to when you generated them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Strings starting with H?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'C(h + v, v)', 'next' => 'wrong_b'],
                ['label' => 'C(h − 1 + v, v)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One H is already used.\nStep back to when you counted all.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "k > that count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Write V and subtract the count', 'next' => 'success'],
                ['label' => 'Write V and keep k', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You skipped that many H-first strings.\nStep back to when you kept k.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. [2,3]: k = 1, 2, 3 → \"HHHVV\", \"HHVHV\", \"HHVVH\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

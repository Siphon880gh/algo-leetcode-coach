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
            'message' => "Read the problem statement above.\nApply the operators left to right?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: * and / bind first', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Normal precedence applies.\nStep back to when you went left to right.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Operator is −. What do you push?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x, and subtract later', 'next' => 'wrong_b'],
                ['label' => '−x', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Pushing −x keeps the final step a plain sum.\nStep back to when you pushed x.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Operator is /. How do you divide?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Truncate toward zero', 'next' => 'success'],
                ['label' => 'Floor division', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A negative top would round the wrong way.\nStep back to when you used floor division.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 4 → 7. n = 10 → 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

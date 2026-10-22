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
            'message' => "Read the problem statement above.\nCompute?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'salary * 2', 'next' => 's2'],
                ['label' => 'salary ** 2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That squares it; Jack → 386751556 instead of 39332.\nStep back to when you squared.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Call employees[salary].mul(2) and return', 'next' => 'wrong_b'],
                ['label' => 'Assign it back to employees[salary]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. mul returns a new Series; the DataFrame is unchanged.\nStep back to when you did not assign.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The example → 39332, 149508, 125018, 109732.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

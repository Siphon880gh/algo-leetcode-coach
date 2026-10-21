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
            'message' => "Read the problem statement above.\nInitial dp?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[1, 0, 1]', 'next' => 's2'],
                ['label' => '[0, 0, 0]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only lane 2 is free of cost at the start.\nStep back to when you started all at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order at each point?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Side jumps first', 'next' => 'wrong_b'],
                ['label' => 'Block the obstacle lane, then allow side jumps', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The frog cannot jump into the obstacle lane at that point.\nStep back to when you jumped first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Side jump cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min over lanes + 1', 'next' => 'success'],
                ['label' => '+ distance between lanes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any lane change counts as one jump.\nStep back to when you used distance.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 0, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

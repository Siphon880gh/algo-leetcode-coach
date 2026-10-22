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
            'message' => "Problem: A table lists employees’ shifts with start and end times. For each employee, count how many pairs of their shifts overlap, in the format the statement asks. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nPair order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a.st < b.st', 'next' => 's2'],
                ['label' => 'a.st <> b.st', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check → (1, 5), (2, 2), (3, 1).\nStep back to when you used <>.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "End test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a.en >= b.st', 'next' => 'wrong_b'],
                ['label' => 'a.en > b.st', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Back-to-back shifts count: employee 3 gets 1.\nStep back to when you used >=.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. The guide’s check → (1, 2), (2, 1).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

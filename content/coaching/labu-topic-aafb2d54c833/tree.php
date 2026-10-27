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
            'message' => "State:\nintervals (1,3), (2,4), (3,5)\nchoose the most intervals with no overlap\n\nBy earliest end time, which do you pick first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(1,3)', 'next' => 'mid'],
                ['label' => '(2,4)', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nThe earliest end is 3, from (1,3).\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nyour greedy rule passed one test\n\nIs that enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No. You need a proof or a known safe pattern.', 'next' => 'final'],
                ['label' => 'Yes, always', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nPassing samples does not prove the rule is optimal.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nyou cannot prove the rule, and you found a counterexample\n\nWhat do you do?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Switch to DP or search', 'next' => 'success'],
                ['label' => 'Ignore the counterexample', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nA greedy rule that fails a counterexample is wrong and has to go.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- A greedy rule needs a proof.\n- Picking the earliest end is a classic safe rule for intervals.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

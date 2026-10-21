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
            'message' => "Read the problem statement above.\nAssume input order is the trip?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: use a set', 'next' => 's2'],
                ['label' => 'Yes: last pair', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Paths can be listed in any order.\nStep back to when you took the last pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Test which cities?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sources not in destinations', 'next' => 'wrong_b'],
                ['label' => 'Destinations not in sources', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That finds the start city.\nStep back to when you tested sources.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Single path?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its destination', 'next' => 'success'],
                ['label' => 'Error', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [[A,Z]] → Z.\nStep back to when you special-cased it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). London→NY→Lima→Sao Paulo → \"Sao Paulo\". [[\"B\",\"C\"],[\"D\",\"B\"],[\"C\",\"A\"]] → \"A\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

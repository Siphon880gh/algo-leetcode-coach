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
            'message' => "Read the problem statement above.\nHow many hydrogen permits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2', 'next' => 's2'],
                ['label' => '1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each molecule needs two hydrogens.\nStep back to when you gave one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why a barrier?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'To limit hydrogens', 'next' => 'wrong_b'],
                ['label' => 'So the three threads of a molecule print together', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The semaphores already limit them.\nStep back to when you used it as a limit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When does a thread return its permit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After printing', 'next' => 'success'],
                ['label' => 'Before the barrier', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The next molecule could start mixing in early.\nStep back to when you released before the barrier.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per thread. \"HOH\" → \"HHO\" (any valid order). \"OOHHHH\" → \"HHOHHO\" (any valid order).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

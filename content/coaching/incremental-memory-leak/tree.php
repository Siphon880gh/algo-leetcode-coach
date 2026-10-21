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
            'message' => "Read the problem statement above.\nTie between sticks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use stick 1', 'next' => 's2'],
                ['label' => 'Use stick 2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The statement picks stick 1 on ties.\nStep back to when you chose stick 2.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Larger stick lacks i bits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try the other stick', 'next' => 'wrong_b'],
                ['label' => 'Crash now', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The smaller one cannot fit i either.\nStep back to when you tried the other.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Iterations needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'About √(2(m1 + m2)), fine to simulate', 'next' => 'success'],
                ['label' => 'Too many; need a formula', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The sum 1 + … + i grows quadratically.\nStep back to when you feared the loop.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(√(m1 + m2)). Examples → [3,1,0], [6,0,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

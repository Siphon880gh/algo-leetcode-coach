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
            'message' => "Read the problem statement above.\nWhich region do you wall each day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The one threatening the most healthy cells', 'next' => 's2'],
                ['label' => 'The largest region', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The rule is about cells threatened next night, not region size.\nStep back to when you used region size.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many walls does a region need?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of threatened cells', 'next' => 'wrong_b'],
                ['label' => 'One per (infected cell, healthy neighbor) edge', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A healthy cell touching two infected cells needs two walls.\nStep back to when you counted cells.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do the unwalled regions do?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Infect all their threatened cells', 'next' => 'success'],
                ['label' => 'Stay the same', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The virus spreads every night where it is not contained.\nStep back to when you froze them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Repeat until nothing is threatened. isInfected = [[0,1,0,0,0,0,0,1],[0,1,0,0,0,0,0,1],[0,0,0,0,0,0,0,1],[0,0,0,0,0,0,0,0]] → 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

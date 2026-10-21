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
            'message' => "Read the problem statement above.\nAn interior gap has g empty seats. Best distance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(g + 1) // 2', 'next' => 's2'],
                ['label' => 'g // 2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. With g = 1 you still get distance 1.\nStep back to when you used g // 2.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Empty seats before the first person?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Treat it like an interior gap', 'next' => 'wrong_b'],
                ['label' => 'Sit at seat 0: the distance is the run length', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. No one sits to the left, so take the wall seat.\nStep back to when you halved the edge.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "And after the last person?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The same: n − 1 − last', 'next' => 'success'],
                ['label' => 'Ignore it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The last seat can be the best one.\nStep back to when you skipped the end.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,0,0,0,1,0,1] → 2. [1,0,0,0] → 3. [0,1] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

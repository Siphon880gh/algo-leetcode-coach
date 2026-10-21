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
            'message' => "Read the problem statement above.\nWhich indices change?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Odd indices', 'next' => 's2'],
                ['label' => 'Even indices', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Digits sit at odd indices.\nStep back to when you touched the letters.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shift from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 's[0]', 'next' => 'wrong_b'],
                ['label' => 's[i − 1]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each digit shifts its own left neighbour.\nStep back to when you used the first letter.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Wrap past z?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not needed; guaranteed in range', 'next' => 'success'],
                ['label' => 'Mod 26', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement guarantees the shift stays ≤ z.\nStep back to when you added a wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"abcdef\", \"abbdcfdhe\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

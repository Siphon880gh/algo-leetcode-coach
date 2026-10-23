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
            'message' => "Read the problem statement above.\nOrder of letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Highest bit first', 'next' => 's2'],
                ['label' => 'Lowest bit first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → \"ac\" for 5 instead of \"ca\".\nStep back to when you started from the lowest bit.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Above 'z'?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep going to the next character', 'next' => 'wrong_b'],
                ['label' => 'Repeat \'z\'', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): x = 2^26 → \"{\" instead of \"zz\".\nStep back to when you passed 'z'.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · 26). Examples → [\"b\", \"ca\", \"cba\"], [\"ba\", \"da\", \"a\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

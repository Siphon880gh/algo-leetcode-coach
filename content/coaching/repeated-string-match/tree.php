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
            'message' => "Read the problem statement above.\nWhat is the fewest copies that could work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'q = ceil(|b| / |a|)', 'next' => 's2'],
                ['label' => '1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Fewer than q copies are shorter than b.\nStep back to when you started at 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "b is not in a · q. Try how many more?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep adding copies up to some large limit', 'next' => 'wrong_b'],
                ['label' => 'Just one: a · (q + 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A match starts within the first copy, so it needs at most one extra copy; more never help.\nStep back to when you kept adding.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Neither q nor q + 1 contains b. Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '-1', 'next' => 'success'],
                ['label' => 'q + 2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. No number of copies can work then.\nStep back to when you kept going.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Two substring checks: O((|a| + |b|) · |b|) naive. a = \"abcd\", b = \"cdabcdab\" → 3. a = \"a\", b = \"aa\" → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

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
            'message' => "Read the problem statement above.\nValue to look up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'first ^ second', 'next' => 's2'],
                ['label' => 'second − first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. val ^ first = second means val = first ^ second; Example 1 → [[0,2],[0,0]] instead of [[0,2],[2,3]].\nStep back to when you subtracted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A value appears again later?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Overwrite it', 'next' => 'wrong_b'],
                ['label' => 'Keep the first place', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The smallest left end must win; Example 1 → [[3,5],[2,3]] instead of [[0,2],[2,3]].\nStep back to when you overwrote.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(30 · n + q). Examples → [[0,2],[2,3]], [[−1,−1]], [[0,0]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

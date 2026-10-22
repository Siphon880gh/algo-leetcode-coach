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
            'message' => "Read the problem statement above.\nSchedule fn how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'setTimeout(() => fn(...args), t)', 'next' => 's2'],
                ['label' => 'setTimeout(fn(...args), t)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That calls fn at once and hands its result to setTimeout; in Node example 1 throws ERR_INVALID_ARG_TYPE.\nStep back to when you called fn inside setTimeout.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The timer id itself', 'next' => 'wrong_b'],
                ['label' => 'A function that calls clearTimeout(id)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The caller invokes what you return; in Node calling the id throws a TypeError.\nStep back to when you returned the id.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → [{time: 20, returned: 10}], [], [{time: 30, returned: 8}].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

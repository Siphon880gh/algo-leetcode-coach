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
            'message' => "Read the problem statement above.\nWhen does fn start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At once, alongside the timer', 'next' => 's2'],
                ['label' => 'Await fn, then start the timer', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The limit must cut fn short; Example 1 → resolved 25 at 100 instead of rejected at 50.\nStep back to when you awaited fn first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The timer rejects with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'An Error object', 'next' => 'wrong_b'],
                ['label' => 'The string Time Limit Exceeded', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The expected rejection is the string itself; Example 1 → an Error object instead of the string.\nStep back to when you wrapped it in Error.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) work. Examples → rejected at 50, resolved 25 at 100, resolved 15 at 120, rejected at 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

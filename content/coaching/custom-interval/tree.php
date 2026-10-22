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
            'message' => "Problem: Write customInterval, which calls a function repeatedly with gaps that grow according to a delay and a period, and returns an id; and customClearInterval, which stops those calls for that id. The exact timing rule and names are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nSchedule the calls with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A chain of setTimeout', 'next' => 's2'],
                ['label' => 'One setInterval', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Its gap never grows; in Node, with the guide’s assumed gaps and delay 20, it fires at 20, 40, 60 instead of 20, 50, 90.\nStep back to when you used setInterval.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "customClearInterval cancels?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first handle', 'next' => 'wrong_b'],
                ['label' => 'The latest timeout handle', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That one already fired; in Node calls kept coming after clearing.\nStep back to when you kept the first handle.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. The check → calls at about 20, 50, 90 ms, then none.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

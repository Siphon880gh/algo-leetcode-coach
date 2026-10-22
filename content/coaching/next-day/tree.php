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
            'message' => "Problem: Add a method to every Date that returns the following calendar day as a date string, such as year-month-day. The method name and exact format are in the official statement. For instance, for new Date(\"2014-06-20\") the next day is 2014-06-21, and for 2016-02-28 it is 2016-02-29. (Restated from memory; limits and examples may differ slightly.)\nAdd a day with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'setUTCDate(getUTCDate() + 1)', 'next' => 's2'],
                ['label' => 'setDate and the local getters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Date-only strings are UTC; with TZ=America/Los_Angeles in Node 2014-06-20 → 2014-06-20 instead of 2014-06-21.\nStep back to when you used local time.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Format with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'toLocaleDateString()', 'next' => 'wrong_b'],
                ['label' => 'toISOString().slice(0, 10)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That uses a locale format; in Node en-US gives 6/21/2014.\nStep back to when you used the locale.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). The examples → 2014-06-21, 2016-02-29.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];

## Walk the array twice

Simulate the wrap by looping `i` over `0..2n − 1` and using `nums[i % n]`. Keep a stack of indices whose answer is not found yet (values decreasing from bottom to top). For each `i`: while the top's value is smaller than `nums[i % n]`, pop it and set its answer to `nums[i % n]`. Push `i % n` only during the first pass, so each index is pushed once. Anything left at the end has no larger value: −1.

The doocs version scans `i` from `2n − 1` down to 0, popping values `<= nums[i]`; the top is then the answer.

Next Greater Element I (496) has no wrap and answers queries through a map. Daily Temperatures (739) returns the distance instead of the value.

Do not use a one-pass stack only — the last elements need to see the start of the array. Do not use `>=` when popping in the left-to-right version — the next value must be strictly greater.

Time: O(n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.

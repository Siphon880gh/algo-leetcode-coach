You get a list of requests, each a [userId, time] pair, plus integers k and window. Remove as few requests as possible so that no user has more than k kept requests inside any time window of length window. Return how many requests you can keep. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Greedy window

1. Group times by user and sort each list.
2. For each time t: pop kept times with t − front > window. If fewer than k remain, keep t; else drop it.
3. Return the number kept.

Assumed here: two times share a window when they differ by at most window.

Constructed checks (made-up values, run in code): requests [[1, 1], [1, 2], [1, 3], [2, 5]] with k = 2 → 3 for window = 2 and 4 for window = 1. Checked against every subset on 800 random cases.

Pooling all users in one window: [[1, 1], [1, 2], [2, 2], [2, 3]], k = 2, window = 1 → 3 instead of 4.

Time: O(m log m), m = requests  
Space: O(m)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.

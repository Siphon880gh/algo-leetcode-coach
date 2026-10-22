Given an integer array, one operation removes a strictly increasing subsequence. Return the fewest operations that empty the array. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Patience sorting

This assumes the removed subsequences must be strictly increasing; check the official statement.

1. Keep tails of non-increasing runs as negated values in ascending order; for each x, replace the first tail > −x (bisect right), or append.
2. Return the number of tails.

Constructed checks (run in code): [5, 3, 1, 4, 2] → 3; [1, 2, 3] → 1; [2, 2, 2] → 3. Checked against trying every split on 200 random arrays.

Counting descents plus one: [5, 3, 1, 4, 2] → 4 instead of 3.

Time: O(n log n)  
Space: O(n)

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

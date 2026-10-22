Count the ways to give n candies to 3 children so that no child gets more than limit candies. This is the same task as Distribute Candies Among Children II with larger limits; the limits are in the official statement. For instance, n = 5, limit = 2 → 3 and n = 3, limit = 3 → 10. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Inclusion–exclusion

1. For i = 0 … 3: `m = n − i·(limit + 1)`; if m ≥ 0, add `(−1)^i · C(3, i) · C(m + 2, 2)`.
2. Return the sum.

Constructed checks (run in code): the examples above; all n < 40, limit < 20 match counting every split.

Dropping the cap gives C(7, 2) = 21 for the first example instead of 3. Check the official limits for whether 64-bit is enough.

Time: O(1)  
Space: O(1)

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

## Enumerate the answer

1. `present` = set (or boolean array) of values.
2. For `g = 1 … max`: `cur = 0`; for `x = g, 2g, …`: if present, `cur = gcd(cur, x)`; stop early when `cur == g`.
3. Count the `g` with `cur == g`.

`[6,10,3]` → 5 (6, 10, 3, 2, 1). `[5,15,40,5,6]` → 7.

Adding more multiples of g can only lower the gcd toward g, so using all of them is optimal. Do not enumerate subsequences.

Time: O(M log M · log M) with M = max value  
Space: O(M)

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

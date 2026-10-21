## Even and odd states

1. `even = 0` (empty), `odd = −∞`.
2. For each `x`: `even, odd = max(even, odd − x), max(odd, even + x)`.
3. Return `odd` (ending on a plus is never worse).

`[4,2,5,3]` → 7 (4 − 2 + 5). `[5,6,7,8]` → 8. `[6,2,1,2,4,5]` → 10. Checked against all subsequences on random arrays.

Update both states from the old values simultaneously. Equivalent greedy: the first element plus every positive rise `max(0, a[i] − a[i − 1])`.

Time: O(n)  
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

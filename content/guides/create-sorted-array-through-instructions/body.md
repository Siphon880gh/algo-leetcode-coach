## Prefix counts

1. `less = query(x − 1)`, `greater = i − query(x)` (i inserted so far).
2. `cost += min(less, greater)`; `update(x, 1)`.
3. Return `cost` mod 1e9+7.

`[1,5,6,2]` → 1. `[1,2,3,6,5,4]` → 3. `[1,3,3,3,2,4,2,1,2]` → 4.

Equal values count as neither less nor greater. A sorted list with insort is O(n²) in the worst case; use the BIT.

Time: O(n log V)  
Space: O(V)

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

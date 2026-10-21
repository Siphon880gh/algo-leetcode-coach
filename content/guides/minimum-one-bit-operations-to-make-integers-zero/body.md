## Gray-code index

1. `r = 0`; while `n > 0`: `r ^= n`; `n >>= 1`.
2. Return `r`.

`n = 3` → 2. `n = 6` → 4. `n = 0` → 0. `n = 4` → 7 (clearing bit 2 alone needs 2^3 − 1 steps).

Equivalent recursion: `f(n) = (2^(k+1) − 1) − f(n − 2^k)` for highest bit `k`. A BFS over small n confirms the formula. Do not BFS for n up to 10^9.

Time: O(log n)  
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

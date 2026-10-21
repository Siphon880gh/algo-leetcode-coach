## Three costs from counts

1. `ca`, `cb` = letter counts; `m = |a|`, `n = |b|`.
2. Same letter: `min over i of (m + n − ca[i] − cb[i])`.
3. Split after letter `i` (0 … 24): with prefix sums `pa`, `pb` through `i`,
   - a < b: `(m − pa) + pb`;
   - b < a: `(n − pb) + pa`.
4. Return the minimum.

`"aba", "caa"` → 2. `"dabadd", "cda"` → 3.

Do not let the split run through `z`; nothing is strictly greater than `z`.

Time: O(m + n + 26)  
Space: O(26)

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
